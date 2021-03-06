@extends('principal')

@section('cabecalho')
<div>
        <a href="/municipio">
            <img src=" {{ url('/img/municipiop_ico.png') }}" >
        </a>
        &nbsp;Cadastrar Novo Municipio
</div>
@stop

@section('conteudo')

<form action="{{ action('MunicipioController@salvar', ['id' => 0]) }}" method="POST">
    <input type ="hidden" name="_token" value="{{{ csrf_token() }}}">
    <input type ="hidden" name="cadastrar" value="C">

    <div class="row">
        <div class="col-sm-6">
            <label>Nome: </label>
            <input type="text" name="nome" class="form-control">
        </div>

        <div class="col-sm-6">
            <label>Gestor: </label>
            <select name="gestor" class="form-control">
                <option disabled="true" selected="true"> </option>
                @foreach ($gestores as $dados)
                    <option> {{ $dados->id }} - {{ $dados->nome }} </option>
                @endforeach
            </select>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-sm-4">
            <label>Número de Habitantes: </label>
            <input type="number" name="nr_habitantes" class="form-control">
        </div>

        <div class="col-sm-4">
            <label>Área Total: </label>
            <input type="number" name="area" class="form-control">
        </div>

        <div class="col-sm-4">
            <label>Porte: </label>
            <select name="porte" class="form-control">
                <option disabled="true" selected="true"> </option>
	  			@foreach ($portes as $dados)
                    <option>{{ $dados->id }} - {{ $dados->descricao }} </option>
                @endforeach
	  		</select>
        </div>
    </div>
    <br>
    <button type="submit" class="btn btn-success btn-block">Salvar</button>
</form>
@stop
