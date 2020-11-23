@extends('layouts.app')
@section('content')
<h2>Listagem de Usuários</h2>
<hr />
@if (session('mensagem'))
<div class="alert alert-success" role="alert">
    {{ session('mensagem') }}
</div>
@endif
<div>
    <a type="button" class="btn btn-primary" href="{{route('register')}}">Adicionar Usuário</a>
</div>
<tabela-usuarios class="mt-2" v-bind:usuarios="{{$usuarios}}" />
@endsection