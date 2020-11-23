<?php

namespace App\Http\Controllers;

use App\Titulo;
use Illuminate\Http\Request;

class ProblemasController extends Controller
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
     * Faz a listagem de Todos os problemas ocorridos durante o faturamento.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientes = Titulo::getProblemasNotas();
        return view('problemas.listar',compact('clientes'));
    }
}
