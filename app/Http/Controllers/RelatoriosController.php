<?php

namespace App\Http\Controllers;

use App\EnvioFaturamento;
use App\Exports\Relatorios;
use App\Titulo;
use Maatwebsite\Excel\Facades\Excel;

class RelatoriosController extends Controller
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
     * Relatório refente os problemas ocorridos durante o faturamento
     */
    public function problemasRelatorios()
    {
        $headings = [
            'Nome',
            'CNPJ',
            'Banco',
            'Valor',
            'ID do Cliente'
        ];
        $dados = Titulo::getProblemasNotas();
        return Excel::download(new Relatorios($dados, $headings), 'Relatorio-Problemas.xls');
    }

    /**
     * Relatório refente os problemas ocorridos durante o faturamento
     */
    public function FaturamentoEmailsRelatorios()
    {
        $headings = [
            'Número Título',
            'Nome',
            'CNPJ',
            'Banco',
            'Status de Envio',
            'Turno',
            'Tipo de Nota'
        ];
        $dados =  EnvioFaturamento::getTitulosMesCorrente();
        return Excel::download(new Relatorios($dados, $headings), 'Relatorio-Emails-Enviados.xls');
    }

    /**
     * Relatório refente ao status de visualização de emails.
     */
    public function statusVisualizacaoRelatorios()
    {
        $headings = [
            'Número Título',
            'Nome',
            'CNPJ',
            'Banco',
            'Status de visualização'
        ];
        $dados =  EnvioFaturamento::getStatusVisualizacao();
        return Excel::download(new Relatorios($dados, $headings), 'Relatorio-status-visualização.xls');
    }
}
