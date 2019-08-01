<?php

	require 'Slim/Slim.php';
	\Slim\Slim::registerAutoloader();

	$app = new \Slim\Slim();

	// CONEXÃO COM O BD
	function getConn() {

		return new PDO('mysql:host=127.0.0.1;dbname=webservice', 'root', '',
				array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
	}

	function validaCPF($cpf = null) {

		// Verifica se um número foi informado
		if(empty($cpf)) {
			return false;
		}

		// Elimina possivel mascara
		$cpf = preg_replace("/[^0-9]/", "", $cpf);
		$cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);
		
		// Verifica se o numero de digitos informados é igual a 11 
		if (strlen($cpf) != 11) {
			return false;
		}
		// Verifica se nenhuma das sequências invalidas abaixo 
		// foi digitada. Caso afirmativo, retorna falso
		else if ($cpf == '00000000000' || 
			$cpf == '11111111111' || 
			$cpf == '22222222222' || 
			$cpf == '33333333333' || 
			$cpf == '44444444444' || 
			$cpf == '55555555555' || 
			$cpf == '66666666666' || 
			$cpf == '77777777777' || 
			$cpf == '88888888888' || 
			$cpf == '99999999999') {
			return false;
		 // Calcula os digitos verificadores para verificar se o
		 // CPF é válido
		 } else {   
			
			for ($t = 9; $t < 11; $t++) {
				
				for ($d = 0, $c = 0; $c < $t; $c++) {
					$d += $cpf{$c} * (($t + 1) - $c);
				}
				$d = ((10 * $d) % 11) % 10;
				if ($cpf{$c} != $d) {
					return false;
				}
			}

			return true;
		}
	}

	$app->get('/', function() {
		echo "<h1>Web Service: GET / POST / PUT / DELETE!</h1>";
	});

	$app->post('/val', function() use ($app) {

		$dadoJson = json_decode( $app->request()->getBody() );
		
		if(validaCPF($dadoJson)) {
			echo json_encode( array('msg' => "[OK] CPF Válido!") );
		} else {
			echo json_encode( array('msg' => "[ERRO] CPF Inválido!") );
		}



	});

	$app->post('/aut', function() use ($app) {

		$dadoJson = json_decode( $app->request()->getBody() );

		$conn = getConn();
		$sql = "SELECT * FROM tb_usuario WHERE usuario = :usuario AND senha = :senha";
		$stmt = $conn->prepare($sql);	
		$stmt->bindParam("usuario", $dadoJson->usuario);
		$stmt->bindParam("senha", $dadoJson->senha);	
		$stmt->execute();
		$num = $stmt->rowCount();
		if($num == 1) {
			echo json_encode( array('msg' => "[OK] Usuario atenticado com Sucesso!") );
		}
		else {
			echo json_encode( array('msg' => "[ERRO] Usuario não encontrado!") );
		}
	});


	// POST - Inserir
	$app->post('/cad', function() use ($app) {

		$dadoJson = json_decode( $app->request()->getBody() );

		$sql = "INSERT INTO tb_usuario (nome, usuario, senha) values(:nome, :usuario, :senha)";
		$conn = getConn();
		$stmt = $conn->prepare($sql);
		$stmt->bindParam("nome", $dadoJson->nome);
		$stmt->bindParam("usuario", $dadoJson->usuario);
		$stmt->bindParam("senha", $dadoJson->senha);
		$stmt->execute();
		$id = $conn->lastInsertId();

		echo json_encode( array('msg' => "[OK] Usuario ($dadoJson->nome) Cadastro com Sucesso!") );
	});


	$app->run();
?>
