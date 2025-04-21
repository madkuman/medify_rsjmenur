<?php
Route::group(['prefix' => 'bpjs'], function () {
	Route::post('rujukan/get/kartu', 'BPJS\API\Rujukan\ReadController@getRujukanKartu');
	Route::get('rujukan/get/no-rujukan', 'BPJS\API\Rujukan\ReadController@getRujukanNomor');
	Route::post('rujukan/get-all/kartu', 'BPJS\API\Rujukan\ReadController@getAllRujukanKartu');
	Route::get('rujukan/create/get/kasus', 'BPJS\API\Rujukan\ReadController@getKasusFromPasien');
	Route::get('rujukan/create/get/sep', 'BPJS\API\Rujukan\ReadController@getSEPFromKasus');
	Route::post('rujukan/index/feed-table', 'BPJS\Rujukan\ReadController@feedIndexTable');

	Route::get('sep/search/{nomor_sep}', 'BPJS\API\Sep\ReadController@get');
	Route::post('sep/create', 'BPJS\SEP\PostController@create');
	Route::post('sep/pulang', 'BPJS\SEP\PostController@pulang');
	Route::post('sep/approve', 'BPJS\API\Sep\PostController@approve');
	Route::post('sep/pengajuan', 'BPJS\API\Sep\PostController@pengajuan');
	Route::post('sep/manual/{nomor_sep}', 'BPJS\API\Sep\PostController@manual');
	Route::post('sep/manual-inap/{nomor_sep}', 'BPJS\API\Sep\PostController@manualInap');

	Route::get('referensi/faskes', 'BPJS\API\Referensi\ReadController@getFaskes');
	Route::get('referensi/poli', 'BPJS\API\Referensi\ReadController@getPoli');
	Route::get('referensi/propinsi', 'BPJS\API\Referensi\ReadController@getPropinsi');
	Route::get('referensi/kabupaten/{propinsi}', 'BPJS\API\Referensi\ReadController@getKabupaten');
	Route::get('referensi/kecamatan/{kabupaten}', 'BPJS\API\Referensi\ReadController@getKecamatan');
	Route::get('referensi/applicare/kelas', 'BPJS\API\Referensi\ReadController@getKelasApplicare');

	Route::get('peserta/get/kartu/{no_kartu}/{tanggal}', 'BPJS\API\Peserta\ReadController@getByKartu');
	Route::get('peserta/get/nik/{nik}/{tanggal}', 'BPJS\API\Peserta\ReadController@getByNIK');
	Route::get('peserta/sync-pasien/{min}/{max}', 'BPJS\API\Peserta\PostController@syncPasien');

	Route::get('/user/dpjp/json', 'BPJS\User\ReadController@getAllDPJPEncoded');
	Route::get('/user/dpjp/id/{kode_dpjp}', 'BPJS\User\ReadController@getDpjpById');
	Route::get('/user/dpjp/{search}', 'BPJS\User\ReadController@getDpjp');

	// Rujuk Balik
	Route::get('rujuk-balik/search-by-no-srb', 'BPJS\API\RujukBalik\ReadController@getSRBbyNomor');
	Route::get('rujuk-balik/search-by-tanggal', 'BPJS\API\RujukBalik\ReadController@getSRBbyTanggal');

	Route::get('/rujukan-keluar/get-spesialis', 'BPJS\API\Rujukan\ReadController@getSpeliasis');
	Route::get('/surat-kontrol/get-poli', 'BPJS\API\RencanaKontrol\ReadController@getPoliRencanaKontrol');
});
