<?php

    include_once 'global.php';

    class controleMain {

        public static function index() {
            echo "<script>window.location='classes/view/viewMain.php'</script>";
        }

        public static function rota() {

            $dados = explode("/", $_POST['acao']);

            if(strcmp($dados[0], "aluno") == 0) {
                controleAluno::index();
            }
            else if(strcmp($dados[0], "evento") == 0) {
                controleEvento::index();
            }
            else if(strcmp($dados[0], "certificado") == 0) {
                controleCertificado::index();
            }
            else if(strcmp($dados[0], "aula") == 0) {
                controleAula::index();
            }
            else if(strcmp($dados[0], "frequencia") == 0) {
                controleFrequencia::index();
            }
            else if(strcmp($dados[0], "gerarFreq") == 0) {
                controleFrequencia::gerar();
            }
        }
    }
