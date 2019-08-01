<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DisciplinaController extends Controller {

    public function listar() {
        return view('disciplina');
    }
}
