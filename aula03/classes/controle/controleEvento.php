<?php

    session_start();

    include_once '../../global.php';

    class controleEvento {

        public static function index() {
            echo "<script>window.location='../view/viewEvento.php'</script>";
        }

        public static function rota() {

            $dados = explode("/", $_POST['acao']);

            if(strcmp($dados[0], "vincular") == 0) {
                self::vincular($dados[1]);
            }
            else if(strcmp($dados[0], "concluir") == 0) {
                self::concluir($dados[1]);
            }

        }

        public static function concluir($id) {

             $alunos = modeloAluno::getAlunos();

            while($objAluno = $alunos->fetchObject()) {
                if(isset($_POST["ck_$objAluno->id"])) {
                    $vinculado = modeloEventoAluno::verificaAlunoEvento($id, $objAluno->id);
                    if(empty($vinculado)) {
                        $dados_evento_aluno = array("id_evento" => $id,
                            "id_aluno" => $objAluno->id
                        );
                        modeloEventoAluno::vincular($dados_evento_aluno);
                    }
                }
                else {
                    $vinculado = modeloEventoAluno::verificaAlunoEvento($id, $objAluno->id);
                    if(!empty($vinculado)) {
                        modeloEventoAluno::desvincular($id, $objAluno->id);
                    }
                }
            }
        }

        public static function vincular($id) {

            $evento = modeloEvento::findEvento($id);

            if(empty($evento)) {
                $_SESSION['MSGBOX_TITULO'] = "OPERAÇÃO INVÁLdIDA!";
                $_SESSION['MSGBOX_MSG'] = "O ID informado para o evento não existe!";
                $_SESSION['MSGBOX_LINK'] = "viewEvento.php";
                $_SESSION['MSGBOX_CLASSE'] = "alert alert-danger";

                echo "<script>window.location='../view/viewMessagebox.php'</script>";
            }
            else {

                $url = "../view/viewEventoVincular.php?id=$evento->id";
                $url .= "&nome=$evento->nome";

                echo "<script>window.location='".$url."'</script>";
            }
        }

        public static function loadTabelaEventos() {

            $eventos = modeloEvento::getEventos();

            while($objEvento = $eventos->fetchObject()) {

            	echo "<tr>";
                    echo "<td>".$objEvento->id."</td>";
					echo "<td>".$objEvento->nome."</td>";
                    echo "<td>".$objEvento->data."</td>";
                    echo "<td>".$objEvento->carga_horaria." horas</td>";
                    echo "<td>".$objEvento->responsavel."</td>";

					echo "<td>";
						echo "<button type='submit' name='acao' value='alterar/".$objEvento->id."'>";
							echo "<span class='glyphicon glyphicon-pencil'></span>";
						echo "</button>";
						echo "&nbsp";
						echo "<button type='submit' name='acao' value='remover/".$objEvento->id."'>";
							echo "<span class='glyphicon glyphicon-remove'></span>";
						echo "</button>";
                        echo "&nbsp";
						echo "<button type='submit' name='acao' value='vincular/".$objEvento->id."'>";
							echo "<span class='glyphicon glyphicon-check'></span>";
						echo "</button>";
					echo "</td>";
				echo "</tr>";
    		}
    	}

        public static function loadOpcoes() {

            $eventos = modeloEvento::getEventos();

            while($objEvento = $eventos->fetchObject()) {
                echo "<option value='$objEvento->id#$objEvento->nome'>".$objEvento->nome."</option>";
            }
        }

         public static function loadTabelaVincularAlunos($id) {

            $alunos = modeloAluno::getAlunos();

            while($objAluno = $alunos->fetchObject()) {

                echo "<tr>";
                    $vinculado = modeloEventoAluno::verificaAlunoEvento($id, $objAluno->id);
                    if(empty($vinculado)) {
                        echo "<td>";
                            echo "<input type='checkbox' class='form-check-input' name='ck_$objAluno->id'  id='ck_$objAluno->id'>";
                            echo "&nbsp;&nbsp;";
                            echo "<label id='lb_$objAluno->id'>NÃO</label>";
                            echo "&nbsp;&nbsp;";
                        echo "</td>";
                    }
                    else {
                        echo "<td>";
                            echo "<input type='checkbox' class='form-check-input' checked='' name='ck_$objAluno->id'  id='ck_$objAluno->id'>";
                            echo "&nbsp;&nbsp;";
                            echo "<label id='lb_$objAluno->id'>SIM</label>";
                            echo "&nbsp;&nbsp;";
                        echo "</td>";
                    }
                    echo "<td>".$objAluno->nome."</td>";
                    echo "<td>".$objAluno->curso."</td>";
                    echo "<td>".$objAluno->turma."</td>";

                    echo "<td>";
                        echo "<button type='submit' name='acao' value='alterar/".$objAluno->id."'>";
                            echo "<span class='glyphicon glyphicon-pencil'></span>";
                        echo "</button>";
                        echo "&nbsp";
                        echo "<button type='submit' name='acao' value='remover/".$objAluno->id."'>";
                            echo "<span class='glyphicon glyphicon-remove'></span>";
                        echo "</button>";
                    echo "</td>";
                echo "</tr>";
            }
        }
    }
