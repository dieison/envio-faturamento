@extends('layouts.app')
@section('content')
<h2>Listagem de Títulos Enviados/Não Enviados</h2>
<hr />
<tabela-faturamento-email url_relatorio="{{route('relatorio.envioEmailFaturamento')}}"/>
@endsection