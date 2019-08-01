<?php

    include_once '../../global.php';

    class modeloEventoAluno extends BD {

    	public static $tabela = 'tb_evento_alunos';

    	public static function verificaAlunoEvento($id_evento, $id_aluno) {
    		return parent::selectFind(self::$tabela, "id_evento = $id_evento and id_aluno = $id_aluno");
    	}

        public static function getAlunos($id_evento) {
            return parent::selectAllWhere(self::$tabela, "id_evento = $id_evento");
        }        

    	public static function desvincular($id_evento, $id_aluno) {
    		return parent::delete(self::$tabela, "id_evento = $id_evento and id_aluno = $id_aluno");
    	}

    	public static function vincular($dados_evento_aluno) {
    		return parent::insert(self::$tabela, $dados_evento_aluno);
    	}
    }
?>
