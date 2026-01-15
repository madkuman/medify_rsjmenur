<?php
Route::get('rawatinap/boarding-pass/print/{id}', 'RawatInap\Transaksi\ViewController@printBoardingPass');
Route::get('rawatinap/print', 'RawatInap\Transaksi\ViewController@print2');
Route::group(['prefix' => 'rawatinap/transaksi'], function () {
	Route::get('/pendaftaran', 'RawatInap\Transaksi\ViewController@pendaftaran');
	Route::get('/pendaftaran/pasien', 'RawatInap\Transaksi\ViewController@pendaftaranPasien');
	Route::get('/pendaftaran/pasien/{id}', 'RawatInap\Transaksi\PostController@pendaftaranPasien');

	Route::get('/pendaftaran/ruangan', 'RawatInap\Transaksi\ViewController@pendaftaranRuangan');
	Route::post('/pendaftaran/ganti-metode-bayar', 'RawatInap\Transaksi\PostController@pendaftaranKonfirmasiPembayaran');
	Route::post('/pendaftaran/konfirmasi', 'RawatInap\Transaksi\PostController@pendaftaranKonfirmasi');
	Route::get('/pendaftaran/konfirmasi/print', 'RawatInap\Transaksi\ViewController@print');
	Route::post('/pendaftaran/submit', 'RawatInap\Transaksi\PostController@pendaftaranSubmit');
	Route::get('/pendaftaran/print-final/{id}', 'RawatInap\Transaksi\PostController@printFinal');
	Route::post('/pendaftaran/tolak', 'RawatInap\Transaksi\PostController@pendaftaranTolak');
	Route::post('/konfirmasi/{id}', 'RawatInap\Transaksi\PostController@konfirmasiDatang');
});

Route::group(['middleware' => ['check-module']], function () {
	Route::group(['prefix' => 'rawatinap'], function () {
		Route::get('/', 'RawatInap\Bangsal\ViewController@index');
		Route::get('/info-bangsal', 'RawatInap\Bangsal\ViewController@infoBangsal');
		Route::get('/info-bangsal/screen-tv', 'RawatInap\Bangsal\ViewController@screenTV');
		Route::get('/statistik', 'RawatInap\Statistik\ViewController@index');
		Route::get('/statistik/init', 'RawatInap\Statistik\ReadController@init');

		Route::group(['prefix' => 'cari'], function () {
			Route::get('/', 'RawatInap\Bangsal\ViewController@cari');
			Route::get('/download', 'RawatInap\Bangsal\ViewController@download');
		});

		Route::group(['prefix' => 'bangsal'], function () {
			Route::get('/', 'RawatInap\Bangsal\ViewController@index');
			Route::get('/{slug}', 'RawatInap\Bangsal\ViewController@single');
		});

		Route::group(['prefix' => 'pengaturan'], function () {
			Route::get('/', 'RawatInap\Pengaturan\Bangsal\ViewController@index');
			Route::get('/bangsal', 'RawatInap\Pengaturan\Bangsal\ViewController@index');
			Route::get('/bangsal/new', 'RawatInap\Pengaturan\Bangsal\ViewController@new');
			Route::post('/bangsal/new', 'RawatInap\Pengaturan\Bangsal\PostController@new');
			Route::get('/bangsal/{id}', 'RawatInap\Pengaturan\Bangsal\ViewController@single');
			Route::get('/bangsal/edit/{id}', 'RawatInap\Pengaturan\Bangsal\ViewController@edit');
			Route::post('/bangsal/edit/', 'RawatInap\Pengaturan\Bangsal\PostController@edit');
			Route::post('/bangsal/delete/', 'RawatInap\Pengaturan\Bangsal\PostController@delete');

			Route::post('/ruangan/new', 'RawatInap\Pengaturan\Ruangan\PostController@new');
			Route::get('/ruangan/{id}', 'RawatInap\Pengaturan\Ruangan\ViewController@single');
			Route::get('/ruangan/edit/{id}', 'RawatInap\Pengaturan\Ruangan\ViewController@edit');
			Route::post('/ruangan/edit', 'RawatInap\Pengaturan\Ruangan\PostController@edit');
			Route::post('/ruangan/delete', 'RawatInap\Pengaturan\Ruangan\PostController@delete');

			Route::post('/bed/new', 'RawatInap\Pengaturan\TempatTidur\PostController@new');
			Route::post('/bed/edit', 'RawatInap\Pengaturan\TempatTidur\PostController@edit');
			Route::post('/bed/delete', 'RawatInap\Pengaturan\TempatTidur\PostController@delete');

			Route::post('/foto/delete', 'RawatInap\Pengaturan\Foto\DeleteController@delete');
		});


		Route::get('/histori-transaksi', 'RawatInap\Transaksi\ViewController@histori');

		Route::post('/transaksi/rekam-medis/konfirmasi/{id}', 'RawatInap\Transaksi\PostController@konfirmasiFile');
		Route::get('dummy/ruangan/setup', 'RawatInap\Main\DummyController@ruangan');
		Route::get('dummy/tempattidur/setup', 'RawatInap\Main\DummyController@tempattidur');

		# halaman serah terima obat
		Route::get('/transaksi/{id}/serah-terima-obat', 'RawatInap\Transaksi\ViewController@serahTerimaObat');
		Route::post('/transaksi/{id}/serah-terima-obat', 'RawatInap\Transaksi\PostController@serahTerimaObat');
	});
});


Route::group(['prefix' => 'api/rawatinap'], function () {
	Route::get('/transaksi/get', 'RawatInap\Transaksi\ReadController@APIHistori');
	Route::post('/tempattidur/kosong', 'RawatInap\TempatTidur\ReadController@apiRuanganKosong');
	Route::get('/tempattidur/kosong', 'RawatInap\TempatTidur\ReadController@apiRuanganKosong');
	Route::get('/applicare/truncate', 'RawatInap\Pengaturan\Ruangan\PostController@truncateApplicare');
	Route::get('/admin/bangsal-info/{id}', 'RawatInap\Bangsal\ReadController@APIAdminInfo');
	Route::get('/bangsal', 'RawatInap\Bangsal\ReadController@allBangsal');
});
