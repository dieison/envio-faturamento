@extends('layouts.app')
@section('content')
<h2>Listagem de Títulos Visualizados/Não Visualizados</h2>
<hr />
<tabela-status-visualizacao url_relatorio="{{route('relatorio.statusVisualizacaoRelatorios')}}"/>
@endsection