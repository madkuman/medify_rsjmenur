<?php

Route::group(['middleware' => ['check-module']], function(){
	Route::group(['prefix' => 'highlevelreport'], function(){
		Route::get('/', 'HighLevel\ViewController@index');
		Route::get('/igd', 'HighLevel\IGDController@index');
		Route::get('/poli', 'HighLevel\PoliController@index');
		Route::get('/rawatinap', 'HighLevel\RawatInapController@index');
		Route::get('/labpk', 'HighLevel\LabPKController@index');
		Route::get('/labpa', 'HighLevel\LabPAController@index');
		Route::get('/radiologi', 'HighLevel\RadiologiController@index');
		Route::get('/kepegawaian', 'HighLevel\KepegawaianController@index');
		Route::get('/aset', 'HighLevel\AsetController@index');
		Route::get('/gizi', 'HighLevel\GiziController@index');
		Route::get('/gudang', 'HighLevel\GudangController@index');
		Route::get('/farmasi', 'HighLevel\FarmasiController@index');
		Route::get('/keuangan', 'HighLevel\KeuanganController@index');
		Route::get('/ok', 'HighLevel\OKController@index');
		Route::get('/pasien', 'HighLevel\PasienController@index');
	});

	Route::group(['prefix' => 'api/highlevelreport'], function(){
		Route::get('/gudang/get-data/{type}', 'HighLevel\GudangController@getData');
		Route::get('/farmasi/get-data/transaksi/{type}', 'HighLevel\FarmasiController@getTransaksiBulanan');
	});


		Route::get('/gudang', 'HighLevel\GudangController@index');
});

?>