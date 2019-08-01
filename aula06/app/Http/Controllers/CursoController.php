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
        return "Editar Curso";
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

        }

        return redirect()->action('CursoController@listar')->withInput();
    }

    public function confirmar($id) {
        return "Confirmar Remoção Curso";
    }
}
