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
Route::get('/gestor', 'GestorController@listar');
Route::get('/gestor/cadastrar', 'GestorController@cadastrar');
Route::get('/gestor/editar/{id}', 'GestorController@editar');
Route::post('/gestor/salvar/{id}', 'GestorController@salvar');
Route::get('/gestor/remover/{id}', 'GestorController@remover');
Route::get('/gestor/confirmar/{id}', 'GestorController@confirmar');

Route::get('/municipio', 'MunicipioController@listar');
Route::get('/municipio/cadastrar', 'MunicipioController@cadastrar');
Route::get('/municipio/editar/{id}', 'MunicipioController@editar');
Route::post('/municipio/salvar/{id}', 'MunicipioController@salvar');
Route::get('/municipio/remover/{id}', 'MunicipioController@remover');
Route::get('/municipio/confirmar/{id}', 'MunicipioController@confirmar');
Route::get('/municipio/relatorio/{id}', 'MunicipioController@relatorio');