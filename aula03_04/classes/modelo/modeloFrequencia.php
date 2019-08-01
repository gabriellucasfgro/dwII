<?php

    include_once '../../global.php';

    class modeloFrequencia extends BD {

    	public static $tabela = 'tb_frequencia';

    	public static function verificaAlunoFrequencia($id_aula, $id_aluno) {
    		return parent::selectFind(self::$tabela, "id_aula = $id_aula and id_aluno = $id_aluno");
    	}

    	public static function remFrequencia($id_aula, $id_aluno) {
    		return parent::delete(self::$tabela, "id_aula = $id_aula and id_aluno = $id_aluno");
    	}

    	public static function addFrequencia($dados_aluno_frequencia) {
    		return parent::insert(self::$tabela, $dados_aluno_frequencia);
    	}
    }
?>
