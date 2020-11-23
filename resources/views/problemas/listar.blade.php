@extends('layouts.app')
@section('content')
<h2>Listagem de Clientes com Problemas</h2>
<hr />
<tabela-problemas v-bind:clientes="{{$clientes}}" url_relatorio="{{route('relatorio.problemas')}}"/>
@endsection