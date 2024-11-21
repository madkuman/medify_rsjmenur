<?php
Route::group(['middleware' => ['check-module']], function () {
	Route::group(['prefix' => 'bpjs'], function () {
		Route::get('/', 'BPJS\ViewController@index');
		Route::get('/approve', 'BPJS\SEP\ViewController@approve');
		Route::get('/pengajuan', 'BPJS\SEP\ViewController@pengajuan');
		Route::get('/ajax', 'BPJS\ReadController@getAll');
		Route::get('/kasus', 'BPJS\ReadController@getKasus');
		Route::get('/printrujuk/{id}', 'BPJS\ViewController@printrujuk');


		Route::get('/sep/search', 'BPJS\SEP\ViewController@search');
		Route::get('/sep/search-rujukan/{nomor_rujukan}', 'BPJS\SEP\ReadController@getSepRujukanSama');
		Route::get('/sep/search-pasien/{pasien_id}', 'BPJS\SEP\ReadController@getByNomorPasien');
		Route::get('/sep/create', 'BPJS\SEP\ViewController@create');
		Route::get('/sep/{no_sep}', 'BPJS\SEP\ViewController@single');
		Route::get('/sep/{no_sep}/print', 'BPJS\SEP\ViewController@print');
		Route::get('/sep/{no_sep}/print-potrait', 'BPJS\SEP\ViewController@printPotrait');
		Route::get('/sep/{no_sep}/print-rangkap3', 'BPJS\SEP\ViewController@printRangkap3');
		Route::get('/sep/{no_sep}/print2', 'BPJS\SEP\ViewController@print2');
		Route::get('/sep/{no_sep}/edit', 'BPJS\SEP\ViewController@edit');
		Route::post('/sep/{no_sep}/edit', 'BPJS\SEP\PostController@edit');
		Route::post('/sep/{no_sep}/delete', 'BPJS\SEP\PostController@delete');
		Route::get('/sep/{no_sep}/print-sep-bukti-layanan', 'BPJS\SEP\ViewController@printSepBuktiLayanan');
		Route::get('/sep/sync/{no_sep}', 'BPJS\API\Sep\ReadController@syncDataSep');


		//rujukan keluar
		Route::get('/rujukan-keluar', 'BPJS\Rujukan\ViewController@index');
		Route::get('/rujukan/create', 'BPJS\Rujukan\ViewController@create');
		Route::post('/rujukan/create', 'BPJS\Rujukan\PostController@setCreateV2');
		Route::get('/rujukan-keluar/{no_rujukan}', 'BPJS\Rujukan\ViewController@single');
		Route::get('/rujukan-keluar/{no_rujukan}/print', 'BPJS\Rujukan\ViewController@print');
		Route::get('/rujukan-keluar/{no_rujukan}/edit', 'BPJS\Rujukan\ViewController@edit');
		Route::post('/rujukan-keluar/{no_rujukan}/edit', 'BPJS\Rujukan\PostController@setEditV2');
		Route::post('/rujukan-keluar/{no_rujukan}/delete', 'BPJS\Rujukan\PostController@delete');
		Route::post('/rujukan-keluar/get-spesialis', 'BPJS\Rujukan\ReadController@getSpeliasis');

		//rujukan masuk
		Route::get('/rujukan', 'BPJS\Rujukan\ViewController@search');
		Route::get('/rujukan/search-kartu', 'BPJS\Rujukan\ViewController@search');

		Route::get('/rujukan-listsarana-ppkr', 'BPJS\RujukanListSaranaPPK\ViewController@index');


		// Rencana Kontrol BPJS
		Route::get('/rencana-kontrol/print', 'BPJS\RencanaKontrol\ViewController@printSKSI');
		Route::get('/rencana-kontrol/{jenis}', 'BPJS\RencanaKontrol\ViewController@index');
		Route::get('/rencana-kontrol/{jenis}/search', 'BPJS\RencanaKontrol\ViewController@search');
		Route::post('/rencana-kontrol/{jenis}/search', 'BPJS\RencanaKontrol\PostController@search');
		Route::get('/rencana-kontrol/{jenis}/create', 'BPJS\RencanaKontrol\ViewController@create');
		Route::get('/rencana-kontrol/edit/{jenis}/{no_sk}', 'BPJS\RencanaKontrol\ViewController@edit');

		// SPRI
		Route::get('/spri', 'BPJS\RencanaKontrol\SPRI\ViewController@index');

		// Rujuk Balik
		Route::get('/rujuk-balik', 'BPJS\RujukBalik\ViewController@index');
		Route::get('/rujuk-balik/search', 'BPJS\RujukBalik\ViewController@search');
		Route::get('/rujuk-balik/create', 'BPJS\RujukBalik\ViewController@create');
		Route::post('/rujuk-balik/create', 'BPJS\RujukBalik\PostController@create');
		Route::get('/rujuk-balik/edit/{id}', 'BPJS\RujukBalik\ViewController@edit');
		Route::post('/rujuk-balik/edit', 'BPJS\RujukBalik\PostController@edit');

		//Rujukan khusus
		Route::get('/rujukan-list-khusus', 'BPJS\RujukanKhusus\ViewController@index');
		Route::get('/rujukan-khusus/create', 'BPJS\RujukanKhusus\ViewController@create');
		Route::post('/rujukan-khusus/create', 'BPJS\RujukanKhusus\PostController@setCreate');
		Route::post('/rujukan-khusus/delete', 'BPJS\RujukanKhusus\PostController@delete');


		Route::get('peserta/sync-pasien', 'BPJS\API\Peserta\ViewController@syncPasien');
		Route::get('/auto-sep/generate/rawat-inap/{pasien_id}/{pasien_pembayaran_id}/{kasus_id}', 'BPJS\AutoSEP\CreateRawatInapController@generate');
		Route::get('/auto-sep/generate/{layanan_type}/{pasien_id}/{pasien_pembayaran_id}/{poliklinik_id}/{dokter_id?}/{debug?}', 'BPJS\AutoSEP\CreateController@generate');
		Route::get('/auto-sep/get-dokter/{pasien_pembayaran_id}', 'BPJS\AutoSEP\CreateController@generateDokter');

		Route::get('/piutang-asuransi', 'BPJS\Piutang\ViewController@index');


		Route::get('/monitoring/data-klaim', 'BPJS\Monitoring\DataKlaim\ViewController@index');
		Route::get('/monitoring/kunjungan', 'BPJS\Monitoring\Kunjungan\ViewController@index');
		Route::get('/monitoring/histori-pelayanan-peserta', 'BPJS\Monitoring\HistoriPelayananPeserta\ViewController@index');
		Route::get('/monitoring/data-klaim-jasa-raharja', 'BPJS\Monitoring\DataKlaimJasaRaharja\ViewController@index');

		Route::get('/monitoring/potensi-klaim', 'BPJS\Monitoring\PotensiKlaim\ViewController@index');
		Route::get('/monitoring/potensi-klaim/get-header', 'BPJS\Monitoring\PotensiKlaim\ReadController@header');
		Route::get('/monitoring/potensi-klaim/get-data', 'BPJS\Monitoring\PotensiKlaim\ReadController@data');

		//REFERENSI
		Route::get('/referensi', 'BPJS\Referensi\ViewController@index');
		Route::post('/referensi', 'BPJS\Referensi\PostController@submit');

		//ICARE
		Route::post('/icare', 'ThirdParty\BPJS\ICare\IcareController@getIcare')->name('icare');

		//ANTREAN
		Route::get('/antrean-online', 'BPJS\Antrean\PostController@getAntreanPerTanggal');
	});

	Route::group(['prefix' => 'api/bpjs'], function () {
		Route::get('/penagihan/getbyfilter', 'BPJS\Piutang\ReadController@getByFilter');
		Route::post('/edit-plafon', 'BPJS\SEP\EditController@editPlafon');

		Route::get('/monitoring/data-klaim/get-data', 'BPJS\Monitoring\DataKlaim\ViewController@getData');
		Route::get('/monitoring/data-klaim-jasa-raharja/get-data', 'BPJS\Monitoring\DataKlaimJasaRaharja\ViewController@getData');
		Route::get('/monitoring/kunjungan/get-data', 'BPJS\Monitoring\Kunjungan\ViewController@getData');
		Route::get('/monitoring/histori-pelayanan-peserta/get-data', 'BPJS\Monitoring\HistoriPelayananPeserta\ViewController@getData');

		// Rencana Kontrol 
		Route::get('rencana-kontrol/get', 'BPJS\RencanaKontrol\ReadController@getListDataRencanaKontrol');
		Route::get('rencana-kontrol/detail', 'BPJS\RencanaKontrol\ReadController@detail');
		Route::get('rencana-kontrol/data-dokter', 'BPJS\API\RencanaKontrol\ReadController@getDokterRencanaKontrol');
		Route::get('rencana-kontrol/skdp-sirp', 'BPJS\API\RencanaKontrol\PostController@getSkdpSirp');
		Route::post('rencana-kontrol/create', 'BPJS\API\RencanaKontrol\PostController@create');
		Route::post('rencana-kontrol/update', 'BPJS\API\RencanaKontrol\PostController@update');
		Route::post('rencana-kontrol/delete', 'BPJS\API\RencanaKontrol\PostController@delete');
		Route::get('/rencana-kontrol/getData', 'BPJS\RencanaKontrol\ReadController@getListDataRencanaKontrol');

		Route::get('/rujuk-balik/get-data', 'BPJS\RujukBalik\ReadController@getData');
		Route::get('/rujuk-balik/get-detail', 'BPJS\RujukBalik\ReadController@getDetail');
		Route::post('/rujuk-balik/kirim-vclaim', 'BPJS\RujukBalik\PostController@kirimVclaim');
		Route::post('/rujuk-balik/delete', 'BPJS\RujukBalik\PostController@delete');

		Route::get('/rujukan-khusus/get-data', 'BPJS\RujukanKhusus\ReadController@getData');
	});
});
