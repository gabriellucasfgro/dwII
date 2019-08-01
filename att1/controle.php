<?php

	include("modelo.php"); 

	function rotas($post) {


		$dados = explode("/", $post['acao']);

		// CADASTRAR
		if(strcmp($dados[0], "cadastar") == 0) {
			header('Location: /att1/viewCadastrar.php');
		}
		// ALTERAR
		else if(strcmp($dados[0], "alterar") == 0) {
			header('Location: /att1/viewAlterar.php');
		}
		// REMOVER
		else if(strcmp($dados[0], "remover") == 0){
		}
		//CONFIRMAR ALTERACAO/CADASTRO
		else if(strcmp($dados[0], "confirmar") == 0) {

			$pessoas = array(
				$post['cpf'] => array(
					"nome" => $post['nome'],
					"endereco" => $post['endereco'],
					"telefone" => $post['telefone'],
				)
			);
			
			escreverArquivoArray($pessoas);
			header('Location: /att1/index.php');
		}
		//CANCELAR
		else if(strcmp($dados[0], "cancelar") == 0) {
			header('Location: /att1/index.php');
		}
	}

	function loadTabela() {

		$pessoas = lerMontarArray();

		foreach ($pessoas as $cpf => $dados) {

			if(!empty($dados)) {
				echo "<tr>";
					echo "<td>".$cpf."</td>";

					foreach ($dados as $valor) {
						echo "<td>".$valor."</td>";
					}

					echo "<td>";
						echo "<button type='submit' name='acao' value='alterar/'".$cpf.">";
							echo "<span class='glyphicon glyphicon-pencil'></span>";
						echo "</button>";
						echo "&nbsp";
						echo "<button type='submit' name='acao' value='remover/'".$cpf.">";
							echo "<span class='glyphicon glyphicon-remove'></span>";
						echo "</button>";
					echo "</td>";
				echo "</tr>";
			}
		}
	}

?>