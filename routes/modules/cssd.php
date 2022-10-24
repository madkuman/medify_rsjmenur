<?php

Route::group(['middleware' => ['check-module']], function(){ 
	Route::group(['prefix' => 'cssd'], function() {
		Route::get('/','CSSD\Transaksi\ViewController@permintaanIndex');
		Route::get('/permintaan','CSSD\Transaksi\ViewController@permintaanIndex');
		Route::get('/permintaan/baru','CSSD\Transaksi\ViewController@permintaanBaru');
		Route::post('/permintaan/baru','CSSD\Transaksi\PostController@permintaanBaru');

		Route::get('/pengembalian','CSSD\Transaksi\ViewController@pengembalianIndex');
		Route::get('/pengembalian/baru','CSSD\Transaksi\ViewController@pengembalianBaru');
		Route::post('/pengembalian/baru','CSSD\Transaksi\PostController@pengembalianBaru');

		Route::get('/alkes','CSSD\Alkes\ViewController@index');
		Route::get('/alkes/baru','CSSD\Alkes\ViewController@baru');
		Route::post('/alkes/baru','CSSD\Alkes\PostController@baru');
		Route::get('/alkes/{id}','CSSD\Alkes\ViewController@single');
		Route::get('/alkes/{id}/print/label-semua','CSSD\Alkes\ViewController@printLabelSemua');
		Route::get('/alkes/{id}/edit','CSSD\Alkes\ViewController@edit');
		Route::post('/alkes/{id}/edit','CSSD\Alkes\PostController@edit');
		Route::post('/alkes/{id}/delete','CSSD\Alkes\PostController@delete');

		Route::post('/alkes-satuan/baru','CSSD\AlkesSatuan\PostController@baru');
		Route::post('/alkes-satuan/{id}/baru','CSSD\AlkesSatuan\PostController@delete');
		Route::get('/alkes-satuan/{id}','CSSD\AlkesSatuan\ViewController@single');
		Route::get('/alkes-satuan/{id}/print/label','CSSD\AlkesSatuan\ViewController@printLabel');

		Route::get('/transaksi/{id}','CSSD\Transaksi\ViewController@single');
		Route::post('/transaksi/{id}/kirim-alkes','CSSD\Transaksi\PostController@kirimAlkes');
		Route::post('/transaksi/{id}/kembalikan-alkes','CSSD\Transaksi\PostController@kembalikanAlkes');
		Route::post('/transaksi/{id}/tolak-transaksi','CSSD\Transaksi\PostController@tolakTransaksi');


		Route::get('/laporan','CSSD\Laporan\ViewController@index');
		Route::get('/laporan/rekap-penggunaan-alat','CSSD\Laporan\PostController@rekapPenggunaanAlat');
			
		Route::group(['prefix' => 'pengaturan'], function(){
			Route::get('/', 'CSSD\Pengaturan\ViewController@index');

			Route::group(['prefix' => 'paket'], function(){
				Route::get('/', 'CSSD\Paket\ViewController@index');
				Route::get('/show/{id}', 'CSSD\Paket\ViewController@show');
				Route::get('/create', 'CSSD\Paket\ViewController@create');
				Route::post('/new', 'KamarOperasi\Paket\PostController@new');
				Route::get('/edit/{id}', 'CSSD\Paket\ViewController@edit');
				Route::post('/edit/{id}', 'KamarOperasi\Paket\EditController@update');
				Route::get('/delete/{id}', 'KamarOperasi\Paket\EditController@destroy');
				Route::get('/{id}/print/label','CSSD\Paket\ViewController@printLabel');
			});
		});
	});
});

	Route::get('api/cssd/permintaan/index','CSSD\Transaksi\ReadController@permintaanIndexApi');
	Route::post('api/cssd/permintaan/index','CSSD\Transaksi\ReadController@permintaanIndexApi');

	Route::get('api/cssd/pengembalian/index','CSSD\Transaksi\ReadController@pengembalianIndexApi');
	Route::post('api/cssd/pengembalian/index','CSSD\Transaksi\ReadController@pengembalianIndexApi');

	Route::get('api/cssd/cek-jadwal-operasi','CSSD\Transaksi\ReadController@cekJadwalOperasiApi');
	Route::get('api/cssd/alkes-satuan/get/{slug}','CSSD\AlkesSatuan\ReadController@cekPengiriman');

	Route::get('api/cssd/alkes/search','CSSD\Alkes\ReadController@search');
	Route::get('api/cssd/alkes/paket/get/{slug}','CSSD\Paket\ReadController@getPaket');

	Route::get('api/cssd/permintaan-baru','CSSD\Transaksi\PostController@ApiTransaksiBaruPost');

?>