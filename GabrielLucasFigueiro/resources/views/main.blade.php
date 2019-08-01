@extends('principal')

@section('cabecalho')
<div id="m_texto">
        <img src=" {{ url('/img/homep_ico.png') }}" >
        &nbsp;Menu Principal
</div>
@stop

@section('conteudo')
<div class='row'>

    <div class='col-sm-3' style="text-align: center">
        <a href="/gestor">
            <img src="{{ url('/img/gestor_ico.png') }}">
        </a>
        <h3> Gestor </h3>
    </div>

    <div class='col-sm-3' style="text-align: center">
        <a href="/municipio">
            <img src="{{ url('/img/municipio_ico.png') }}">
        </a>
        <h3> Municipio </h3>
    </div>

</div>

@stop
