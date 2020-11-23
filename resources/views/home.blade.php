@extends('layouts.app')

@section('content')
<h2>Página Inicial</h2>
<hr />
<card>
    <div class="row mt-2 d-flex justify-content-center">
        <div class="col-md-4">
            <a href="{{route('faturamento.index','turno-dia-5')}}">
                <card class="border-dark" sombra="true">
                    <h5 class="card-title text-center">Faturamento - Turno 5 <i class="fa fa-clock-o" aria-hidden="true"></i></h5>
                    <hr />
                    <div class="card-body">
                        <h5 class="card-text">Faturados: <b>{{$dados['turno_dia_5']}}</b></h5>
                        <h5 class="card-text">Enviados: <b>{{$dados['enviados_turno_dia_5']}}</b></h5>
                        <h5 class="card-text">Não Enviados: <b>{{$dados['nao_enviados_turno_dia_5']}}</b></h5>
                    </div>
                </card>
            </a>
        </div>
        <div class="col-md-4">
            <a href="{{route('faturamento.index','turno-dia-15')}}">
                <card class="border-dark" sombra="true">
                    <h5 class="card-title text-center">Faturamento - Turno 15 <i class="fa fa-clock-o" aria-hidden="true"></i></h5>
                    <hr />
                    <div class="card-body">
                        <h5 class="card-text">Faturados: <b>{{$dados['turno_dia_15']}}</b></h5>
                        <h5 class="card-text">Enviados: <b>{{$dados['enviados_turno_dia_15']}}</b></h5>
                        <h5 class="card-text">Não Enviados: <b>{{$dados['nao_enviados_turno_dia_15']}}</b></h5>
                    </div>
                </card>
            </a>
        </div>
        <div class="col-md-4">
            <a href="{{route('faturamento.index','turno-dia-25')}}">
                <card class="border-dark" sombra="true">
                    <h5 class="card-title text-center">Faturamento - Turno 25 <i class="fa fa-clock-o" aria-hidden="true"></i></h5>
                    <hr />
                    <div class="card-body">
                        <h5 class="card-text">Faturados: <b>{{$dados['turno_dia_25']}}</b></h5>
                        <h5 class="card-text">Enviados: <b>{{$dados['enviados_turno_dia_25']}}</b></h5>
                        <h5 class="card-text">Não Enviados: <b>{{$dados['nao_enviados_turno_dia_25']}}</b></h5>
                    </div>
                </card>
            </a>
        </div>
    </div>
    <div class="row mt-2 d-flex justify-content-center">
        <div class="col-md-4">
            <a href="{{route('faturamento.listarEmails')}}">
                <card class="h-100 border-dark" sombra="true">
                    <h5 class="card-title text-center">E-mails - Envios <i class="fa fa-paper-plane" aria-hidden="true"></i></h5>
                    <hr />
                    <div class="card-body">
                        <h5 class="card-text">Total Faturado: <b>{{$dados['faturados']}}</b></h5>
                        <h5 class="card-text">E-mails Enviados: <b>{{$dados['emails_enviados']}}</b></h5>
                        <h5 class="card-text">E-mails Não Enviados: <b>{{$dados['emails_nao_enviados']}}</b></h5>
                    </div>
                </card>
            </a>
        </div>
        <div class="col-md-4">
            <a href="{{route('faturamento.listarStatusVisualizacao')}}">
                <card class="h-100 border-dark" sombra="true">
                    <h5 class="card-title text-center">E-mails <i class="fa fa-envelope-open-o" aria-hidden="true"></i></h5>
                    <hr />
                    <div class="card-body">
                        <h5 class="card-text">E-mails Lidos: <b>{{$dados['emails_lidos']}}</b></h5>
                        <h5 class="card-text">E-mails Não Lidos: <b>{{$dados['emails_nao_lidos']}}</b></h5>
                    </div>
                </card>
            </a>
        </div>
        <div class="col-md-4">
            <a href="{{route('problemas.index')}}">
                <card class="h-100 border-dark" sombra="true">
                    <h5 class="card-title text-center">Problemas <i class="fa fa-exclamation-circle" aria-hidden="true"></i></h5>
                    <hr />
                    <div class="card-body text-center">
                        <h1 class="font-weight-bold">{{$dados['problemas']}}</h1>
                    </div>
                </card>
            </a>
        </div>
    </div>
</card>
@endsection