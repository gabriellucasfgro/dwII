<?php

namespace App\Http\Controllers;

use Request;

use App\Atividade;
use App\Disciplina;

class AtividadeController extends Controller {

    public function cadastrar($id) {

        $disciplina = Disciplina::find($id);

        if(empty($disciplina)) {
            $msg = "Disciplina não encontrada para o ID=$id!";

            return view('messagebox')->with('tipo', 'alert alert-warning')
                    ->with('titulo', 'OPERAÇÃO INVÁLIDA')
                    ->with('msg', $msg)
                    ->with('acao', "/disciplina");
        }

        return view('atividadeCadastrar')->with('disciplina', $disciplina);
    }

    public function editar($id) {

        $atividade = Atividade::find($id);

        if(empty($atividade)) {
            $msg = "Atividade não encontrada para o ID=$id!";

            return view('messagebox')->with('tipo', 'alert alert-warning')
                    ->with('titulo', 'OPERAÇÃO INVÁLIDA')
                    ->with('msg', $msg)
                    ->with('acao', "/disciplina");
        }

        $disciplina = Disciplina::find($atividade->id_disciplina);

        return view('atividadeEditar')->with('atividade', $atividade)
            ->with('disciplina', $disciplina);
    }

    public function salvar($id) {

        // INSERT
        if($id == 0) {
            $objAtividade = new Atividade();
            $objAtividade->nome = mb_strtoupper(Request::input('nome'), 'UTF-8');
            $objAtividade->prazo = Request::input('prazo');
            $objAtividade->tipo = Request::input('tipo');
            // Obtém Id Disciplina
            $arr = explode(" ", Request::input('disciplina'));
            $id_d = $arr[0];
            $objAtividade->id_disciplina = $id_d;
            // Fim
            $objAtividade->bimestre = Request::input('bimestre');
            $objAtividade->ativo = 1;

            $objAtividade->save();
        }
        // UPDATE
        else {
            $objAtividade = Atividade::find($id);
            $objAtividade->nome = mb_strtoupper(Request::input('nome'), 'UTF-8');
            $objAtividade->prazo = Request::input('prazo');
            $objAtividade->tipo = Request::input('tipo');
            // Obtém Id Disciplina
            $arr = explode(" ", Request::input('disciplina'));
            $id_d = $arr[0];
            $objAtividade->id_disciplina = $id_d;
            // Fim
            $objAtividade->bimestre = Request::input('bimestre');
            // Obtém Ativo/Inativo
            $ativo = Request::input('ativo');
            if (strcmp($ativo, "ATIVO") == 0) { $objAtividade->ativo = 1; }
            else { $objAtividade->ativo = 0; }

            $objAtividade->save();
        }

        return redirect()->action('AtividadeController@cadastrar', $id_d)->withInput();
    }

    public function remover($id) {

        if(is_numeric($id)) {

            $atividade = Atividade::find($id);

            if(empty($atividade)) {
                $msg = "Atividade não encontrada para o ID=$id!";

                return view('messagebox')->with('tipo', 'alert alert-warning')
                        ->with('titulo', 'OPERAÇÃO INVÁLIDA')
                        ->with('msg', $msg)
                        ->with('acao', "/disciplina");
            }

            return view('atividadeRemover')->with('atividade', $atividade);
        }

        $msg = "Parâmetro via URL Inválido!";

        return view('messagebox')->with('tipo', 'alert alert-warning')
                ->with('titulo', 'OPERAÇÃO INVÁLIDA')
                ->with('msg', $msg)
                ->with('acao', "/disciplina");

    }

    public function confirmar($id) {

        $objAtividade = Atividade::find($id);

        if(empty($objAtividade)) {

            $msg = "Atividade não encontrada para o ID=$id!";

            return view('messagebox')->with('tipo', 'alert alert-danger')
                    ->with('titulo', 'OPERAÇÃO NÃO-CONCLUIDA')
                    ->with('msg', $msg)
                    ->with('acao', "/disciplina");
        }

        $objAtividade->delete();

        return redirect()->action('DisciplinaController@listar');

    }
}
