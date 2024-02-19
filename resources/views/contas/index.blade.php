@extends('layouts.admin')

@section('content')
<div class="card mt-3 mb-4 border-light shadow">
    <div class="card-header d-flex justify-content-between align-items-center border-light">
        <span>Pesquisar</span>
    </div>

    <div class="card-body">
        <form action="{{ route('conta.index')}}">
            <div class="row">
                <div class="col-md-3 col-sm-12">
                    <label class="form-label" for="search">Nome</label>
                    <input class="form-control" type="text" name="search" id="search" value="{{ $search }}" placeholder="Nome da conta">
                </div>

                <div class="col-md-3 col-sm-12">
                    <label class="form-label" for="start_date">Data Início</label>
                    <input class="form-control" type="date" name="start_date" id="start_date" value="{{ $start_date }}">
                </div>

                <div class="col-md-3 col-sm-12">
                    <label class="form-label" for="end_date">Data Fim</label>
                    <input class="form-control" type="date" name="end_date" id="end_date" value="{{ $end_date }}">
                </div>

                <div class="col-md-3 col-sm-12 mt-3 pt-3">
                    <button class="btn btn-dark" type="submit">Pesquisar</button>
                    <a href="{{ route('conta.index') }}" class="btn btn-dark">Limpar</a>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="card mt-4 mb-4 border-light shadow">
    <div class="card-header d-flex justify-content-between align-items-center border-light">
        <span>Listar Contas</span>
        <span>
            <a class="btn btn-dark" href="{{route('conta.create')}}">Cadastrar</a>
            <a class="btn btn-dark" href="{{ url('generate-pdf?' . request()->getQueryString()) }}">Gerar PDF</a>
        </span>
    </div>

    <!-- Verificar se existe a sessão success e imprimir o valor -->
    <x-alert />

    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">Valor</th>
                    <th scope="col">Vencimento</th>
                    <th scope="col">Situação</th>
                    <th scope="col" class="text-center">Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($contas as $conta)
                <tr>
                    <td>{{ $conta->name}}</td>
                    <td>{{ 'R$' . number_format($conta->value, 2, ',', '.')}}</td>
                    <td>{{ \Carbon\Carbon::parse($conta->expiration)->tz('America/Sao_Paulo')->format('d/m/Y')}}</td>
                    <td>
                        <span class="badge text-bg-{{ $conta->situacaoConta->color }}">
                            {{ $conta->situacaoConta->name }}
                        </span>
                    </td>


                    <td class="d-flex gap-2 justify-content-center">
                        <a class="btn btn-outline-secondary btn-sm" href="{{route('conta.show', ['conta' => $conta->id ])}}">Visualizar</a>
                        <a class="btn btn-outline-info btn-sm" href="{{route('conta.edit', ['conta' => $conta->id ])}}">Editar</a>

                        <form id="formDelete{{ $conta->id}}" action="{{ route('conta.destroy', ['conta' => $conta->id ])}}" method="POST">
                            @csrf
                            @method('delete')
                            <button class="btn btn-outline-danger btn-sm" type="submit" onclick="confirmeDelete(event, '{{ $conta->id }}')">Excluir</button>
                        </form>
                    </td>
                </tr>
                @empty
                <span style="color: #f00;">Nenhuma conta encontrada!</span>
                @endforelse
            </tbody>
        </table>
        {{ $contas->onEachSide(0)->links()}}
    </div>
</div>
@endsection