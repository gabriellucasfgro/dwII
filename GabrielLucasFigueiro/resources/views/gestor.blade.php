@extends('principal')

@section('cabecalho')
<div id="m_texto">
        <img src=" {{ url('/img/gestorp_ico.png') }}" >
        &nbsp;Gestores Cadastrados
</div>
@stop

@section('conteudo')

@if (old('cadastrar'))
    <div class="alert alert-success">
        <strong> {{ old('nome') }} </strong>: Cadastrado com Sucesso!
    </div>
@endif

@if (old('editar'))
    <div class="alert alert-success">
        <strong> {{ old('nome') }} </strong>: Alterado com Sucesso!
    </div>
@endif

<div class='row'>
    <div class='col-sm-8' style="text-align: center">
        <a  href="{{ action('GestorController@cadastrar') }}" type="button" class="btn btn-primary btn-block">
            <b>Cadastrar Novo Gestor</b>
        </a>
    </div>

    <div class='col-sm-3' style="text-align: center">
        <input type="text" list="gestores" class="form-control" autocomplete="on" placeholder="buscar">
        <datalist id="gestores">
            @foreach ($gestores as $dados)
                <option value="{{ $dados->nome }}">
            @endforeach
        </datalist>
    </div>

    <div class='col-sm-1' style="text-align: center">
        <button type="button" class="btn btn-default btn-block">
            <span class="glyphicon glyphicon-search"></span>
        </button>
    </div>
</div>
<br>
<table class='table table-striped'>
    <thead>
        <tr>
            <th>NOME DO GESTOR</th>
            <th>NASCIMENTO	</th>
            <th>EVENTOS</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($gestores as $dados)
        <tr>
            <td>{{ $dados->nome }}</td>
            <td>{{ $dados->nascimento }}</td>
            <td>
                <a href="{{ action('GestorController@editar', ['id' => $dados->id]) }}"><span class='glyphicon glyphicon-pencil'></span></a>
                &nbsp;
                <a href="{{ action('GestorController@remover', ['id' => $dados->id]) }}"><span class='glyphicon glyphicon-remove'></span></a>
            </td>

    @endforeach
    </tbody>
</table>

@stop
