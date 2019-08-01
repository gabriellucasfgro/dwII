<?php

namespace App\Http\Controllers;

use Request;

use App\Peso;
use App\Disciplina;

class PesoController extends Controller {

    public function editar($id) {

        $disciplina = Disciplina::find($id);

        if(empty($disciplina)) {

            $msg = "Disciplina não encontrada para o ID=$id!";

            return view('messagebox')->with('tipo', 'alert alert-danger')
                    ->with('titulo', 'OPERAÇÃO NÃO-CONCLUIDA')
                    ->with('msg', $msg)
                    ->with('acao', "/disciplina");
        }

        $peso = Peso::where('id_disciplina', $id)->first();

        return view('pesoEditar')->with('peso', $peso)
            ->with('disciplina', $disciplina);
    }

    public function salvar($id) {

        $objPeso = Peso::find($id);

        $objPeso->trabalho = Request::input('trabalho');
        $objPeso->avaliacao = Request::input('avaliacao');
        $objPeso->parcial01 = Request::input('parcial01');
        $objPeso->parcial02 = Request::input('parcial02');
        $objPeso->parcial03 = Request::input('parcial03');
        $objPeso->parcial04 = Request::input('parcial04');

        $objPeso->save();

        return redirect()->action('PesoController@editar', $objPeso->id_disciplina)->withInput();
    }
}
