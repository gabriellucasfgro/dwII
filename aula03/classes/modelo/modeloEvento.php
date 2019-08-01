<?php

    include_once '../../global.php';

    class modeloEvento extends BD {

        public static $tabela = 'tb_evento';

        public static function getEventos() {
            return parent::selectAll(self::$tabela, "ORDER BY nome");
        }

        public static function getEvento($id) {
            return parent::selectAll(self::$tabela, "id = $id");
        }

        public static function findEvento($id) {
            return parent::selectFind(self::$tabela, "id = $id");
        }
    }
?>
