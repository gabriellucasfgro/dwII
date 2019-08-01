<?php

    session_start();

    include_once '../../global.php';

    class controleCertificado {

        public static function index() {
            echo "<script>window.location='../view/viewCertificado.php'</script>";
        }

        public static function rota() {

        }
    }
