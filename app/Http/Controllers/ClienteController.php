<?php

namespace App\Http\Controllers;

use App\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('clientes.listar');
    }


    /**
     * Pega as informação de um cliente pelo dei ID
     */
    public function visualizarCliente($id)
    {
        $dados = Cliente::getClienteById($id);
        return view('clientes.visualizar', compact('dados'));
    }

    /**
     * Pega todos os clientes
     */
    public function getClientes()
    {
        return Cliente::getClientes();
    }
}
