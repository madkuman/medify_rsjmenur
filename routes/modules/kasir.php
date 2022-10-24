<?php 

Route::group(['middleware' => ['check-module']], function(){
	Route::group(['prefix' => 'kasir'], function(){

		Route::get('/', 'Kasir\Manajemen\ViewController@index');
		Route::get('/manajemen', 'Kasir\Manajemen\ViewController@index2')->name('kasir_index');
		Route::get('/manajemen/baru', 'Kasir\Manajemen\ViewController@create')->name('kasir_create');;
		Route::get('/manajemen/edit/{id}', 'Kasir\Manajemen\ViewController@edit')->name('edit_foto');
		Route::get('/manajemen/edit/foto/{id}', 'Kasir\Manajemen\ViewController@editFoto')->name('manajemen_edit_foto');
		Route::post('/manajemen/create', 'Kasir\Manajemen\CreateController@create')->name('manajemen_create');
		Route::post('/manajemen/edit/post/{id}', 'Kasir\Manajemen\EditController@edit')->name('manajemen_edit');

		Route::get('/{id}/dashboard', 'Kasir\Dashboard\ViewController@index');

		Route::get('/{id}/transaksi', 'Kasir\Transaksi\ViewController@index2');
		Route::get('/{idk}/transaksi/invoice/{id}/print', 'Kasir\Transaksi\ViewController@printInvoice');
		Route::get('/{idk}/transaksi/invoice/{id}/print-kwitansi', 'Kasir\Transaksi\ViewController@printKwitansi');
		Route::get('/{id}/transaksi/history', 'Kasir\Transaksi\ViewController@history');
		Route::get('/{id}/transaksi/baru', 'Kasir\Transaksi\ViewController@create');
		Route::get('/{id}/transaksi/dp-baru', 'Kasir\Transaksi\ViewController@createDP');
		Route::get('/{idk}/transaksi/{id}', 'Kasir\Transaksi\ViewController@single');
		Route::post('/{idk}/transaksi/{id}/split', 'Kasir\Transaksi\PostController@split');
		Route::get('/{idk}/transaksi/{id}/split-revoke', 'Kasir\Transaksi\PostController@revokeSplit');
		Route::get('/{idk}/transaksi/{id}/edit', 'Kasir\Transaksi\ViewController@edit');

		Route::get('/{id}/deposit', 'Kasir\Transaksi\ViewController@deposit');
		Route::get('/{id}/deposit/single/{deposit_id}', 'Kasir\Transaksi\ViewController@depositSingle');

		
	});
});


Route::group(['prefix' => 'api/kasir'], function(){
	Route::post('/tagihan/pay', 'Kasir\Transaksi\PostController@pay');
	Route::post('/tagihan/diskon', 'Kasir\Transaksi\PostController@diskon');
	Route::post('/tagihan/delete', 'Kasir\Transaksi\DeleteController@delete');
	Route::post('/tagihan/getHistory', 'Kasir\Transaksi\ReadController@getHistory');
	Route::post('/tagihan/baru', 'Kasir\Transaksi\PostController@apiSubmit');
	Route::post('/tagihan/edit', 'Kasir\Transaksi\PostController@apiSubmit');
	Route::post('/tagihan/getPasienPembayaran', 'Kasir\Transaksi\ReadController@getPasienPembayaran');
	Route::post('/tagihan/getPasienPembayaranTunai', 'Kasir\Transaksi\ReadController@getPasienPembayaranTunai');
	Route::get('/tagihan/getLokasi', 'Kasir\Transaksi\ReadController@getLokasi');
	Route::post('/manajemen/delete', 'Kasir\Manajemen\DeleteController@delete');
	Route::get('/tagihan/getKategori', 'Kasir\Transaksi\ReadController@getKategori');
	Route::post('/tagihan/getLokasiKategoriId', 'Kasir\Transaksi\ReadController@getLokasiKategoriId');
	
});




?>