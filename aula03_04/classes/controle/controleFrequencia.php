<?php

    session_start();

    include_once '../../global.php';

    class controleFrequencia {

        public static function index() {
            echo "<script>window.location='../view/viewFrequencia.php'</script>";
        }

        public static function gerar() {
            echo "<script>window.open('../../rotinas/gerarFrequencia.php', '_blank')</script>";
        }

        public static function rota() {

            $dados = explode("/", $_POST['acao']);

            if(strcmp($dados[0], "concluir") == 0) {
                self::concluir();
            }
        }

        public static function concluir() {

            $alunos = modeloAluno::getAlunos();

            while($objAluno = $alunos->fetchObject()) {

                $aulas = modeloAula::getAulas();

                while($objAula = $aulas->fetchObject()) {

                    if($_POST['n_'.$objAula->id.'#'.$objAluno->id] > 0) {

                        $frequencia = modeloFrequencia::verificaAlunoFrequencia($objAula->id, $objAluno->id);
                        $dados_frequencia = array("faltas" => $_POST['n_'.$objAula->id.'#'.$objAluno->id],
                            "id_aula" => $objAula->id,
                            "id_aluno" => $objAluno->id
                        );

                        if($frequencia) {
                            modeloFrequencia::remFrequencia($objAula->id, $objAluno->id);
                            modeloFrequencia::addFrequencia($dados_frequencia);
                        }
                        else {
                            modeloFrequencia::addFrequencia($dados_frequencia);
                        }
                    }
                }
            }

        }

        public static function loadAulas() {

            $aulas = modeloAula::getAulas();

            while($objAula = $aulas->fetchObject()) {
                $data = date("d/m/Y", strtotime($objAula->data));
                echo "<th>$data</th>";
            }
        }

        public static function loadTabelaAlunosFrequencia() {

            $alunos = modeloAluno::getAlunos();

            while($objAluno = $alunos->fetchObject()) {

                echo "<tr>";
                    echo "<td>".$objAluno->nome."</td>";
                    $aulas = modeloAula::getAulas();
                    $total = 0;
                    $faltas = 0;

                    while($objAula = $aulas->fetchObject()) {
                        echo "<td>";
                        $frequencia = modeloFrequencia::verificaAlunoFrequencia($objAula->id, $objAluno->id);
                        
                        if($frequencia) {
                            echo "<input type='number' class='form-check-input' name='n_$objAula->id#$objAluno->id' id='n_$objAula->id#$objAluno->id' value='$frequencia->faltas' required=''>";
                            $total += 4;
                            $faltas += $frequencia->faltas;
                        }
                        else {
                            echo "<input type='number' class='form-check-input' name='n_$objAula->id#$objAluno->id' id='n_$objAula->id#$objAluno->id' value='0' required=''>";
                            $total += 4;
                        }
                        echo "</td>";
                    }

                    echo "<td>";
                        $freq = (100*($total-$faltas))/$total;
                        echo $freq.'%';
                    echo "</td>";

                echo "</tr>";
            }
        }
    }
