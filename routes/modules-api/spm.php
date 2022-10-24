<?php 

Route::group(['prefix' => 'spm'], function () {
	Route::get('/kematian-pasien', 'SPM\ReadController@kematianPasien');
	Route::get('/waktu-tunggu-rawat-jalan', 'SPM\ReadController@waktuTungguRawatJalan');
	Route::get('/pasien-pulang-paksa', 'SPM\ReadController@pasienPulangPaksa');
	Route::get('/los-pasien-jiwa', 'SPM\ReadController@LOSPasienJiwa');
	Route::get('/pasien-jiwa-readmisi','SPM\ReadController@PasienJiwaReAdmisi');
	Route::get('/operasi-masa-tunggu','SPM\ReadController@operasiMasaTunggu');

});

?>