<?php

namespace App\Http\Controllers;

use App\EnvioFaturamento;
use App\Helpers\Faturamento;
use App\Titulo;
use Illuminate\Http\Request;

class FaturamentoController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        set_time_limit(0);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($turno)
    {
        $dados['turno'] = $turno;
        return view('faturamento.listar', compact('dados'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listaFaturamentoEmails()
    {
        return view('faturamento.listarEmailsFaturamento');
    }

    /**
     * Pega Todos os Titulos do Mês corrente, onde tambem é possível passar apenas
     * o banco como filtro
     */
    public function getFaturamento(Request $request)
    {
        return Titulo::getBoletosMesAtual($request->banco, $request->turno);
    }

    /**
     * Faz o envio do Faturamento
     */
    public function envioFaturamento(Request $request)
    {
        if (EnvioFaturamento::getTitulosMesCorrente(false, $request->turno)->count() == 0) { //Verifica se o faturamento ja foi adicionado no banco MYSQL
            EnvioFaturamento::adicionarTitulos(Titulo::getBoletosEnvio($request->turno)->toArray()); // Adiciona os titulos no banco de dados
        }
        return Faturamento::envioFaturamento($request->dados);
    }


    /**
     * Pega todo o faturamento do mes com o status 
     * de e-mail enviado e não enviado
     */
    public function getFaturamentoEmail()
    {
        return EnvioFaturamento::getTitulosMesCorrente();
    }


    public function getStatusVisualizacao()
    {

        return  EnvioFaturamento::getStatusVisualizacao();
    }

    public function listaStatusVisualizacao()
    {
        return view('faturamento.listarStatusVisualizacao');
    }
}
