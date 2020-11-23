<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Session;

class UsersController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','admin']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios = User::getUsuarios();
        return view('usuarios.listar', compact('usuarios'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dados=User::getUsuarioById($id);
        return view('usuarios.editar',compact('dados'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editar(Request $request, $id)
    {
        $this->validator($request->all())->validate();
        $dados['name']=$request->name;
        $dados['email']=$request->email;
        $dados['password']=$request->password;
        $dados['type_user']=$request->tipo;
        User::updateUsuario($dados,$id);
        Session::flash('mensagem','Usuário Alterado com Sucesso!!!');
        return redirect(route('usuarios.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function excluirUsuario($id)
    {
        User::deleteUsuario($id);
        Session::flash('mensagem','Usuário Removido com Sucesso!!!');
        return redirect(route('usuarios.index'));
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'tipo' => ['required'],
            'email' => ['string', 'email', 'max:255', Rule::unique('users')->ignore($data['id'])],
            'password' => ['confirmed'],
        ]);
    }
}
