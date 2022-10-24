<?php
Route::group(['middleware' => ['check-module']], function(){
	Route::group(['prefix' => 'kamarjenazah'], function(){
		Route::get('', 'KamarJenazah\ViewController@index');
		Route::get('layanan','KamarJenazah\ViewController@layanan');
		Route::get('layanan/new','KamarJenazah\ViewController@buatlayanan');
		Route::get('layanan/edit','KamarJenazah\ViewController@editlayanan');
		Route::get('layanan/delete','KamarJenazah\ViewController@deletelayanan');
		Route::get('permintaan_jemput', 'KamarJenazah\ViewController@permintaan');
		Route::get('permintaan_jemput/{id}', 'KamarJenazah\ViewController@permintaanJemput');
		Route::get('detil-permintaan/{id}','KamarJenazah\ViewController@detilPermintaan');
		Route::get('detil-transaksi/{id}','KamarJenazah\ViewController@detilTransaksi');
		Route::get('transaksi/new/{id}','KamarJenazah\ViewController@transaksi');
		Route::get('transaksi/sertifikat/{id}','KamarJenazah\ViewController@sertifikat');
		Route::get('transaksi/invoice/{id}','KamarJenazah\ViewController@invoice');
		Route::get('transaksi','KamarJenazah\ViewController@historyTransaksi');
		Route::get('transaksi/edit/{id}','KamarJenazah\ViewController@editTransaksi');
	});
});

Route::group(['prefix' => 'api/kamarjenazah'], function(){
	Route::get('/get','KamarJenazah\ReadController@getPermintaan');
	Route::get('/layanan/get','KamarJenazah\ReadController@getLayanan');
	Route::post('/layanan/new','KamarJenazah\PostController@APICreateLayanan');
	Route::post('/layanan/edit','KamarJenazah\PostController@APIEditLayanan');
	Route::post('/layanan/delete','KamarJenazah\PostController@APIDeletelayanan');
	Route::post('/permintaan-baru','KamarJenazah\PostController@APICreatePermintaan');
	Route::post('/permintaan/delete','KamarJenazah\PostController@APIDeletePermintaan');
	Route::post('/transaksi/new','KamarJenazah\PostController@APICreateTransaksi');
	Route::post('/transaksi','KamarJenazah\PostController@APINewTransaksi');
	Route::post('/transaksi/delete','KamarJenazah\PostController@APIDeleteTransaksi');
	Route::post('/transaksi/edit','KamarJenazah\PostController@APIEditTransaksi');
	Route::get('/transaksi/get','KamarJenazah\ReadController@gethistoryTransaksi');
});
?>
