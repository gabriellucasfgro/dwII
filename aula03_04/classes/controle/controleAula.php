<?php

    session_start();

    include_once '../../global.php';

    class controleAula {

        public static function index() {
            echo "<script>window.location='../view/viewAula.php'</script>";
        }

        public static function rota() {

            $dados = explode("/", $_POST['acao']);

            if(strcmp($dados[0], "cadastrar") == 0) {
                self::cadastrar();
            }
            else if(strcmp($dados[0], "alterar") == 0) {
                self::alterar($dados[1]);
            }
            else if(strcmp($dados[0], "remover") == 0) {
                self::remover($dados[1]);
            }
            else if(strcmp($dados[0], "confirmar") == 0) {
                self::confirmar($dados[1]);
            }
            else if(strcmp($dados[0], "finalizar") == 0) {
                self::finalizar($dados[1]);
            }
        }

        public static function cadastrar() {
            echo "<script>window.location='../view/viewAulaCadastrar.php'</script>";
        }

        public static function alterar($id) {

            $aula = modeloAula::findAula($id);

            if(empty($aula)) {
                $_SESSION['MSGBOX_TITULO'] = "OPERAÇÃO INVÁLIDA!";
                $_SESSION['MSGBOX_MSG'] = "O ID informado para a aula não existe!";
                $_SESSION['MSGBOX_LINK'] = "viewAula.php";
                $_SESSION['MSGBOX_CLASSE'] = "alert alert-danger";

                echo "<script>window.location='../view/viewMessagebox.php'</script>";
            }
            else {

                $url = "../view/viewAulaAlterar.php?id=$aula->id";
                $url .= "&conteudo=$aula->conteudo";
                $url .= "&data=$aula->data";

                echo "<script>window.location='".$url."'</script>";
            }
        }

        public static function remover($id) {

            $aula = modeloAula::findAula($id);

            if(empty($aula)) {
                $_SESSION['MSGBOX_TITULO'] = "OPERAÇÃO INVÁLIDA!";
                $_SESSION['MSGBOX_MSG'] = "O ID informado para a aula não existe!";
                $_SESSION['MSGBOX_LINK'] = "viewAula.php";
                $_SESSION['MSGBOX_CLASSE'] = "alert alert-danger";

                echo "<script>window.location='../view/viewMessagebox.php'</script>";
            }
            else {

                $url = "../view/viewAulaRemover.php?id=$aula->id";
                $url .= "&conteudo=$aula->conteudo";
                echo "<script>window.location='".$url."'</script>";
            }
        }

        public static function confirmar($id) {

            if($_POST['conteudo'] != "" && $_POST['data'] != "") {

                $dados_aula = array("conteudo" => mb_strtoupper($_POST['conteudo'], 'UTF-8'),
                    "data" => mb_strtoupper($_POST['data'], 'UTF-8')
                );

                // Inserir
                if($id == 0) {
                    modeloAula::addAula($dados_aula);
                    $_SESSION['MSGBOX_MSG'] = "A aula foi cadastrada no sistema!";
                }
                // Alterar
                else {
                    modeloAula::upAula($id, $dados_aula);
                    $_SESSION['MSGBOX_MSG'] = "Os dados da aula foram alterados no sistema!";
                }

                $_SESSION['MSGBOX_TITULO'] = "OPERAÇÃO REALIZADA COM SUCESSO!";
                $_SESSION['MSGBOX_LINK'] = "viewAula.php";
                $_SESSION['MSGBOX_CLASSE'] = "alert alert-success";

                echo "<script>window.location='../view/viewMessagebox.php'</script>";
            }
            else {
                $_SESSION['MSGBOX_TITULO'] = "OPERAÇÃO INVÁLIDA!";
                $_SESSION['MSGBOX_MSG'] = "Todos os campos devem ser preenchidos!";
                $_SESSION['MSGBOX_CLASSE'] = "alert alert-warning";

                if($id == 0) { $_SESSION['MSGBOX_LINK'] = "viewAulaCadastrar.php"; }
                else { $_SESSION['MSGBOX_LINK'] = "viewAulaAlterar.php"; }
            }
        }

        public static function finalizar($id) {

            modeloAula::delAula($id);

            $_SESSION['MSGBOX_TITULO'] = "OPERAÇÃO REALIZADA COM SUCESSO!";
            $_SESSION['MSGBOX_MSG'] = "A aula foi removida do sistema!";
            $_SESSION['MSGBOX_LINK'] = "viewAula.php";
            $_SESSION['MSGBOX_CLASSE'] = "alert alert-success";

            echo "<script>window.location='../view/viewMessagebox.php'</script>";
        }

        public static function loadTabelaAulas() {

            $aulas = modeloAula::getAulas();

            while($objAula = $aulas->fetchObject()) {

            	echo "<tr>";
                    echo "<td>".$objAula->id."</td>";
					echo "<td>".date("d/m/Y", strtotime($objAula->data))."</td>";
                    echo "<td>".$objAula->conteudo."</td>";
					echo "<td>";
						echo "<button type='submit' name='acao' value='alterar/".$objAula->id."'>";
							echo "<span class='glyphicon glyphicon-pencil'></span>";
						echo "</button>";
						echo "&nbsp";
						echo "<button type='submit' name='acao' value='remover/".$objAula->id."'>";
							echo "<span class='glyphicon glyphicon-remove'></span>";
						echo "</button>";
					echo "</td>";
				echo "</tr>";
    		}
    	}
    }
