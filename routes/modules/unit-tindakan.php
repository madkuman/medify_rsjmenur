<?php 
	Route::group(['prefix' => 'unit-tindakan'], function() {
		Route::get('/', 'UnitTindakan\UnitTindakan\ViewController@index');
		Route::post('/new', 'UnitTindakan\UnitTindakan\PostController@create');

		Route::group(['middleware' => ['check-module']], function(){
			Route::get('/{slug}', 'UnitTindakan\UnitTindakan\ViewController@dashboard');
			Route::get('/{slug}/dashboard', 'UnitTindakan\UnitTindakan\ViewController@dashboard');
			Route::get('/{slug}/histori', 'UnitTindakan\UnitTindakan\ViewController@histori');
			Route::post('/{slug}/periksa', 'UnitTindakan\Transaksi\PostController@createNewTindakan');
			Route::get('/{slug}/layani/{id}', 'UnitTindakan\Transaksi\PostController@layani');
			Route::get('/{slug}/selesai/{id}', 'UnitTindakan\Transaksi\PostController@selesai');

			Route::get('/{slug}/pengaturan', 'UnitTindakan\UnitTindakan\ViewController@pengaturan');
			Route::post('/{slug}/pengaturan', 'UnitTindakan\UnitTindakan\PostController@edit');
			Route::post('/{slug}/pengaturan/delete', 'UnitTindakan\UnitTindakan\PostController@delete');
		});
	});
?>