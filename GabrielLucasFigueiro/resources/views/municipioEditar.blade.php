@extends('principal')

@section('cabecalho')
<div>
        <a href="/municipio">
            <img src=" {{ url('/img/municipiop_ico.png') }}" >
        </a>
        &nbsp;Editar Municipio
</div>
@stop

@section('conteudo')

<form action="{{ action('MunicipioController@salvar', ['id' => $municipio->id]) }}" method="POST">
    <input type ="hidden" name="_token" value="{{{ csrf_token() }}}">
    <input type ="hidden" name="editar" value="E">

    <div class="row">
        <div class="col-sm-6">
            <label>Nome: </label>
            <input type="text" name="nome" value="{{ $municipio->nome }}" class="form-control">
        </div>

        <div class="col-sm-6">
            <label>Gestor: </label>
            <select name="gestor" class="form-control">
                @foreach ($gestores as $dados)
                    @if($dados->id == $municipio->id_gestor)
                        <option selected="true"> {{ $dados->id }} - {{ $dados->nome }} </option>
                    @else
                        <option> {{ $dados->id }} - {{ $dados->nome }} </option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-sm-4">
            <label>Número de Habitantes: </label>
            <input type="number" value="{{ $municipio->nr_habitantes }}" name="nr_habitantes" class="form-control">
        </div>

        <div class="col-sm-4">
            <label>Área Total: </label>
            <input type="number" value="{{ $municipio->area }}" name="area" class="form-control">
        </div>

        <div class="col-sm-4">
            <label>Porte: </label>
            <select name="porte" class="form-control">
	  			@foreach ($portes as $dados)
                    @if($dados->id == $municipio->id_porte)
                        <option selected="true"> {{ $dados->id }} - {{ $dados->descricao }} </option>
                    @else
                        <option> {{ $dados->id }} - {{ $dados->descricao }} </option>
                    @endif
                @endforeach
	  		</select>
        </div>
    </div>
    <br>
    <button type="submit" class="btn btn-success btn-block">Salvar</button>
</form>
@stop
