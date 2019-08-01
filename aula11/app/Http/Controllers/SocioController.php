<?php

namespace App\Http\Controllers;

use Request;

use Illuminate\Support\Facades\DB;
use App\Socio;

class SocioController extends Controller {

    public function listar() {
        $socios = Socio::all();
        return view('socio')->with('socios', $socios);
    }

    public function salvar() {
        $objSocio = new Socio();
        $objSocio->nome = mb_strtoupper(Request::input('nome'), 'UTF-8');
        $objSocio->email = Request::input('email');
        $objSocio->save();

        return redirect()->action('SocioController@listar')->withInput();
    }
}
