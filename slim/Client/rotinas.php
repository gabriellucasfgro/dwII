<?php

	function getConn() {

		return new PDO('mysql:host=localhost;dbname=webservice', 'root', '',
					array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
	}

	function AUTENTICACAO() {

		// DADO DE ENTRADA VAZIO - ERRO
		if($_POST['usuario_autenticacao'] == "" || $_POST['senha_autenticacao'] == "") {
		 	return json_encode( array('msg' => '[ERRO] Preencha o Campo de Entrada!') );
		}

		// MONTA ARRAY DE DADOS
		$dados = array('usuario' => $_POST['usuario_autenticacao'], 'UTF-8',
						'senha' => $_POST['senha_autenticacao'], 'UTF-8');

		$curl = curl_init("http://localhost/slim/rest.php/aut");
		// CONFIGURA AS OPÇÕES (parâmetros)
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_POST, 'POST');
		curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($dados));
		// INVOCA A URL DO WEBSERVICE
		$curl_resposta = curl_exec($curl);
		curl_close($curl);


		return $curl_resposta;
	}

	function VALIDACAO() {

		// DADO DE ENTRADA VAZIO - ERRO
		if($_POST['cpf_validacao'] == "") {
		 	return json_encode( array('msg' => '[ERRO] Preencha o Campo de Entrada!') );
		}

		// MONTA ARRAY DE DADOS
		$cpf = $_POST['cpf_validacao'];

		// INICIALIZA/CONFIGURA CURL
		$curl = curl_init("http://localhost/slim/rest.php/val");
		// CONFIGURA AS OPÇÕES (parâmetros)
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_POST, 'POST');
		curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($cpf));
		// INVOCA A URL DO WEBSERVICE
		$curl_resposta = curl_exec($curl);
		curl_close($curl);

		return $curl_resposta;
	}

	function CADASTRO() {

		// DADO DE ENTRADA VAZIO - ERRO
		if($_POST['nome_cadastro'] == "" || $_POST['usuario_cadastro'] == "" || $_POST['senha_cadastro'] == "") {
		 	return json_encode( array('msg' => '[ERRO] Preencha o Campo de Entrada!') );
		}

		// MONTA ARRAY DE DADOS
		$dados = array('nome' => mb_strtoupper($_POST['nome_cadastro'], 'UTF-8'),
						'usuario' => $_POST['usuario_cadastro'], 'UTF-8',
						'senha' => $_POST['senha_cadastro'], 'UTF-8');

		// INICIALIZA/CONFIGURA CURL
		
		$curl = curl_init("http://localhost/slim/rest.php/cad");
		// CONFIGURA AS OPÇÕES (parâmetros)
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_POST, 'POST');
		curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($dados));
		// INVOCA A URL DO WEBSERVICE
		$curl_resposta = curl_exec($curl);
		curl_close($curl);

		return $curl_resposta;
	}

?>
