<?php

namespace App\Http\Controllers;

use Request;
use Illuminate\Support\Facades\DB;
use App\Turma;
use App\Curso;

class TurmaController extends Controller {

    public function listar() {

        // $cursos = DB::select('SELECT * FROM turma_models');
        $turmas = Turma::orderBy('nome')->get();
        $cursos = Curso::select('id', 'nome')->get();
        return view('turma')->with('turmas', $turmas)->with('cursos', $cursos);
    }

    public function cadastrar() {

        $cursos = Curso::orderBy('id')->get();
        $hoje = getdate();
        return view('turmaCadastrar')->with('cursos', $cursos)->with('data_ano', $hoje['year']);
    }

    public function salvar($id) {

        // INSERT
        if($id == 0) {
            $objTurma = new Turma();
            $objTurma->nome = mb_strtoupper(Request::input('nome'), 'UTF-8');
            $objTurma->ano = Request::input('ano');
            // Obtém Id Curso
            $arr = explode(" ", Request::input('curso'));
            $objTurma->id_curso = $arr[0];
            // Fim
            $objTurma->ativo = 1;

            $objTurma->save();
        }
        // UPDATE
        else {
            $objTurma = Turma::find($id);
            $objTurma->nome = mb_strtoupper(Request::input('nome'), 'UTF-8');
            $objTurma->ano = Request::input('ano');
            // Obtém Id Curso
            $arr = explode(" ", Request::input('curso'));
            $objTurma->id_curso = $arr[0];
            // Fim
            // Obtém Ativo/Inativo
            $ativo = Request::input('ativo');
            if (strcmp($ativo, "ATIVO") == 0) { $objTurma->ativo = 1; }
            else { $objTurma->ativo = 0; }

            $objTurma->save();
        }

        return redirect()->action('TurmaController@listar')->withInput();
    }

    public function editar($id) {

        // Filtra parâmetro para garantir que é um número
        if(is_numeric($id)) {

            $turma = Turma::find($id);

            // Verifica se existe um curso com o 'id' recebido por parâmetro
            if(empty($turma)) {
                return "<h2>[ERRO]: Turma não encontrada para o ID=".$id."!</h2>";
            }

            $cursos = Curso::orderBy('id')->get();
            return view('turmaEditar')->with('turma', $turma)->with('cursos', $cursos);
        }
        else {
            return "<h2>[ERRO]: Parâmetro Inválido!</h2>";
        }

    }

    public function remover($id) {

        if(is_numeric($id)) {

            $turma = Turma::find($id);

            if(empty($turma)) {
                    return "<h2>[ERRO]: Turma não encontrada para o ID=".$id."!</h2>";
            }

            return view('turmaRemover')->with("turma", $turma);
        }

        return "<h2>[ERRO]: Parâmetro Inválido!</h2>";
    }

    public function confirmar($id) {

        $objTurma = Turma::find($id);

        if(empty($objTurma)) {
                return "<h2>[ERRO]: Turma não encontrada para o ID=".$id."!</h2>";
        }

        $objTurma->delete();

        return redirect()->action('TurmaController@listar');
    }
}
