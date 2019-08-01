<?php

namespace App\Http\Controllers;

use Request;

use App\Conteudo;
use App\Disciplina;

class ConteudoController extends Controller {

    public function cadastrar($id) {

        $disciplina = Disciplina::find($id);

        if(empty($disciplina)) {
            $msg = "Disciplina não encontrada para o ID=$id!";

            return view('messagebox')->with('tipo', 'alert alert-warning')
                    ->with('titulo', 'OPERAÇÃO INVÁLIDA')
                    ->with('msg', $msg)
                    ->with('acao', "/disciplina");
        }

        return view('conteudoCadastrar')->with('disciplina', $disciplina);
    }

    public function editar($id) {

        $conteudo = Conteudo::find($id);

        if(empty($conteudo)) {
            $msg = "Conteúdo não encontrado para o ID=$id!";

            return view('messagebox')->with('tipo', 'alert alert-warning')
                    ->with('titulo', 'OPERAÇÃO INVÁLIDA')
                    ->with('msg', $msg)
                    ->with('acao', "/disciplina");
        }

        $disciplina = Disciplina::find($conteudo->id_disciplina);

        return view('conteudoEditar')->with('conteudo', $conteudo)
            ->with('disciplina', $disciplina);
    }

    public function salvar($id) {

        // INSERT
        if($id == 0) {
            $objConteudo = new Conteudo();
            $objConteudo->nome = mb_strtoupper(Request::input('nome'), 'UTF-8');
            $objConteudo->data = Request::input('data');
            // Obtém Id Disciplina
            $arr = explode(" ", Request::input('disciplina'));
            $id_d = $arr[0];
            $objConteudo->id_disciplina = $id_d;
            // Fim
            $objConteudo->bimestre = Request::input('bimestre');
            $objConteudo->ativo = 1;

            $objConteudo->save();
        }
        // UPDATE
        else {

            $objConteudo = Conteudo::find($id);
            $objConteudo->nome = mb_strtoupper(Request::input('nome'), 'UTF-8');
            $objConteudo->data = Request::input('data');
            // Obtém Id Disciplina
            $arr = explode(" ", Request::input('disciplina'));
            $id_d = $arr[0];
            $objConteudo->id_disciplina = $id_d;
            // Obtém Ativo/Inativo
            $ativo = Request::input('ativo');
            if (strcmp($ativo, "ATIVO") == 0) { $objConteudo->ativo = 1; }
            else { $objConteudo->ativo = 0; }
            $objConteudo->bimestre = Request::input('bimestre');

            $objConteudo->save();
        }

        return redirect()->action('ConteudoController@cadastrar', $id_d)->withInput();
    }

    public function remover($id) {

        if(is_numeric($id)) {

            $conteudo = Conteudo::find($id);

            if(empty($conteudo)) {

                    $msg = "Conteúdo não encontrado para o ID=$id!";

                    return view('messagebox')->with('tipo', 'alert alert-warning')
                            ->with('titulo', 'OPERAÇÃO INVÁLIDA')
                            ->with('msg', $msg)
                            ->with('acao', "/disciplina");
            }

            return view('conteudoRemover')->with("conteudo", $conteudo);
        }

        $msg = "Parâmetro via URL Inválido!";

        return view('messagebox')->with('tipo', 'alert alert-warning')
                ->with('titulo', 'OPERAÇÃO INVÁLIDA')
                ->with('msg', $msg)
                ->with('acao', "/disciplina");
    }

    public function confirmar($id) {

        $objConteudo = Conteudo::find($id);

        if(empty($objConteudo)) {

            $msg = "Conteúdo não encontrado para o ID=$id!";

            return view('messagebox')->with('tipo', 'alert alert-danger')
                    ->with('titulo', 'OPERAÇÃO NÃO-CONCLUIDA')
                    ->with('msg', $msg)
                    ->with('acao', "/disciplina");
        }

        $objConteudo->delete();

        return redirect()->action('DisciplinaController@listar');

    }
}
