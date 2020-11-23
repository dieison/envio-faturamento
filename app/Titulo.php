<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Titulo extends Model
{
    protected $connection = 'sqlsrv';
    protected $table = 'TodosOsBoletos';

    public static function getBoletosByCliente($id)
    {
        return Titulo::selectRaw('CdRcd, convert(varchar,DtRctVen,103) as vencimento, convert(varchar,DtRctVenPro,103) as vencimento_prorrogado,
        Valor, NmBco as banco, SituacaoBoleto, NrFfm as nosso_numero')
            ->where('ClienteId', $id)
            ->orderBy('CdRcd', 'DESC')
            ->distinct()
            ->get();
    }

    public static function getInformacaoBoleto($id_boleto)
    {
        return Titulo::selectRaw('CdRcd,Cedente,CNPJCPF_Cedente,CNPJCPF_Sacado,Sacado,Endereco,
        NrPesEdr as numero, Bairro, NrPesCep as cep, Cidade, UF, ValorPrincipal as Valor, NrFfm as nosso_numero,
        NrBco, Carteira,AgCodCed as agencia_conta, DtRctVen as vencimento, NFSE, 
        EspecieDoc as especie, Aceite, DataEHoraDoProcessamento as processamento,
        DtRcdEmi as emissao, LinhaDigitavel as codigo_barras,ClienteId,Email,Email2,
        convert(varchar, DtRctVenPro ,103) as data_vencimento_prorrogado,NmBco,TipoDeDocumento')
            ->where('CdRcd', '=', $id_boleto)
            ->first();
    }

    public static function getProblemasNotas()
    {
        return Titulo::selectRaw('TodosOsBoletos.Sacado,TodosOsBoletos.CNPJCPF_Sacado,TodosOsBoletos.NmBco,
        TodosOsBoletos.ValorPrincipal as Valor, TodosOsBoletos.ClienteId')
            ->whereRaw("TodosOsBoletos.DtRcdEmi IN(convert(varchar, DATEADD(m, DATEDIFF(m, 0, GETDATE()), 0) ,23),convert(varchar, DATEADD(m, DATEDIFF(m, 0, GETDATE()), 1) ,23),convert(varchar, DATEADD(m, DATEDIFF(m, 0, GETDATE()), 2) ,23)) 
            and TodosOsBoletos.Situacao=0 and TipoDeDocumento='Nota Fiscal de Serviço Eletrônica'")
            ->get();
    }

    public static function getBoletosMesAtual($banco = null, $turno = NULL)
    {
        $where = NULL;
        if ($turno == "Turno dia 5") {
            $where = "DtRcdEmi=convert(varchar, DATEADD(m, DATEDIFF(m, 0, GETDATE()), 0) ,23) and Turno='Turno dia 5'";
        } else {
            if ($turno == "Turno dia 15") {
                $where = "DtRcdEmi=convert(varchar, DATEADD(m, DATEDIFF(m, 0, GETDATE()), 1) ,23) and Turno='Turno dia 15'";
            } else {
                if ($turno == "Turno dia 25") {
                    $where = "DtRcdEmi=convert(varchar, DATEADD(m, DATEDIFF(m, 0, GETDATE()), 2) ,23) and Turno='Turno dia 25'";
                }
            }
        }
        return Titulo::selectRaw("CdRcd, Sacado,CNPJCPF_Sacado,NmBco,ValorPrincipal as Valor,TipoDeDocumento as tipo_nota,Turno")
            ->when($banco, function ($query, $banco) {
                return $query->where('NmBco', $banco);
            })
            ->when($where, function ($query, $where) {
                return $query->whereRaw($where);
            })
            ->get();
    }

    public static function getBoletosEnvio($turno = NULL)
    {
        $where = NULL;
        if ($turno == "Turno dia 5") {
            $where = "DtRcdEmi=convert(varchar, DATEADD(m, DATEDIFF(m, 0, GETDATE()), 0) ,23) and Turno='Turno dia 5'";
        } else {
            if ($turno == "Turno dia 15") {
                $where = "DtRcdEmi=convert(varchar, DATEADD(m, DATEDIFF(m, 0, GETDATE()), 1) ,23) and Turno='Turno dia 15'";
            } else {
                if ($turno == "Turno dia 25") {
                    $where = "DtRcdEmi=convert(varchar, DATEADD(m, DATEDIFF(m, 0, GETDATE()), 2) ,23) and Turno='Turno dia 25'";
                }
            }
        }
        return Titulo::selectRaw("CdRcd as cdrcd,ClienteId as id_cliente, CNPJCPF_Sacado as cnpj, Sacado as nome,
        NmBco as banco, convert(varchar, DATEADD(m, DATEDIFF(m, 0, GETDATE()), 0) ,23) as mes_referencia, TipoDeDocumento as tipo_nota,Turno")
            ->when($where, function ($query, $where) {
                return $query->whereRaw($where);
            })
            ->get();
    }
}
