@extends('principal')

@section('cabecalho')
<div>
        <a href="/gestor">
            <img src=" {{ url('/img/gestorp_ico.png') }}" >
        </a>
        &nbsp;Editar Gestor
</div>
@stop

@section('conteudo')

<form action="{{ action('GestorController@salvar', ['id' => $gestor->id]) }}" method="POST">
    <input type ="hidden" name="_token" value="{{{ csrf_token() }}}">
    <input type ="hidden" name="editar" value="E">

    <div class="row">
        <div class="col-sm-6">
            <label>Nome: </label>
            <input type="text" name="nome" value="{{ $gestor->nome }}" class="form-control">
        </div>
        <div class="col-sm-3">
            <label>Data: </label>
            <input type="date" name="nascimento" value="{{ $gestor->nascimento }}" class="form-control" placeholder="Data de Nascimento">
        </div>
    </div>
    <br>
    <button type="submit" class="btn btn-warning btn-block"><b>Alterar</b></button>
</form>
@stop
