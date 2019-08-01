@extends('principal')

@section('script')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
@stop

@section('conteudo')

<div class="modal-dialog modal-md">
    <div class="modal-content">
        <div class="modal-body">
            <h3> $ {{ $municipio->nome }} RELATÓRIO DE VERBAS</b> $</h3>
                @if($municipio->id_porte == 1)
                    <h4> Educação: {{ (($municipio->nr_habitantes * 3) + $municipio->area) * 1.5 }} </h4>
                    <h4> Saúde: {{ (($municipio->nr_habitantes * 3) + $municipio->area) * 1.6 }} </h4>
                    <h4> Segurança; {{ (($municipio->nr_habitantes * 3) + $municipio->area) * 1.4 }} </h4>
                @elseif($municipio->id_porte == 2)
                    <h4> Educação: {{ (($municipio->nr_habitantes * 2) + $municipio->area) * 1.5 }} </h4>
                    <h4> Saúde: {{ (($municipio->nr_habitantes * 2) + $municipio->area) * 1.6 }} </h4>
                    <h4> Segurança; {{ (($municipio->nr_habitantes * 2) + $municipio->area) * 1.4 }} </h4>
                @elseif($municipio->id_porte == 3) 
                    <h4> Educação: {{ ($municipio->nr_habitantes + $municipio->area) * 1.5 }} </h4>
                    <h4> Saúde: {{ ($municipio->nr_habitantes + $municipio->area) * 1.6 }} </h4>
                    <h4> Segurança; {{ ($municipio->nr_habitantes + $municipio->area) * 1.4 }} </h4>
                @endif
        </div>
        <div class="modal-footer">
            <a href="{{ action('MunicipioController@listar') }}" type="button" class="btn btn-success">OK</a>
        </div>
    </div>
</div>
@stop
