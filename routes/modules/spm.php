<?php 

Route::group(['prefix' => 'spm'], function () {
	Route::get('/', 'SPM\ViewController@index');
	Route::get('/kematian-pasien', 'SPM\ViewController@kematianPasien');
	Route::get('/waktu-tunggu-rawat-jalan', 'SPM\ViewController@waktuTungguRawatJalan');
	Route::get('/pasien-pulang-paksa', 'SPM\ViewController@pasienPulangPaksa');
	Route::get('/los-pasien-jiwa', 'SPM\ViewController@LOSPasienJiwa');
	Route::get('/pasien-jiwa-readmisi','SPM\ViewController@PasienJiwaReAdmisi');
	Route::get('/operasi-masa-tunggu','SPM\ViewController@operasiMasaTunggu');
});

?>