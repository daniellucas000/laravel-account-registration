@extends('layouts.admin')

@section('content')
<div class="card mt-4 mb-4 border-light shadow">
    <div class="card-header d-flex justify-content-between align-items-center border-light">
        <span>Visualizar Conta</span>
        <span class="d-flex gap-2">
            <a class="btn btn-dark" href="{{route('conta.index')}}">Listar</a>
            <a class="btn btn-dark" href="{{route('conta.edit', ['conta' => $conta->id] )}}">Editar</a>
        </span>
    </div>

    <!-- Verificar se existe a sessão success e imprimir o valor -->
    <x-alert />

    <div class="card-body">
        <dl class="row">
            <dt class="col-sm-3">Nome</dt>
            <dd class="col-sm-9">{{ $conta->name}}</dd>

            <dt class="col-sm-3">Valor</dt>
            <dd class="col-sm-9">{{ 'R$' . number_format($conta->value, 2, ',', '.')}}</dd>

            <dt class="col-sm-3">Vencimento</dt>
            <dd class="col-sm-9">{{ \Carbon\Carbon::parse($conta->expiration)->tz('America/Sao_Paulo')->format('d/m/Y')}}</dd>

            <dt class="col-sm-3">Situação</dt>
            <dd class="col-sm-9"><span class="badge text-bg-{{ $conta->situacaoConta->color }}">
                    {{ $conta->situacaoConta->name }}
                </span></dd>

            <dt class="col-sm-3">Cadastrado</dt>
            <dd class="col-sm-9">{{ \Carbon\Carbon::parse($conta->created_at)->tz('America/Sao_Paulo')->format('d/m/Y H:i:s')}}</dd>

            <dt class="col-sm-3">Editado</dt>
            <dd class="col-sm-9">{{ \Carbon\Carbon::parse($conta->updated_at)->tz('America/Sao_Paulo')->format('d/m/Y H:i:s')}}</dd>
        </dl>
    </div>
</div>
@endsection