<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Titulo;
use Illuminate\Http\Request;

class TituloController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Pega todos os titulos de um cliente pelo seu ID
     *
     * 
     */
    public function getTitulosByCliente($id)
    {
        return Titulo::getBoletosByCliente($id);
    }

    /**
     * Faz a geração do boleto de um cliente pelo CDRCD
     *
     * 
     */
    public function gerarBoleto($cdrcd)
    {
        $dados = Titulo::getInformacaoBoleto($cdrcd);
        Helper::gerarBoleto($dados);
    }
}
