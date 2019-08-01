<?php

namespace App\Http\Controllers;

use Request;
use App\Gestor;
use App\Municipio;

class GestorController extends Controller {

    public function listar() {
    	$gestores = Gestor::all();
        return view('gestor')->with('gestores', $gestores);
    }


    public function cadastrar() {
        return view('gestorCadastrar');
    }

    public function editar($id) {
        if(is_numeric($id)) {
            $gestor = Gestor::find($id);
            if(empty($gestor)) {
                return view('messagebox')->with('tipo', 'Erro')->with('titulo', 'Gestor')->with('msg', 'Gestor não encontrado.');
            }
            return view('gestorEditar')->with('gestor', $gestor);
        }
        else {
            return view('messagebox')->with('tipo', 'Erro')->with('titulo', 'Gestor')->with('msg', 'Parâmetro Inválido.');
        }
    }

    public function salvar($id) {
        if($id == 0) {
            $objGestor = new Gestor();
            $objGestor->nome = mb_strtoupper(Request::input('nome'), 'UTF-8');
            $objGestor->nascimento = Request::input('nascimento');
            $objGestor->save();
        }
        else {
            $objGestor = Gestor::find($id);
            $objGestor->nome = mb_strtoupper(Request::input('nome'), 'UTF-8');
            $objGestor->nascimento = Request::input('nascimento');
            $objGestor->save();
        }

        return redirect()->action('GestorController@listar')->withInput();
    }

    public function remover($id) {
        if(is_numeric($id)) {
            $gestor = Gestor::find($id);
            if(empty($gestor)) {
                return view('messagebox')->with('tipo', 'Erro')->with('titulo', 'Gestor')->with('msg', 'Gestor não encontrado.');
            }
            $municipios = Municipio::all();
            foreach ($municipios as $dados) {
                if($dados->id_gestor == $id) {
                    return view('messagebox')->with('tipo', 'Erro')->with('titulo', 'Gestor vinculado à um Municipio')->with('msg', 'Não é possível remover gestor');
                }
            }
            return view('gestorRemover')->with("gestor", $gestor);
        }
        return view('messagebox')->with('tipo', 'Erro')->with('titulo', 'Gestor')->with('msg', 'Parâmetro Inválido!');
    }

    public function confirmar($id) {
        $objGestor = Gestor::find($id);
        if(empty($objGestor)) {
            return view('messagebox')->with('tipo', 'Erro')->with('titulo', 'Gestor')->with('msg', 'Gestor não encontrado.');
        }
        $objGestor->delete();
        return redirect()->action('GestorController@listar');
    }

}
