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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', 'HomeController@index')->name('home')->middleware('auth');

Route::group(['middleware' => 'auth'], function () {
	Route::get('table-list', function () {
		return view('pages.table_list');
	})->name('table');

	Route::get('typography', function () {
		return view('pages.typography');
	})->name('typography');

	Route::get('icons', function () {
		return view('pages.icons');
	})->name('icons');

	Route::get('map', function () {
		return view('pages.map');
	})->name('map');

	Route::get('notifications', function () {
		return view('pages.notifications');
	})->name('notifications');

	Route::get('rtl-support', function () {
		return view('pages.language');
	})->name('language');

	Route::get('upgrade', function () {
		return view('pages.upgrade');
	})->name('upgrade');
});

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
});

//Cadastros
Route::middleware(['middleware' => 'auth'])->prefix('cadastro')->group(function(){
	Route::get('produto', function () {
	    return view('produto.cadastro');
	});
	Route::get('cliente', function () {
	    return view('cliente.cadastro');
	});
	Route::get('fornecedor', function () {
	    return view('fornecedor.cadastro');
	});

	Route::get('estoque', 'StorageController@create');
	Route::post('estoque', 'StorageController@store');
});

//Movimentação
Route::middleware(['middleware' => 'auth'])->prefix('movimentacao')->group(function(){
	Route::get('vendas', function(){
		return view('movimentacao.vendas');
	});
	Route::get('orcamento', function() {
		return view('movimentacao.orcamento');
	});
	Route::get('trocas', function() {
		return view('movimentacao.trocas');
	});
	Route::get('compras', function() {
		return view('movimentacao.compras');
	});
	Route::get('pedidos-compra', function() {
		return view('movimentacao.pedidosCompra');
	});
	Route::get('saida-caixa', function() {
		return view('movimentacao.saidaCaixa');
	});
});
