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

//Customer
Route::middleware(['middleware' => 'auth'])->prefix('cliente')->group(function(){
	Route::get('/', 'CustomerController@index')->name('customer');
	Route::post('/', 'CustomerController@store')->name('customer.store');
	Route::patch('/{customer}', 'CustomerController@update')->name('customer.update');
	Route::delete('/{customer}', 'CustomerController@destroy')->name('customer.destroy');
});


//Product
Route::middleware(['middleware' => 'auth'])->prefix('produto')->group(function(){
	Route::get('/', 'ProductController@index')->name('produto');
	Route::post('/', 'ProductController@store')->name('produto.store');
	Route::patch('/{product}', 'ProductController@update')->name('produto.update');
	Route::delete('/{product}', 'ProductController@destroy')->name('produto.destroy');
	Route::get('/search', 'ProductController@autocompleteSearch')->name('produto.search');
	Route::patch('/', 'ControleStorageController@update')->name('produto.storage');
	Route::patch('/quantity/{id}', 'ControleStorageController@correctQuantity')->name('produtoteste');
});

//Transferences
Route::middleware(['middleware' => 'auth'])->prefix('transfer')->group(function(){
	Route::post('/openTransferOrder', 'TransferController@openTransferOrder')->name('transfer.open');
	Route::patch('/{transfer}', 'TransferController@closeTransferOrder')->name('transfer.close');
	Route::get('/transferPDF/{transfer}', 'PDFController@transferOrderClosedPdf')->name('transfer.pdf');
});

//Storage
Route::middleware(['middleware' => 'auth'])->prefix('estoque')->group(function(){
	Route::get('/', 'StorageController@index')->name('estoque');
	Route::post('/', 'StorageController@store')->name('estoque.store');
	Route::patch('/{storage}', 'StorageController@update')->name('estoque.update');
	Route::delete('/{storage}', 'StorageController@destroy')->name('estoque.destroy');
});

//Supplier
Route::middleware(['middleware' => 'auth'])->prefix('fornecedor')->group(function(){
	Route::get('/', 'SupplierController@index')->name('fornecedor');
	Route::post('/', 'SupplierController@store')->name('fornecedor.store');
	Route::patch('/{supplier}', 'SupplierController@update')->name('fornecedor.update');
	Route::delete('/{supplier}', 'SupplierController@destroy')->name('fornecedor.destroy');
});

//Movimentação
Route::middleware(['middleware' => 'auth'])->prefix('movimentacao')->group(function(){
	Route::get('/vendas', 'SellingController@index')->name('vendas');
	Route::post('/vendas', 'SellingController@openSelling')->name('vendas.abrir');
	Route::post('/vendas/atualiza', 'SellingController@store')->name('vendas.store');
	Route::patch('/{selling}', 'SellingController@update')->name('vendas.update');
	Route::delete('/{selling}', 'SellingController@destroy')->name('vendas.destroy');

	Route::post('/sellingItem/{id}', 'SellingItemController@storeSellingItem')->name('sellingItem.store');

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


// PDF GENERATOR ROUTE
Route::get('generate-pdf','PDFController@generatePDF');