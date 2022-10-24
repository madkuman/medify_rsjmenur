<?php
Route::group(['prefix' => 'rekammedis'], function(){
	#Route::get('/', 'RekamMedis\Dashboard\ViewController@index');
	Route::group(['middleware' => ['check-module']], function(){
		Route::get('/', 'RekamMedis\Transaksi\ViewController@permintaan');
		Route::get('/permintaan', 'RekamMedis\Transaksi\ViewController@permintaan');
		Route::get('/permintaan/baru', 'RekamMedis\Transaksi\ViewController@permintaanBaru');
		Route::post('/permintaan/baru', 'RekamMedis\Transaksi\PostController@permintaanBaru');
		Route::get('/transaksi/permintaan/kirim', 'RekamMedis\Transaksi\ViewController@permintaanKirim');
		Route::post('/transaksi/permintaan/kirim', 'RekamMedis\Transaksi\PostController@permintaanKirim');
		Route::post('/transaksi/permintaan/konfirmasi', 'RekamMedis\Transaksi\PostController@konfirmasiPenerimaanAPI');
		
		Route::get('/pengembalian', 'RekamMedis\Transaksi\ViewController@pengembalian');
		Route::get('/transaksi/pengembalian/konfirmasi', 'RekamMedis\Transaksi\ViewController@pengembalianKonfirmasi');
		Route::post('/transaksi/pengembalian/konfirmasi', 'RekamMedis\Transaksi\PostController@pengembalianKonfirmasi');
		
		Route::post('/transaksi/transfer-rm', 'RekamMedis\Transaksi\PostController@transferBaru');
		Route::post('/transaksi/ambil-rm', 'RekamMedis\Transaksi\PostController@ambilRM');


		Route::get('/cari', 'RekamMedis\ViewController@cariRM');
		Route::get('/file-tidak-di-rm', 'RekamMedis\ViewController@fileTidakDiRM');
		Route::get('/file-rm/{no_rm}', 'RekamMedis\ViewController@single');
	});

	Route::get('/transaksi/transfer/{id}', 'RekamMedis\Transaksi\ViewController@transferBaru');

	Route::post('/transaksi/{id}/setuju-pengiriman', 'RekamMedis\Transaksi\PostController@setujuPengiriman');
	Route::post('/transaksi/{id}/konfirmasi-penerimaan', 'RekamMedis\Transaksi\PostController@konfirmasiPenerimaan');
	Route::post('/transaksi/{id}/tolak-pengiriman', 'RekamMedis\Transaksi\PostController@tolakPengiriman');
	Route::post('/transaksi/{id}/tolak-penerimaan', 'RekamMedis\Transaksi\PostController@tolakPenerimaan');

	Route::get('/transaksi/{id}', 'RekamMedis\Transaksi\ViewController@single');
});

/*DEPRECATED
Route::get('', 'RekamMedis\ViewController@index');
	Route::get('cari/{id}', 'RekamMedis\ViewController@DetailRekamMedis');
	Route::get('index', 'RekamMedis\ViewController@index');
	Route::get('dashboard', 'RekamMedis\ViewController@index');
	Route::get('cari', 'RekamMedis\ViewController@cari');
	Route::get('permintaan', 'RekamMedis\ViewController@permintaan');
	Route::get('permintaanbaru', 'RekamMedis\ViewController@permintaanbaru');
	Route::get('permintaan/{id}', 'RekamMedis\ViewController@DetailPermintaan');
	Route::get('penerimaan', 'RekamMedis\ViewController@penerimaan');
	Route::get('penerimaan/{id}', 'RekamMedis\ViewController@DetailPenerimaan');
	Route::get('pengembalian', 'RekamMedis\ViewController@pengembalian');
	Route::get('pengembalian/{id}', 'RekamMedis\ViewController@DetailPengembalian');
	Route::get('permintaan/{id}/kirimpermintaan', 'RekamMedis\EditController@createPengiriman');
	Route::get('penerimaan/{id}/terimarekammedis', 'RekamMedis\EditController@createPenerimaan');
	Route::get('pengembalian/{id}/terimapengembalian', 'RekamMedis\EditController@createPengembalian');

	Route::post('baru', 'RekamMedis\CreateController@createPermintaan');
	Route::post('tolak', 'RekamMedis\CreateController@tolakPermintaan');
*/