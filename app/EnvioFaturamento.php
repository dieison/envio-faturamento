<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EnvioFaturamento extends Model
{
    protected $connection = 'mysql';
    protected $table = 'envio';
    public $timestamps = false;


    protected $fillable = [
        'cdrcd', 'status',
        'mes_referencia',
        'id_cliente',
        'status_visualizacao',
        'data_visualizacao'
    ];


    public static function adicionarTitulos($dados)
    {
        return EnvioFaturamento::insert($dados);
    }

    public static function getTitulosMesCorrente($status = null,$turno=null)
    {
        return EnvioFaturamento::SelectRaw('cdrcd, nome,cnpj,banco,status,turno,tipo_nota')
            ->whereRaw('mes_referencia = ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 1 MONTH)), 1)')
            ->when($status, function ($query, $status) {
                return $query->where('status', $status);
            })
            ->when($turno, function ($query, $turno) {
                return $query->where('turno', $turno);
            })
            ->get();
    }

    public static function getEnvioByCDRCD($cdrcd)
    {
        return EnvioFaturamento::whereRaw('mes_referencia
         = ADDDATE(LAST_DAY(SUBDATE(CURDATE(),
          INTERVAL 1 MONTH)), 1)')
            ->where('cdrcd', $cdrcd)
            ->where('status', 'Não Enviado')
            ->get();
    }

    public static function atualizaEnvio($cdrcd, $valor)
    {
        return EnvioFaturamento::whereRaw('mes_referencia
         = ADDDATE(LAST_DAY(SUBDATE(CURDATE(),
          INTERVAL 1 MONTH)), 1)')
            ->where('cdrcd', $cdrcd)
            ->update(['status' => $valor]);
    }


    public static function atualizarStatusVisualizacao($cdrcd)
    {
        $registro = EnvioFaturamento::where("cdrcd", "=", $cdrcd)->first();

        if (!is_null($registro->status_visualizacao)) {
            $registro->status_visualizacao = 1;
            $registro->data_visualizacao = date("Y-m-d H:i:s");;
            $registro->save();
        }
    }


    public static function getStatusVisualizacao($status = null)
    {
        return EnvioFaturamento::SelectRaw("cdrcd, nome,cnpj,banco,status_visualizacao,
        CASE WHEN status_visualizacao=0
        THEN 'Não Visualizado' else 'Visualizado' end as status_visualizacao")
            ->whereRaw('mes_referencia = ADDDATE(LAST_DAY(SUBDATE(CURDATE(), INTERVAL 1 MONTH)), 1)')
            ->when($status, function ($query, $status) {
                return $query->where('status_visualizacao', $status);
            })
            ->get();
    }
}
