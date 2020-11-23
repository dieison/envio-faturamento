<?php

namespace App\Http\Controllers;

use App\EnvioFaturamento;
use App\Titulo;

class HomeController extends Controller
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
     * Pega todas as informações a serem exibidas na página inicial do sistema
     */
    public function index()
    {
        if (EnvioFaturamento::getTitulosMesCorrente(false, 'Turno dia 5')->count() > 0) {
            $dados['turno_dia_5'] = EnvioFaturamento::getTitulosMesCorrente(false,'Turno dia 5')->count();
        } else {
            $dados['turno_dia_5'] = Titulo::getBoletosMesAtual(false, 'Turno dia 5')->count();
        }
        if (EnvioFaturamento::getTitulosMesCorrente(false, 'Turno dia 15')->count() > 0) {
            $dados['turno_dia_15'] = EnvioFaturamento::getTitulosMesCorrente(false,'Turno dia 15')->count();
        } else {
            $dados['turno_dia_15'] = Titulo::getBoletosMesAtual(false, 'Turno dia 15')->count();
        }
        if (EnvioFaturamento::getTitulosMesCorrente(false, 'Turno dia 25')->count() > 0) {
            $dados['turno_dia_25'] = EnvioFaturamento::getTitulosMesCorrente(false,'Turno dia 25')->count();
        } else {
            $dados['turno_dia_25'] = Titulo::getBoletosMesAtual(false, 'Turno dia 25')->count();
        }
        $dados['problemas'] = Titulo::getProblemasNotas()->count();
        $dados['enviados_turno_dia_5'] = EnvioFaturamento::getTitulosMesCorrente('Enviado','Turno dia 5')->count();
        $dados['nao_enviados_turno_dia_5'] = EnvioFaturamento::getTitulosMesCorrente('Não Enviado','Turno dia 5')->count();
        $dados['enviados_turno_dia_15'] = EnvioFaturamento::getTitulosMesCorrente('Enviado','Turno dia 15')->count();
        $dados['nao_enviados_turno_dia_15'] = EnvioFaturamento::getTitulosMesCorrente('Não Enviado','Turno dia 15')->count();
        $dados['enviados_turno_dia_25'] = EnvioFaturamento::getTitulosMesCorrente('Enviado','Turno dia 25')->count();
        $dados['nao_enviados_turno_dia_25'] = EnvioFaturamento::getTitulosMesCorrente('Não Enviado','Turno dia 25')->count();
        $dados['emails_lidos'] = EnvioFaturamento::getStatusVisualizacao(1)->count();
        $dados['emails_nao_lidos'] = EnvioFaturamento::getStatusVisualizacao()->count() - $dados['emails_lidos'];
        $dados['emails_enviados'] = EnvioFaturamento::getTitulosMesCorrente('Enviado')->count();
        $dados['emails_nao_enviados'] = EnvioFaturamento::getTitulosMesCorrente('Não Enviado')->count();
        $dados['faturados'] = EnvioFaturamento::getTitulosMesCorrente()->count();
        return view('home', compact('dados'));
    }
}