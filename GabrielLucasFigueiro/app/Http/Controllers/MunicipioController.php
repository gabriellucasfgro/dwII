<?php

namespace App\Http\Controllers;

use Request;
use App\Gestor;
use App\Municipio;
use App\Porte;

class MunicipioController extends Controller {

    public function listar() {
    	$municipios = Municipio::all();
    	$gestores = Gestor::all();
    	$portes = Porte::all();
        return view('municipio')->with('municipios', $municipios)->with('gestores', $gestores)->with('portes', $portes);
    }

    public function cadastrar() {
    	$gestores = Gestor::all();
    	$portes = Porte::all();
        return view('municipioCadastrar')->with('gestores', $gestores)->with('portes', $portes);
    }

    public function relatorio($id) {
    	 if(is_numeric($id)) {
            $municipio = Municipio::find($id);
            if(empty($municipio)) {
                return view('messagebox')->with('tipo', 'Erro')->with('titulo', 'Municipio')->with('msg', 'Municipio não encontrado.');
            }
            return view('municipioRelatorio')->with('municipio', $municipio);
        }
        else {
            return view('messagebox')->with('tipo', 'Erro')->with('titulo', 'Municipio')->with('msg', 'Parâmetro Inválido.');
        }
    }

    public function editar($id) {
        if(is_numeric($id)) {
            $municipio = Municipio::find($id);
            if(empty($municipio)) {
                return view('messagebox')->with('tipo', 'Erro')->with('titulo', 'Municipio')->with('msg', 'Municipio não encontrado.');
            }
            $gestores = Gestor::all();
    		$portes = Porte::all();
            return view('municipioEditar')->with('municipio', $municipio)->with('gestores', $gestores)->with('portes', $portes);
        }
        else {
            return view('messagebox')->with('tipo', 'Erro')->with('titulo', 'Municipio')->with('msg', 'Parâmetro Inválido.');
        }
    }

    public function salvar($id) {
        $municipios = Municipio::all();
            
        if($id == 0) {
            $objMunicipio = new Municipio();
            $objMunicipio->nome = mb_strtoupper(Request::input('nome'), 'UTF-8');
            $objMunicipio->nr_habitantes = Request::input('nr_habitantes');
            $objMunicipio->area = Request::input('area');
            $arr = explode(" ", Request::input('gestor'));
            $objMunicipio->id_gestor = $arr[0];
            foreach ($municipios as $dados) {
                if($dados->id_gestor == $objMunicipio->id_gestor) {
                    return view('messagebox')->with('tipo', 'Erro')->with('titulo', 'Gestor já está vinculado à um Municipio')->with('msg', 'Não é possível incluir município.');
                }
            }
            $arr = explode(" ", Request::input('porte'));
            $objMunicipio->id_porte = $arr[0];
            $objMunicipio->save();
        }
        else {
            $objMunicipio = Municipio::find($id);
            $objMunicipio->nome = mb_strtoupper(Request::input('nome'), 'UTF-8');
            $objMunicipio->nr_habitantes = Request::input('nr_habitantes');
            $objMunicipio->area = Request::input('area');
            $arr = explode(" ", Request::input('gestor'));
            $objMunicipio->id_gestor = $arr[0];
            $arr = explode(" ", Request::input('porte'));
            $objMunicipio->id_porte = $arr[0];
            $objMunicipio->save();
        }

        return redirect()->action('MunicipioController@listar')->withInput();
    }

    public function remover($id) {
        if(is_numeric($id)) {
            $municipio = Municipio::find($id);
            if(empty($municipio)) {
                    return view('messagebox')->with('tipo', 'Erro')->with('titulo', 'Municipio')->with('msg', 'Municipio não encontrado.');
            }
            return view('municipioRemover')->with("municipio", $municipio);
        }
        return view('messagebox')->with('tipo', 'Erro')->with('titulo', 'Municipio')->with('msg', 'Parâmetro Inválido.');;
    }

    public function confirmar($id) {
        $objMunicipio = Municipio::find($id);
        if(empty($objMunicipio)) {
                return view('messagebox')->with('tipo', 'Erro')->with('titulo', 'Municipio')->with('msg', 'Municipio não encontrado.');
        }
        $objMunicipio->delete();
        return redirect()->action('MunicipioController@listar');
    }
}
