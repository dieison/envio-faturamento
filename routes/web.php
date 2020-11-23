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
    if (Auth::check()) {
        return redirect(route('home'));
    } else {
        return view('auth.login');
    }
})->name('inicio');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('usuarios', 'UsersController');
Route::post('user/{id}', 'UsersController@editar')->name('user.editar');
Route::get('excluir-usuario/{id}', 'UsersController@excluirUsuario');
Route::resource('clientes', 'ClienteController');
Route::get('visualizar-cliente/{id}', 'ClienteController@visualizarCliente');
Route::resource('problemas', 'ProblemasController');
Route::get('faturamento/{id}', 'FaturamentoController@index')->name('faturamento.index');
Route::get('listar-emails-faturamento', 'FaturamentoController@listaFaturamentoEmails')->name('faturamento.listarEmails');
Route::get('listar-status-visualizacao', 'FaturamentoController@listaStatusVisualizacao')->name('faturamento.listarStatusVisualizacao');

Route::prefix('api')->group(function () {
    Route::get('get-boletos-cliente/{id}', 'TituloController@getTitulosByCliente');
    Route::get('get-boleto/{id}', 'TituloController@gerarBoleto');
    Route::get('get-nota/{id}', 'GerarNotaController@gerarNotaDownload');
    Route::get('get-relatorio-problemas', 'RelatoriosController@problemasRelatorios')->name('relatorio.problemas');
    Route::get('get-relatorio-emails-faturamento', 'RelatoriosController@FaturamentoEmailsRelatorios')->name('relatorio.envioEmailFaturamento');
    Route::post('envio-faturamento', 'FaturamentoController@envioFaturamento');
    Route::post('get-faturamento', 'FaturamentoController@getFaturamento');
    Route::get('get-faturamento-email', 'FaturamentoController@getFaturamentoEmail');
    Route::get('get-clientes', 'ClienteController@getClientes');
    Route::get('registro-leitura/{cdrcd}', 'RegistroDeVisualuzacao@setRegistroDeVisualizacao')->name('registro-leitura');
    Route::get('get-status-visualizacao', 'FaturamentoController@getStatusVisualizacao');
    Route::get('get-relatorio-status-visualizacao', 'RelatoriosController@statusVisualizacaoRelatorios')->name('relatorio.statusVisualizacaoRelatorios');
});

