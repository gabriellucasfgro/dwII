<!DOCTYPE html>
<html>
<head>
    <title>SisCadPF</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</head>
<?php
    error_reporting(E_ALL);
    ini_set("display_errors", 1);

    include_once ("controle.php");

    if(!empty($_POST['form_submit']) ) {
        rotas($_POST);
    }
?>

<body role="document">
        <form class="form" method="post">
        <input TYPE="hidden" NAME="form_submit" VALUE="OK">
            <br><br>
            <div class='row'>
                <div class='col-sm-6'>
                    <button type="submit" name="acao" value="confirmar/1" class="btn btn-success btn-block">
                        <b>Confirmar</b>
                    </button>
                </div>
                <div class='col-sm-6'>
                    <button type="submit" name="acao" value="cancelar/2" class="btn btn-danger btn-block">
                        <b>Cancelar</b>
                    </button>
                </div>
            </div>
            <br>
            <div class='row'>
        		<div class='col-sm-6'>
                    <label class="sr-only">CPF</label>
                    <input type="text" class="form-control" name="cpf" maxlength="15" placeholder="CPF" autofocus>
                </div>
                <div class='col-sm-6'>
                    <label class="sr-only">nome</label>
                    <input type="text" class="form-control" name="nome" maxlength="40"  placeholder="Nome" autofocus>
                </div>
            </div>
            <div class='row'>
                <div class='col-sm-6'>
                    <label class="sr-only">telefone</label>
                    <input type="text" class="form-control" name="telefone" maxlength="15" placeholder="Telefone" autofocus>
                </div>
                <div class='col-sm-6'>
                    <label class="sr-only">endereco</label>
                    <input type="text" class="form-control" name="endereco" maxlength="40"  placeholder="Endereço" autofocus>
                </div>
            </div>
        </form>
    </body>
</html>