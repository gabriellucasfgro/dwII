<?php

    session_start();

    include_once '../../global.php';

    class controleCertificado {

        public static function index() {
            echo "<script>window.location='../view/viewCertificado.php'</script>";
        }

        public static function rota() {

            $dados = explode("/", $_POST['acao']);
            
            if(strcmp($dados[0], "gerar") == 0) {
                $dados = explode("#", $dados[1]);
                self::gerar($dados[0], $dados[1]);
            }
        }

        public static function gerar($id, $nome) {
            echo "<script>window.open('../../rotinas/gerarCertificados.php?id=$id&nome=$nome', '_blank')</script>";
        }
    }
