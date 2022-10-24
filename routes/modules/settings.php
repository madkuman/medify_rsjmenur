<?php

	Route::group(['prefix' => '/settings'], function(){
		Route::get('/account', 'Users\Settings\ViewController@account');
		Route::get('/password', 'Users\Settings\ViewController@password');
		Route::get('/profession', 'Users\Settings\ViewController@profession');
		Route::get('/publication', 'Users\Settings\ViewController@publication');
		Route::get('/sync', 'Users\Settings\ViewController@sync');
		Route::get('/tanda-tangan', 'Users\Settings\ViewController@tandaTangan');
		Route::get('/perizinan-akses', 'Users\Settings\ViewController@perizinanAkses');


		Route::post('/account', 'Users\Settings\PostController@account');
		Route::post('/password', 'Users\Settings\PostController@password');
		Route::post('/profession', 'Users\Settings\PostController@profession');
		Route::post('/publication', 'Users\Settings\PostController@publication');
		Route::post('/sync', 'Users\Settings\PostController@sync');
		Route::post('/integrasi-dpjp', 'Users\Settings\PostController@DPJP');
		Route::post('/tanda-tangan', 'Users\Settings\PostController@tandaTangan');
		Route::post('/perizinan-akses', 'Users\Settings\PostController@perizinanAkses');


		Route::get('/dokter-paket-obat', 'Users\Settings\PaketObat\ViewController@index');
		Route::post('/dokter-paket-obat/create', 'Users\Settings\PaketObat\PostController@create');
		Route::post('/dokter-paket-obat/edit', 'Users\Settings\PaketObat\PostController@edit');
		Route::post('/dokter-paket-obat/delete', 'Users\Settings\PaketObat\PostController@delete');
		Route::post('/dokter-paket-obat/subscribe/delete', 'Users\Settings\PaketObat\PostController@deleteSubscription');
		
	});
	Route::group(['prefix' => 'api/paket-obat'], function(){
		Route::get('/get/all', 'Users\Settings\PaketObat\ReadController@getAllAPI');
		Route::get('/get/{id}', 'Users\Settings\PaketObat\ReadController@getAPI');
		Route::get('/subscribe/{id}', 'Users\Settings\PaketObat\PostController@subscribePaket');
	});
?>