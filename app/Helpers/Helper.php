<?php

namespace App\Helpers;

use Eduardokum\LaravelBoleto\Pessoa;
use Eduardokum\LaravelBoleto\Boleto\Banco\Itau;
use Eduardokum\LaravelBoleto\Boleto\Banco\Bradesco;
use Eduardokum\LaravelBoleto\Boleto\Render\Pdf;
use \Carbon\Carbon;
use Eduardokum\LaravelBoleto\Boleto\Banco\Caixa;
use Eduardokum\LaravelBoleto\Boleto\Banco\Santander;

class Helper
{
    public static function gerarBoleto($dados, $flag = null)
    {
        switch ($dados->NmBco) {
            case 'BANCO ITAU SA':
                return Helper::BoletoItau($dados, $flag);
                break;
            case 'BRADESCO':
                return Helper::BoletoBradesco($dados, $flag);
                break;
            case 'CAIXA ECONOMICA FEDERAL':
                return Helper::BoletoCaixa($dados, $flag);
                break;
            case 'SANTANDER':
                return Helper::BoletoSantander($dados, $flag);
                break;
        }
    }

    public static function BoletoItau($dados, $flag)
    {
        $agencia = explode("/", $dados->agencia_conta);
        $conta = explode("-", $agencia[1]);
        $numero = explode("/", $dados->nosso_numero);
        $nosso_numero = explode("-", $numero[1]);
        $boleto = new Itau([
            'logo' => realpath(public_path("img/logo.png")),
            'dataVencimento' => new Carbon($dados->vencimento),
            'dataProcessamento' => new Carbon($dados->processamento),
            'dataDocumento' => new Carbon($dados->emissao),
            'valor' => $dados->Valor,
            'numero' => $nosso_numero[0],
            'numeroDocumento' => $dados->CdRcd,
            'pagador' => Helper::Sacado($dados),
            'beneficiario' =>  Helper::Cedente($dados),
            'carteira' => $dados->Carteira,
            'agencia' => $agencia[0],
            'conta' => $conta[0],
            'aceite' => $dados->Aceite,
            'especieDoc' => $dados->especie,
            'instrucoes' => ["Multa de 2% e juros de 0,033% ao dia após o vencimento."],
        ]);

        $pdf = new Pdf();
        $pdf->addBoleto($boleto);
        if ($flag != null) {
            $pdf->gerarBoleto('F', storage_path('app/boletos/Boleto-' . $dados->CdRcd . '.pdf'));
            return 'Boleto-' . $dados->CdRcd . '.pdf';
        } else {
            $pdf->gerarBoleto('D', null, 'Boleto-' . $dados->CdRcd);
        }
    }

    public static function BoletoBradesco($dados, $flag = null)
    {
        $agencia = str_replace(' ', '', $dados->agencia_conta);
        $agencia = explode("/", $agencia);
        $conta = explode("-", $agencia[1]);
        $agencia = explode("-", $agencia[0]);
        $numero = explode("/", $dados->nosso_numero);
        $numero = explode("-", $numero[1]);
        $boleto = new Bradesco([
            'logo' => realpath(public_path("img/logo.png")),
            'dataVencimento' => new Carbon($dados->vencimento),
            'dataProcessamento' => new Carbon($dados->processamento),
            'dataDocumento' => new Carbon($dados->emissao),
            'valor' => $dados->Valor,
            'numero' => $numero[0],
            'numeroDocumento' => $dados->CdRcd,
            'pagador' => Helper::Sacado($dados),
            'beneficiario' =>  Helper::Cedente($dados),
            'carteira' => $dados->Carteira,
            'agencia' => $agencia[0],
            'conta' => $conta[0],
            'aceite' => $dados->Aceite,
            'especieDoc' => $dados->especie,
            'instrucoes' => ["Multa de 2% e juros de 0,033% ao dia após o vencimento."],
        ]);

        $pdf = new Pdf();
        $pdf->addBoleto($boleto);
        if ($flag != null) {
            $pdf->gerarBoleto('F', storage_path('app/boletos/Boleto-' . $dados->CdRcd . '.pdf'));
            return 'Boleto-' . $dados->CdRcd . '.pdf';
        } else {
            $pdf->gerarBoleto('D', null, 'Boleto-' . $dados->CdRcd);
        }
    }

    public static function BoletoCaixa($dados, $flag = null)
    {
        $agencia = explode(".", $dados->agencia_conta);
        $agencia = explode("-", $agencia[2]);
        $nosso_numero = explode("-", $dados->nosso_numero);
        $boleto = new Caixa([
            'logo' => realpath(public_path("img/logo.png")),
            'dataVencimento' => new Carbon($dados->vencimento),
            'dataProcessamento' => new Carbon($dados->processamento),
            'dataDocumento' => new Carbon($dados->emissao),
            'valor' => $dados->Valor,
            'numero' => $nosso_numero[0],
            'numeroDocumento' => $dados->CdRcd,
            'pagador' => Helper::Sacado($dados),
            'beneficiario' =>  Helper::Cedente($dados),
            'carteira' => 'RG',
            'agencia' => $agencia[0],
            'conta' => 830291,
            'aceite' => $dados->Aceite,
            'especieDoc' => $dados->especie,
            'codigoCliente' => 830291,
            'instrucoes' => ["Multa de 2% e juros de 0,033% ao dia após o vencimento."],
        ]);

        $pdf = new Pdf();
        $pdf->addBoleto($boleto);
        if ($flag != null) {
            $pdf->gerarBoleto('F', storage_path('app/boletos/Boleto-' . $dados->CdRcd . '.pdf'));
            return 'Boleto-' . $dados->CdRcd . '.pdf';
        } else {
            $pdf->gerarBoleto('D', null, 'Boleto-' . $dados->CdRcd);
        }
    }

    public static function BoletoSantander($dados, $flag = null)
    {
        $agencia = explode("/", $dados->agencia_conta);
        $nosso_numero = explode("-", $dados->nosso_numero);
        $boleto = new Santander([
            'logo' => realpath(public_path("img/logo.png")),
            'dataVencimento' => new Carbon($dados->vencimento),
            'dataProcessamento' => new Carbon($dados->processamento),
            'dataDocumento' => new Carbon($dados->emissao),
            'valor' => $dados->Valor,
            'numero' => $nosso_numero[0],
            'numeroDocumento' => $dados->CdRcd,
            'pagador' => Helper::Sacado($dados),
            'beneficiario' =>  Helper::Cedente($dados),
            'carteira' => '101',
            'agencia' => $agencia[0],
            'conta' => $agencia[1],
            'aceite' => $dados->Aceite,
            'especieDoc' => $dados->especie,
            'instrucoes' => ["Multa de 2% e juros de 0,033% ao dia após o vencimento."],
            'codigoCliente' =>  $agencia[1],
        ]);

        $pdf = new Pdf();
        $pdf->addBoleto($boleto);
        if ($flag != null) {
            $pdf->gerarBoleto('F', storage_path('app/boletos/Boleto-' . $dados->CdRcd . '.pdf'));
            return 'Boleto-' . $dados->CdRcd . '.pdf';
        } else {
            $pdf->gerarBoleto('D', null, 'Boleto-' . $dados->CdRcd);
        }
    }

    private static function Cedente($cedente)
    {
        $cedente = new Pessoa([
            'documento' => $cedente->CNPJCPF_Cedente,
            'nome'      => $cedente->Cedente,
            'endereco'  => "Av. Santos Dumont, 2626",
            'cep'       => "60150-161",
            'bairro'    => 'Aldeota',
            'uf'        => "CE",
            'cidade'    => "Fortaleza",
        ]);
        return $cedente;
    }

    private static function Sacado($sacado)
    {
        $sacado = new Pessoa([
            'documento' => $sacado->CNPJCPF_Sacado,
            'nome'      => $sacado->Sacado,
            'cep'       => $sacado->cep,
            'endereco'  => $sacado->Endereco . ', ' . $sacado->numero,
            'bairro'    => $sacado->Bairro,
            'uf'        => $sacado->UF,
            'cidade'    => $sacado->Cidade,
        ]);
        return $sacado;
    }
}
