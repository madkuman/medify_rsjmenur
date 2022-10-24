<?php

Route::group(['middleware' => ['check-module']], function(){ 
	Route::group(['prefix' => 'igd'], function(){
		Route::get('/', 'IGD\Ruangan\ViewController@index');

		Route::get('/transaksi/pendaftaran/{id}', 'IGD\Transaksi\ViewController@single');
		Route::group(['prefix' => 'ruangan'], function(){
			Route::get('/', 'IGD\Ruangan\ViewController@index');
			Route::post('/', 'IGD\Ruangan\CreateController@create');
			Route::get('/tambah', 'IGD\Ruangan\ViewController@tambah');
			Route::get('/{id}', 'IGD\Ruangan\ViewController@single');
		});
		Route::group(['prefix' => 'transaksi'], function(){
			Route::get('/baru', 'IGD\Transaksi\ViewController@new');
			Route::post('/baru/konfirmasi', 'IGD\Transaksi\PostController@konfirmasiRuangan');
			Route::post('/baru/submit', 'IGD\Transaksi\PostController@submitRuangan');
			Route::get('/baru/{id}/{kasus_id?}', 'IGD\Transaksi\PostController@createPasien');
			Route::get('/update-pengisian/{id}/{nomor_kasus}','IGD\Transaksi\PostController@updatePengisian');
		});

		Route::group(['prefix' => 'triage'], function(){
			Route::get('/baru', 'IGD\Triage\ViewController@index');
			Route::post('/baru/create', 'IGD\Triage\PostController@create');
			Route::post('/baru/delete', 'IGD\Triage\PostController@delete');
		});

		Route::get('/antrian-screen', 'IGD\Antrian\ViewController@screen');
		Route::get('/antrian-mesin', 'IGD\Antrian\ViewController@mesin');
		Route::get('/antrian-button', 'IGD\Antrian\ViewController@button');
		Route::get('/antrian-list', 'IGD\Antrian\ViewController@list');


		Route::get('/histori-transaksi', 'IGD\Transaksi\ViewController@histori');
		Route::get('/statistik', 'IGD\Statistik\ViewController@index');

		Route::get('/pengaturan', 'IGD\Pengaturan\ViewController@index');
		Route::get('/pengaturan/ruangan/new', 'IGD\Pengaturan\ViewController@new');
		Route::get('/pengaturan/ruangan/edit/{id}', 'IGD\Pengaturan\ViewController@edit');

		Route::post('/pengaturan/ruangan/new', 'IGD\Pengaturan\PostController@new');
		Route::post('/pengaturan/ruangan/edit/{id}', 'IGD\Pengaturan\PostController@edit');
		Route::post('/pengaturan/ruangan/delete/{id}', 'IGD\Pengaturan\PostController@delete');

		Route::group(['prefix' => 'ambulans'], function(){
			Route::get('/', 'IGD\Ambulans\ViewController@index');
			Route::post('/', 'IGD\Ambulans\PostController@create');
			Route::post('/{id}/update', 'IGD\Ambulans\PostController@update');
			Route::post('/{id}/delete', 'IGD\Ambulans\PostController@delete');
		});
	});
});


Route::group(['prefix' => 'api/igd'], function(){
	Route::get('/transaksi/get', 'IGD\Transaksi\ReadController@APIHistori');
	Route::post('/triage/baru', 'IGD\Triage\CreateController@new');
	Route::get('/get-antrian-igd-left', 'IGD\Antrian\ViewController@getAntrianIGDLeft');
	Route::get('/antrian-mesin/request/{level_id}', 'IGD\Antrian\PostController@requestNomorAntrian');
	Route::get('/antrian-screen/update', 'IGD\Antrian\PostController@screenUpdateNomorAntrian');
	Route::get('/antrian-button/call-next/{loket_id}', 'IGD\Antrian\PostController@buttonCallNextAntrian');
	Route::get('/antrian-button/call/{loket_id}/{nomor_antrian}', 'IGD\Antrian\PostController@callAntrian');

	Route::group(['prefix' => 'ambulans'], function(){
		Route::get('/getEachJSON', 'IGD\Ambulans\ViewController@getJSON');
		Route::get('/getDataTable', 'IGD\Ambulans\ViewController@getDataTable');
	});

	Route::get('/statistik/kunjungan-pasien', 'IGD\Statistik\ReadController@getKunjungan');
	Route::get('/statistik/kunjungan-pasien-per-ruangan', 'IGD\Statistik\ReadController@getKunjunganPerRuangan');
	Route::get('/statistik/sepuluh-besar-penyakit', 'IGD\Statistik\ReadController@getSepuluhBesarPenyakit');
	Route::get('/statistik/pengunjung-pulang', 'IGD\Statistik\ReadController@getPengunjungPulang');
});

?>