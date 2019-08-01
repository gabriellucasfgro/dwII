<?php

    include_once '../../global.php';

    class modeloAula extends BD {

        public static $tabela = 'tb_aula';

        public static function getAulas() {

            return parent::selectAll(self::$tabela, "ORDER BY data");
        }

        public static function findAula($id) {

            return parent::selectFind(self::$tabela, "id = $id");
        }

        public static function addAula($dados_aula) {

            return parent::insert(self::$tabela, $dados_aula);
        }

        public static function upAula($id, $dados) {

            return parent::update(self::$tabela, $dados, "id = $id");
        }

        public static function delAula($id) {

            return parent::delete(self::$tabela, "id = $id");
        }
    }
