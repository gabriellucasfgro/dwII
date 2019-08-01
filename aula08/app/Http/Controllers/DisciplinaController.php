<?php

namespace App\Http\Controllers;

use Request;

use App\Disciplina;
use App\Curso;
use App\Atividade;
use App\Conteudo;
use App\Peso;

class DisciplinaController extends Controller {

    public function listar() {

        $disciplinas = Disciplina::orderBy('nome')->get();
        $cursos = Curso::select('id', 'nome', 'abreviatura')->get();
        $atividades = Atividade::orderBy('bimestre', 'ASC')->orderBy('prazo', 'ASC')->get();
        $conteudos = Conteudo::orderBy('bimestre', 'ASC')->orderBy('data', 'ASC')->get();

        return view('disciplina')->with('disciplinas', $disciplinas)
            ->with('cursos', $cursos)
            ->with('atividades', $atividades)
            ->with('conteudos', $conteudos);
    }

    public function cadastrar() {

        $cursos = Curso::select('id', 'nome')->get();
        return view('disciplinaCadastrar')->with('cursos', $cursos);
    }

    public function editar($id) {

        $disciplina = Disciplina::find($id);
        $cursos = Curso::select('id', 'nome')->get();
        return view('disciplinaEditar')->with('disciplina', $disciplina)
            ->with('cursos', $cursos);
    }

    public function salvar($id) {

        // INSERT
        if($id == 0) {
            // Dados - Tabela Disciplina
            $objDisciplina = new Disciplina();
            $objDisciplina->nome = mb_strtoupper(Request::input('nome'), 'UTF-8');
            $objDisciplina->abreviatura = mb_strtoupper(Request::input('abreviatura'), 'UTF-8');
            $objDisciplina->carga_horaria = Request::input('carga');
            // Obtém Id Curso
            $arr = explode(" ", Request::input('curso'));
            $objDisciplina->id_curso = $arr[0];
            // Fim
            $objDisciplina->periodo = Request::input('periodo');
            $objDisciplina->ativo = 1;
            $objDisciplina->save();

            // Dados - Tabela Peso (iniciais - padrão)
            $objPeso = new Peso();
            $objPeso->id_disciplina = $objDisciplina->id;
            $objPeso->trabalho = 0.5;
            $objPeso->avaliacao = 0.5;

            if(Request::input('periodo') == 'ANUAL') {
                $objPeso->parcial01 = $objPeso->parcial02 = $objPeso->parcial03 = $objPeso->parcial04 = 0.25;
            }
            else {
                $objPeso->parcial01 = $objPeso->parcial02 = $objPeso->parcial03 = $objPeso->parcial04 = 0.50;
            }

            $objPeso->save();
        }
        // UPDATE
        else {
            $objDisciplina = Disciplina::find($id);

            // Verifica se existe a disicplina com o 'id' recebido por parâmetro
            if(empty($objDisciplina)) {
                return "<h2>[ERRO]: Disciplna não encontrada para o ID=".$id."!</h2>";
            }
            $objDisciplina->nome = mb_strtoupper(Request::input('nome'), 'UTF-8');
            $objDisciplina->abreviatura = mb_strtoupper(Request::input('abreviatura'), 'UTF-8');
            $objDisciplina->carga_horaria = Request::input('carga');
            // Obtém Id Curso
            $arr = explode(" ", Request::input('curso'));
            $objDisciplina->id_curso = $arr[0];
            // Fim
            $objDisciplina->periodo = Request::input('periodo');
            // Obtém Ativo/Inativo
            $ativo = Request::input('ativo');
            if (strcmp($ativo, "ATIVO") == 0) { $objDisciplina->ativo = 1; }
            else { $objDisciplina->ativo = 0; }

            $objDisciplina->save();
        }

        return redirect()->action('DisciplinaController@listar')->withInput();
    }

    public function remover($id) {

        if(is_numeric($id)) {

            $disciplina = Disciplina::find($id);

            if(empty($disciplina)) {

                    $msg = "Disciplina não encontrada para o ID=$id!";

                    return view('messagebox')->with('tipo', 'alert alert-warning')
                            ->with('titulo', 'OPERAÇÃO INVÁLIDA')
                            ->with('msg', $msg)
                            ->with('acao', "/disciplina");
            }

            $total_atv = Atividade::where('id_disciplina', $id)->count();
            $total_con = Conteudo::where('id_disciplina', $id)->count();

            if($total_atv == 0 and $total_con == 0) {

                return view('disciplinaRemover')->with("disciplina", $disciplina);
            }
            else {

                $msg = "Existem Conteúdos e/ou Atividades vinculadas a disciplina '$disciplina->nome' que impedem sua exclusão!";

                return view('messagebox')->with('tipo', 'alert alert-danger')
                        ->with('titulo', 'OPERAÇÃO INVÁLIDA')
                        ->with('msg', $msg)
                        ->with('acao', "/disciplina");
            }
        }

        $msg = "Parâmetro via URL Inválido!";

        return view('messagebox')->with('tipo', 'alert alert-warning')
                ->with('titulo', 'OPERAÇÃO INVÁLIDA')
                ->with('msg', $msg)
                ->with('acao', "/disciplina");
    }

    public function confirmar($id) {

        $objDisciplina = Disciplina::find($id);

        if(empty($objDisciplina)) {

            $msg = "Disciplina não encontrada para o ID=$id!";

            return view('messagebox')->with('tipo', 'alert alert-danger')
                    ->with('titulo', 'OPERAÇÃO NÃO-CONCLUIDA')
                    ->with('msg', $msg)
                    ->with('acao', "/disciplina");
        }

        $objPeso = Peso::where('id_disciplina', $objDisciplina->id)->first();

        $objDisciplina->delete();
        $objPeso->delete();

        return redirect()->action('DisciplinaController@listar');
    }
}
