@extends('principal')

@section('cabecalho')
<div id="m_texto">
        <img src=" {{ url('/img/municipiop_ico.png') }}" >
        &nbsp;Municipios Cadastrados
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
        <a  href="{{ action('MunicipioController@cadastrar') }}" type="button" class="btn btn-primary btn-block">
            <b>Cadastrar Novo Municipio</b>
        </a>
    </div>

    <div class='col-sm-3' style="text-align: center">
        <input type="text" list="municipios" class="form-control" autocomplete="on" placeholder="buscar">
        <datalist id="municipios">
            @foreach ($municipios as $dados)
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
<div class="table-responsive" style="overflow-x: visible; overflow-y: visible;">
    <table class='table table-striped'>
        <thead>
            <tr>
                <th>ID</th>
                <th>NOME</th>
                <th>GESTOR</th>
                <th>NR DE HABITANTES</th>
                <th>ÁREA TOTAL</th>
                <th>PORTE</th>
                <th>EVENTOS</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($municipios as $dados)
            <tr>
                <td>{{ $dados->id }}</td>
                <td>{{ $dados->nome }}</td>
                <td>
                    @foreach($gestores as $data)
                        @if($data->id == $dados->id_gestor)
                            {{ $data->nome }}
                        @endif
                    @endforeach
                </td>
                <td>{{ $dados->nr_habitantes }} </td>
                <td>{{ $dados->area }}</td>
                <td>
                    @foreach($portes as $data)
                        @if($data->id == $dados->id_porte)
                            {{ $data->descricao }}
                        @endif
                    @endforeach
                </td>

                <td>
                    <a href="{{ action('MunicipioController@editar', $dados->id) }}"><span class='glyphicon glyphicon-pencil'></span></a>
                    &nbsp;
                    <a href="{{ action('MunicipioController@remover', $dados->id) }}"><span class='glyphicon glyphicon-remove'></span></a>
                    &nbsp;
                    <a href="{{ action('MunicipioController@relatorio', $dados->id) }}"><span class='glyphicon glyphicon-education'></span></a>
                </td>
        @endforeach
        </tbody>
    </table>
</div>
@stop