@extends('layouts.admin')

@section('content')
<div class="card mt-4 mb-4 border-light shadow">
    <div class="card-header d-flex justify-content-between align-items-center border-light">
        <span>Cadastrar Conta</span>
        <span class="d-flex gap-2">
            <a class="btn btn-dark" href="{{route('conta.index')}}">Listar</a>
        </span>
    </div>

    <!-- Verificar se existe a sessão success e imprimir o valor -->
    <x-alert />

    <div class="card-body">
        <form action="{{ route('conta.store')}}" method="POST" class="row g-3">
            @csrf

            <div class="col-md-12 col-sm-12">
                <label class="form-label" for="name">Nome</label>
                <input class="form-control" type="text" name="name" id="name" placeholder="Nome da conta" value="{{ old('name') }}">
            </div>

            <div class="col-md-4 col-sm-12">
                <label class="form-label" for="value">Valor</label>
                <input class="form-control" type="text" name="value" id="value" placeholder="Valor da conta" value="{{ old('value') }}">
            </div>

            <div class="col-md-4 col-sm-12">
                <label class="form-label" for=" expiration">Vencimento</label>
                <input class="form-control" type="date" name="expiration" id="expiration" value="{{ old('expiration') }}">
            </div>

            <div class="col-md-4 col-sm-12">
                <label class="form-label" for="situacao_conta_id">Situação da conta</label>
                <select name="situacao_conta_id" id="situacao_conta_id" class="form-select">
                    <option value="">Selecione</option>
                    @forelse($situacoesContas as $situacaoConta)
                    <option value="{{ $situacaoConta->id }}" {{ old('situacao_conta_id', '') == $situacaoConta->id ? 'selected' : '' }}>
                        {{$situacaoConta->name}}
                    </option>

                    @empty
                    <option value="">Nenhuma situação encontrada</option>
                    @endforelse
                </select>
            </div>

            <div class="col-12">
                <button class="btn btn-success" type="submit">Cadastrar</button>
            </div>
        </form>
    </div>
</div>
@endsection