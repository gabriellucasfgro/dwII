<?php 
	
	function escreverArquivoArray($arr) {

		$fp = fopen('pf.txt', 'a+');

		if ($fp) {
			foreach($arr as $cpf => $dados) {
				if(!empty($dados)) {
					$linha = $cpf;
					fputs($fp, "$linha\n");
					$linha = $dados['nome']."#".$dados['endereco']."#".$dados['telefone'];
					fputs($fp, "$linha\n");
				}
			}

			fclose($fp);
		}
	}

	function lerMontarArray() {

		$pessoas = array();
		$fp = fopen('pf.txt', 'r');

        if ($fp) {

            while(!feof($fp)) {
				$arr = array();
                $cpf = fgets($fp);
				$dados = fgets($fp);
				if(!empty($dados)) {
					$arr = explode("#", $dados);
					$pessoas[$cpf] = $arr;
				}
			}

			fclose($fp);
			return $pessoas;
		}
	}

 ?>