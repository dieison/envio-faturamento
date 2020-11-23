<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $connection = 'sqlsrv';
    protected $table = 'Pessoas';

    public static function getClientes()
    {
        return Cliente::selectRaw('NomeFantasia, RazaoSocial,CNPJCPF,CodigoCliente,Email,TipoCliente')
            ->whereNotNull('CNPJCPF')
            ->orderBy('NomeFantasia', 'ASC')
            ->get();
    }

    public static function getClienteById($id)
    {
        return Cliente::selectRaw('CodigoCliente,NomeFantasia, RazaoSocial,CNPJCPF,CodigoCliente,Email,Telefone,TipoCliente')
            ->where('CodigoCliente',$id)
            ->first();
    }
}
