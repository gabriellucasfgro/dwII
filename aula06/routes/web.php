<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('main');
});

Route::get('/curso', 'CursoController@listar');
Route::get('/curso/cadastrar', 'CursoController@cadastrar');
Route::get('/curso/editar/{id}', 'CursoController@editar');
Route::post('/curso/salvar/{id}', 'CursoController@salvar');
Route::get('/curso/confirmar/{id}', 'CursoController@confirmar');

Route::get('/turma', 'TurmaController@listar');
Route::get('/aluno', 'AlunoController@listar');
Route::get('/disciplina', 'DisciplinaController@listar');
Route::get('/conceito', 'ConceitoController@listar');
Route::get('/relatorio', 'RelatorioController@listar');
Route::get('/importar', 'ImportarController@listar');
Route::get('/exportar', 'ExportarController@listar');
