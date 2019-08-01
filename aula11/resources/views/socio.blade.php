@extends('principal')

@section('script')
<script type="text/javascript" src="{{ url('/js/plugins/mask/jquery.mask.js') }}"></script>

<script type="text/javascript">

    // Função de abertura do arquivo
    function bs_input_file() {

        $(".input-file").before(
            function() {
                if ( ! $(this).prev().hasClass('input-ghost') ) {
                    var element = $("<input type='file' class='input-ghost' style='visibility:hidden; height:0'>");
                    element.attr("name", $(this).attr("name"));
                    element.change(function(){
                        element.next(element).find('input').val((element.val()).split('\\').pop());
                    });
                    $(this).find("button.btn-choose").click(function(){
                        element.click();
                    });
                    $(this).find("button.btn-reset").click(function(){
                        element.val(null);
                        $(this).parents(".input-file").find('input').val('');
                    });
                    $(this).find('input').css("cursor","pointer");
                    $(this).find('input').mousedown(function() {
                        $(this).parents('.input-file').prev().click();
                        return false;
                    });
                    return element;
                }
            }
        );
    }

    $(function() {
        bs_input_file();
    });

</script>

@stop

@section('cabecalho')
<div>
        &nbsp;Socios Cadastrados
</div>
@stop

@section('conteudo')

@if (old('cadastrar'))
    <div class="alert alert-success">
        <strong> {{ old('nome') }} </strong>: Cadastrado com Sucesso!
    </div>
@endif

<div class='row'>
    <h3>Cadastrar Sócios</h3>

    <form action="{{ action('SocioController@salvar') }}" method="POST">
    <input type ="hidden" name="_token" value="{{{ csrf_token() }}}">
    <input type ="hidden" name="cadastrar" value="C">

    <div class="row">
        <div class="col-sm-6">
            <label>Nome: </label>
            <input type="text" name="nome" class="form-control">
        </div>
        <div class="col-sm-6">
            <label>E-mail: </label>
            <input type="text" name="email" class="form-control">
        </div>
    </div>
    <br>

    <button type="submit" class="btn btn-success btn-block">Cadastrar</button>
</form>
</div>
<br>

    <form action="{{ action('EmailController@concluir') }}" method="POST" enctype="multipart/form-data">
    <input type ="hidden" name="_token" value="{{{ csrf_token() }}}">
    <input type ="hidden" name="importar" value="I">
<table class='table table-striped'>
    <thead>
        <tr>
            <th>ID</th>
            <th>NOME</th>
            <th>EMAIL</th>
            <th>ENVIAR RELATÓRIO</th>
        </tr>
    </thead>

    <tbody>
    @foreach ($socios as $dados)
        <tr>
            <td>{{ $dados->id }}</td>
            <td>{{ $dados->nome }}</td>
            <td>{{ $dados->email }}</td>
            <td>
                <input type='checkbox' class='form-check-input' name='ck_{{$dados->id}}'  id='ck_{{$dados->id}}'>
            </td>
        </td>
    @endforeach
    </tbody>
</table>
<br>  
    <div class='row'>
        <div class="col-sm-6">
            <label>Arquivo de e-mails: </label>
            <div class="input-group input-file" name="arq">
                <span class="input-group-btn">
                    <button class="btn btn-success btn-choose" type="button">Abrir Navegador</button>
                </span>
                <input type="text" class="form-control" placeholder='Nenhum arquivo selecionado...' />
            </div>
        </div>
        <div class="col-sm-6">
            <button type="submit" class="btn btn-success btn-block"><b>Enviar</b></button>
        </div>
    </div>
</form>
@stop
