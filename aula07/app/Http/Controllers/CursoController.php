<?php

namespace App\Http\Controllers;

use Request;

use Illuminate\Support\Facades\DB;
use App\Curso;
use App\Nivel;

class CursoController extends Controller {

    public function listar() {

        // $cursos = DB::select('SELECT * FROM curso_models');
        $cursos = Curso::all();
        $niveis = Nivel::all();
        return view('curso')->with('cursos', $cursos)->with('niveis', $niveis);
    }

    public function cadastrar() {

        $niveis = Nivel::orderBy('id')->get();

        return view('cursoCadastrar')->with('niveis', $niveis);
    }

    public function editar($id) {

        // Filtra parâmetro para garantir que é um número
        if(is_numeric($id)) {

            $curso = Curso::find($id);

            // Verifica se existe um curso com o 'id' recebido por parâmetro
            if(empty($curso)) {
                return "<h2>[ERRO]: Curso não encontrado para o ID=".$id."!</h2>";
            }

            $niveis = Nivel::orderBy('id')->get();
            return view('cursoEditar')->with('curso', $curso)->with('niveis', $niveis);
        }
        else {
            return "<h2>[ERRO]: Parâmetro Inválido!</h2>";
        }
    }

    public function salvar($id) {

        // INSERT
        if($id == 0) {
            $objCurso = new Curso();
            $objCurso->nome = mb_strtoupper(Request::input('nome'), 'UTF-8');
            $objCurso->abreviatura = mb_strtoupper(Request::input('abreviatura'), 'UTF-8');
            // Obtém Id Nivel
            $arr = explode(" ", Request::input('nivel'));
            $objCurso->id_nivel = $arr[0];
            // Fim
            $objCurso->tempo = Request::input('tempo');;
            $objCurso->ativo = 1;

            $objCurso->save();
        }
        // UPDATE
        else {
            $objCurso = Curso::find($id);

            // Verifica se existe um curso com o 'id' recebido por parâmetro
            if(empty($objCurso)) {
                return "<h2>[ERRO]: Curso não encontrado para o ID=".$id."!</h2>";
            }

            $objCurso->nome = mb_strtoupper(Request::input('nome'), 'UTF-8');
            $objCurso->abreviatura = mb_strtoupper(Request::input('abreviatura'), 'UTF-8');
            // Obtém Id Nivel
            $arr = explode(" ", Request::input('nivel'));
            $objCurso->id_nivel = $arr[0];
            // Fim
            $objCurso->tempo = Request::input('tempo');
            // Obtém Ativo/Inativo
            $ativo = Request::input('ativo');
            if (strcmp($ativo, "ATIVO") == 0) { $objCurso->ativo = 1; }
            else { $objCurso->ativo = 0; }

            $objCurso->save();
        }

        return redirect()->action('CursoController@listar')->withInput();
    }

    public function remover($id) {

        if(is_numeric($id)) {

            $curso = Curso::find($id);

            if(empty($curso)) {
                    return "<h2>[ERRO]: Curso não encontrado para o ID=".$id."!</h2>";
            }

            return view('cursoRemover')->with("curso", $curso);
        }

        return "<h2>[ERRO]: Parâmetro Inválido!</h2>";
    }

    public function confirmar($id) {

        $objCurso = Curso::find($id);

        if(empty($objCurso)) {
                return "<h2>[ERRO]: Curso não encontrado para o ID=".$id."!</h2>";
        }

        $objCurso->delete();

        return redirect()->action('CursoController@listar');
    }
}
