@extends('principal')

@section('script')

<script type="text/javascript">
    // Eventos da Página
    $(document).ready(function() {

        // Botão Mais Tempo do Curso
        $("#bt_mais").click(function() {

            var val = parseInt($("#it_ano").val());
            val = val + 1;

            $("#it_ano").attr('value', val);
        });

        // Botão Menos Tempo do Curso
        $("#bt_menos").click(function() {

            var val = parseInt($("#it_ano").val());
            if(val > 2008) { val = val - 1; }

            $("#it_ano").attr('value', val);
        });
    });
</script>

@stop

@section('cabecalho')
<div>
        <a href="/turma">
            <img src=" {{ url('/img/turmap_ico.png') }}" >
        </a>
        &nbsp;Turmas Cadastradas
</div>
@stop

@section('conteudo')

<form action="{{ action('TurmaController@salvar', ['id' => 0]) }}" method="POST">
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
        <div class="col-sm-10">
            <label>Curso: </label>
            <select name="curso" class="form-control">
                <option disabled="true" selected="true"> </option>
	  			@foreach ($cursos as $dados)
                    <option> {{ $dados->id }} - {{ $dados->nome }} ( {{ $dados->abreviatura }} ) </option>
                @endforeach
	  		</select>
        </div>

        <div class="col-sm-2">
            <label>Ano: </label>
            <div class="input-group number-spinner">
				<span class="input-group-btn">
					<button type="button" class="btn btn-default" data-dir="up" id="bt_menos">
						<span class="glyphicon glyphicon-minus"></span>
					</button>
				</span>
				<input type="text" class="form-control text-center" name="ano" id="it_ano" readonly="true" value="{{ $data_ano }}">
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
