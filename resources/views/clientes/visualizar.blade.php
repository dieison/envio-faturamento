@extends('layouts.app')
@section('content')
<h2>Visualizar Cliente</h2>
<hr />
<card sombra="true">
    <div class="row">
        <div class="col-4">
            <p>Nome Fantasia: <b>{{$dados->NomeFantasia}}</b></p>
        </div>
        <div class="col-4">
            <p>Razão Social: <b>{{$dados->RazaoSocial}}</b></p>
        </div>
        <div class="col-4">
            <p>CNPJ: <b>{{$dados->CNPJCPF}}</b></p>
        </div>
    </div>
    <div class="row">
        <div class="col-4">
            <p>E-mail: <b>{{$dados->Email}}</b></p>
        </div>
        <div class="col-4">
            <p>Telefone: <b>{{$dados->Telefone}}</b></p>
        </div>
        @if($dados->TipoCliente)
        <div class="col-4">
            <p>Segmentação: <b>{{$dados->TipoCliente}}</b></p>
        </div>
        @endif
    </div>
</card>
<tabela-titulos class="mt-3" id_cliente="{{$dados->CodigoCliente}}"/>
@endsection