@extends('principal')

@section('script')

<script type="text/javascript">

    // Eventos da Página
    $(document).ready(function() {

        // Botão Mais Tempo do Curso
        $("#bt_mais").click(function() {

            var val = parseInt($("#it_tempo").val());

            if(val < 6) {
                val = val + 1;
            }

            $("#it_tempo").attr('value', val);
        });

        // Botão Menos Tempo do Curso
        $("#bt_menos").click(function() {

            var val = parseInt($("#it_tempo").val());

            if(val > 1) {
                val = val - 1;
            }

            $("#it_tempo").attr('value', val);
        });
    });

</script>

@stop

@section('cabecalho')
<div>
        <a href="/curso">
            <img src=" {{ url('/img/cursop_ico.png') }}" >
        </a>
        &nbsp;Cadastrar Novo Curso
</div>
@stop

@section('conteudo')

<form action="{{ action('CursoController@salvar', 0) }}" method="POST">
    <input type ="hidden" name="_token" value="{{{ csrf_token() }}}">
    <input type ="hidden" name="cadastrar" value="C">

    <div class="row">
        <div class="col-sm-12">
            <label>Nome: </label>
            <input type="text" name="nome" class="form-control">
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-sm-4">
            <label>Abreviatura: </label>
            <input type="text" name="abreviatura" class="form-control">
        </div>

        <div class="col-sm-4">
            <label>Nivel: </label>
            <select name="nivel" class="form-control">
                <option disabled="true" selected="true"> </option>
	  			@foreach ($niveis as $dados)
                    <option> {{ $dados->id }} - {{ $dados->nome }} ({{ $dados->abreviatura }}) </option>
                @endforeach
	  		</select>
        </div>

        <div class="col-sm-4">
            <label>Tempo (anos): </label>
            <div class="input-group number-spinner">
				<span class="input-group-btn">
					<button type="button" class="btn btn-default" data-dir="up" id="bt_menos">
						<span class="glyphicon glyphicon-minus"></span>
					</button>
				</span>
				<input type="text" class="form-control text-center" name="tempo" id="it_tempo" readonly="true" value="3">
				<span class="input-group-btn">
					<button type="button" class="btn btn-default" data-dir="up" id="bt_mais">
						<span class="glyphicon glyphicon-plus"></span>
					</button>
				</span>
			</div>
        </div>
    </div>
    <br>
    <button type="submit" class="btn btn-success btn-block">Salvar</button>
</form>
@stop
