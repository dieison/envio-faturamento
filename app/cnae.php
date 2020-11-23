<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cnae extends Model
{
    protected $connection = 'mysql';
    protected $table = 'cnae';

    public static function getDescricaoCnae($id)
    {
        $cnae = cnae::where('codigo_cnae', '=', $id)->first();
        return $cnae->descricao;
    }
}
