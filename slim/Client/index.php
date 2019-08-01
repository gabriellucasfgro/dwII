<?php

	include_once('rotinas.php');

	if( !empty($_POST['form_submit']) ) {

		if($_POST['botao'] == "cadastro") {
			$cadastro = CADASTRO();
		}
		else if($_POST['botao'] == "autenticacao") {
			$autenticacao = AUTENTICACAO();
		}
		else if($_POST['botao'] == "validacao") {
			$validacao = VALIDACAO();
		}
    }
	else {
		$cadastro = "";
		$autenticacao = "";
		$validacao = "";
	}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="img/umidae_icon.ico">

    <title>Framework Slim</title>

    <!-- Bootstrap core CSS -->
    <link href="bs/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="bs/themes/signin.css" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

  </head>

  <body role="document">
    <!-- Fixed navbar -->
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand">Requisições: GET / POST / PUT / DELETE</a>
        </div>
	<div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container theme-showcase" role="main">

		<form class="form" method="post" action="index.php">
	    	<input TYPE="hidden" NAME="form_submit" VALUE="OK">

			<div class="page-header">
				<h1 class="form-signin-heading">
					<div id="m_texto">Cliente Web Service (Slim)</div>
				</h1>
			</div>

			<div class='row'>
				<div class='col-sm-4'>
					<label>Nome</label>
					<input type="text" class="form-control" name="nome_cadastro" >
					<label>Usuário</label>
					<input type="text" class="form-control" name="usuario_cadastro" >
					<label>Senha</label>
					<input type="text" class="form-control" name="senha_cadastro" >
					<br>
					<button type="submit" name="botao" value="cadastro" class="btn btn-success btn-block">
						<b> Confirmar / Cadastrar </b>
					</button>
					<br>
					<?php
						if($cadastro != "") {
							echo "<div class='alert alert-success' role='alert'>";
								$dadoJson = json_decode($cadastro);

								echo "<strong>Retorno do Web Service!</strong>";

								if($dadoJson->msg != null) {
									echo "<br>$dadoJson->msg";
								}
								else {
									echo "<br>Erro desconhecido";
								}

			 				echo "</div>";
						}
					?>
				</div>

				<!-- POST -->
				<div class='col-sm-4'>
					<br>
					<label>Usuário</label>
					<input type="text" class="form-control" name="usuario_autenticacao" >
					<label>Senha</label>
					<input type="text" class="form-control" name="senha_autenticacao" >
					<br>
					<button type="submit" name="botao" value="autenticacao" class="btn btn-primary btn-block">
						<b> Confirmar / Autenticar </b>
					</button>
					<?php
						if($autenticacao != "") {
							echo "<br><div class='alert alert-success' role='alert'>";
								$dadoJson = json_decode($autenticacao);
								$msg = $dadoJson->{'msg'};
			   					echo "<strong>Retorno do Web Service!</strong><br>$msg";
			 				echo "</div>";
						}
					?>
				</div>

				<!-- PUT -->
				<div class='col-sm-4'>
					<br>
					<label>CPF</label>
					<input type="text" class="form-control" name="cpf_validacao" maxlength="11">
					<br>
					<?php
						if($validacao != "") {
							echo "<div class='alert alert-success' role='alert'>";
								$dadoJson = json_decode($validacao);
								$msg = $dadoJson->{'msg'};
			   					echo "<strong>Retorno do Web Service!</strong><br>$msg";
			 				echo "</div>";
						}
					?>
					<button type="submit" name="botao" value="validacao" class="btn btn-warning btn-block">
						<b> Confirmar / Validar</b>
					</button>
				</div>
			</div>
		</form>

		<div class="page-header">
			<b>&copy;2018&nbsp;&nbsp;&raquo;&nbsp;&nbsp; Gil Eduardo de Andrade</b>
		</div>
    </div> <!-- /container -->

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
