<?php

Route::group(['prefix' => 'mobile-bpjs'], function () {
	Route::get('test', function () {
		return app('App\Http\Controllers\ThirdParty\MobileBPJS\HelperController')
			->success(['connected' => TRUE]);
	});
	Route::get('get-token', 'ThirdParty\MobileBPJS\ReadController@getToken');

	/** operasi */
	Route::post('operasi/get-jadwal-harian', 'ThirdParty\MobileBPJS\Operasi\ReadController@getJadwalOperasi');
	Route::post('operasi/list-booking', 'ThirdParty\MobileBPJS\Operasi\ReadController@getListKodeBooking');
	Route::post('operasi/get-jadwal-rs', 'ThirdParty\MobileBPJS\Operasi\ReadController@getJadwalOperasiRs');
	Route::post('operasi/get-jadwal-pasien', 'ThirdParty\MobileBPJS\Operasi\ReadController@getJadwalOperasiPasien');
	/** end operasi */

	/** antrean */
	Route::post('antrean/get-antrean', 'ThirdParty\MobileBPJS\Antrean\PostController@getAntrean');
	Route::post('antrean/get-status-antrean', 'ThirdParty\MobileBPJS\Antrean\PostController@getStatusAntrean');
	Route::post('antrean/sisa-antrean', 'ThirdParty\MobileBPJS\Antrean\PostController@getSisaAntrean');
	Route::post('antrean/batal-antrean', 'ThirdParty\MobileBPJS\Antrean\PostController@batalAntrean');
	//v1
	Route::post('antrean/get-no-antrean', 'ThirdParty\MobileBPJS\Antrean\PostController@getNoAntrean');
	Route::post('antrean/get-rekap-no-antrean', 'ThirdParty\MobileBPJS\Antrean\PostController@getRekapNoAntrean');

	/** end antrean */
	Route::post('pasien/check-in', 'ThirdParty\MobileBPJS\Pasien\PostController@checkIn');
	Route::post('pasien/baru', 'ThirdParty\MobileBPJS\Pasien\PostController@pasienBaru');

	/** antrean farmasi */
	Route::post('farmasi/get-antrean', 'ThirdParty\MobileBPJS\Farmasi\PostController@getAntrean');
});
