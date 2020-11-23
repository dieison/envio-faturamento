@extends('layouts.app')
@section('content')
<h2>Listagem de Títulos a Serem Enviados</h2>
<hr />
<tabela-faturamento turno="{{$dados['turno']}}"/>
@endsection
