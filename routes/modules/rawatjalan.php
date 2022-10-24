<?php

Route::post('rawatjalan/transaksi/layani', 'RawatJalan\Transaksi\PostController@layaniPasien');
Route::get('rawatjalan/transaksi/pendaftaran/{id}', 'RawatJalan\Transaksi\ViewController@single');
Route::get('rawatjalan/transaksi/sep-edit/{id}', 'RawatJalan\Transaksi\ViewController@sepEdit');
Route::post('rawatjalan/transaksi/sep-edit/{id}', 'RawatJalan\Transaksi\PostController@sepEdit');
Route::get('rawatjalan/antrian/print/{id}', 'RawatJalan\Transaksi\ViewController@printAntrian');
Route::get('rawatjalan/boarding-pass/print/{id}', 'RawatJalan\Transaksi\ViewController@printBoardingPass');
Route::get('rawatjalan/boarding-pass/print-light/{id}', 'RawatJalan\Transaksi\ViewController@printBoardingPassLight');
Route::get('rawatjalan/videomod/{id}','RawatJalan\Video\ViewController@mod');
Route::post('rawatjalan/video/transaksi/end-session','RawatJalan\Video\PostController@end');
Route::post('rawatjalan/video/transaksi/restore-session','RawatJalan\Video\PostController@restore');

Route::group(['middleware' => ['check-module']], function(){
	Route::group(['prefix' => 'rawatjalan'], function(){
		Route::get('/', 'RawatJalan\Poliklinik\ViewController@index');
		Route::get('/statistik', 'RawatJalan\Statistik\ViewController@index');

		Route::get('/get-dokter/{id}', 'RawatJalan\Dokter\ReadController@getByPoli' );

		Route::group(['prefix' => 'poliklinik'], function(){
			Route::get('/', 'RawatJalan\Poliklinik\ViewController@index');
			Route::get('/antrian', 'RawatJalan\Transaksi\ViewController@all');
			Route::get('/antrian/baru', 'RawatJalan\Transaksi\ViewController@new');
			Route::get('/antrian/baru/{id}/{kasus_id?}', 'RawatJalan\Transaksi\PostController@createPasien');
			Route::post('/antrian/baru/konfirmasi', 'RawatJalan\Transaksi\PostController@konfirmasiAntrian');
			Route::post('/antrian/baru/submit', 'RawatJalan\Transaksi\PostController@submitAntrian');
			Route::get('/{id}', 'RawatJalan\Transaksi\ViewController@index');
			Route::post('/{id}', 'RawatJalan\Transaksi\ViewController@index');
		});

		Route::group(['prefix' => 'pengaturan'], function(){
			Route::get('/', 'RawatJalan\Pengaturan\Poliklinik\ViewController@index');
			Route::get('/poliklinik/new', 'RawatJalan\Pengaturan\Poliklinik\ViewController@new');
			Route::get('/poliklinik/edit/{id}', 'RawatJalan\Pengaturan\Poliklinik\ViewController@edit');

			Route::post('/poliklinik/new', 'RawatJalan\Pengaturan\Poliklinik\PostController@create');
			Route::post('/poliklinik/edit/{id}', 'RawatJalan\Pengaturan\Poliklinik\PostController@edit');
			Route::post('/poliklinik/delete/{id}', 'RawatJalan\Pengaturan\Poliklinik\PostController@delete');
		});
		Route::get('/histori-transaksi', 'RawatJalan\Histori\ViewController@index');
		Route::post('/transaksi/pendaftaran/tolak','RawatJalan\PermintaanRujuk\EditController@batal');
		Route::post('/transaksi/cancel','RawatJalan\Transaksi\PostController@cancel');
		Route::post('/transaksi/rekam-medis/konfirmasi/{id}','RawatJalan\Transaksi\PostController@konfirmasiFile');
		Route::post('/transaksi/rekam-medis/kembalikan/{id}','RawatJalan\Transaksi\PostController@kembalikanFile');

		Route::get('/pendaftaran-online', 'RawatJalan\PendaftaranOnline\ViewController@index');
		Route::post('/pendaftaran-online/check-in', 'RawatJalan\PendaftaranOnline\ViewController@checkIn');
        Route::get('/pendaftaran-online/generate/auto-sep/{transaksi_id}', 'RawatJalan\Transaksi\PostController@generateAutoSEP');
        Route::get('/pendaftaran-online/edit/status/{transaksi_id}/{status}', 'RawatJalan\Transaksi\EditController@editTransaksiStatus');

		Route::get('/screen-tv', 'RawatJalan\MasterTv\ViewController@listScreen');
		Route::post('/screen-tv/baru', 'RawatJalan\MasterTv\PostController@create');
		Route::post('/screen-tv/hapus', 'RawatJalan\MasterTv\PostController@hapus');
		Route::get('/antrian-screen/{master_tv_slug}', 'RawatJalan\MasterTv\ViewController@screenView');

		Route::get('/ruangan', 'RawatJalan\Ruangan\ViewController@index');
		Route::post('/ruangan/baru', 'RawatJalan\Ruangan\PostController@create');
		Route::post('/ruangan/hapus', 'RawatJalan\Ruangan\PostController@delete');
	});
});

Route::group(['prefix' => 'api/rawatjalan'], function(){
	Route::get('/transaksi/get', 'RawatJalan\Transaksi\ReadController@APIHistori');
	Route::get('/antrian/{id}', 'RawatJalan\Transaksi\ReadController@APIAntrian');
	Route::get('/antrian-screen/update/{level}', 'RawatJalan\AntrianCall\PostController@screenUpdateNomorAntrian');
	Route::get('/antrian-screen/call/{id}/{ruangan_id}', 'RawatJalan\AntrianCall\PostController@callAntrian');
	Route::get('/antrian-screen/call-next/{poli_id}/{ruangan_id}', 'RawatJalan\AntrianCall\PostController@callAntrianNext');
	Route::get('/screen-tv/{id}', 'RawatJalan\MasterTv\PostController@getDetail');
	// Route::get('/ruangan/online/{id}', 'RawatJalan\Ruangan\PostController@setOnline'); //untuk changes online offline
	Route::get('/dokter/jadwal/get', 'RawatJalan\DokterJadwal\ReadController@getDokterJadwal');
	Route::get('/dokter/jadwal/today', 'RawatJalan\DokterJadwal\ReadController@getDokterToday');
	Route::get('/dokter/jadwal/today/poli/{poli_id}', 'RawatJalan\DokterJadwal\ReadController@getDokterTodayByPoli');
	Route::get('/dokter-bpjs/jadwal/today/poli/{kode_bpjs_poli}', 'RawatJalan\DokterJadwal\ReadController@getDokterBPJSTodayByPoli');
	Route::get('/dokter-bpjs/all', 'RawatJalan\DokterJadwal\ReadController@getDokterBPJS');
	Route::get('/distribusi-poli', 'RawatJalan\Statistik\ReadController@getDistribusiPoli');
	Route::get('/jenis-pasien', 'RawatJalan\Statistik\ReadController@getDistribusiPasienType');
	Route::get('/pasien-baru', 'RawatJalan\Statistik\ReadController@getDistribusiPasienCreated');

    Route::get('/video/notification/{id}','RawatJalan\Video\ReadController@modNotif');
    Route::post('/video/connecting','RawatJalan\Video\PostController@connect');
    Route::post('/video/accepted','RawatJalan\Video\PostController@accepted');
    Route::post('/video/declined','RawatJalan\Video\PostController@declined');
    Route::post('/video/disconnect','RawatJalan\Video\PostController@disconnect');
    Route::post('/video/off','RawatJalan\Video\PostController@off');
});
?>