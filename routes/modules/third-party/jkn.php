<?php

use Illuminate\Support\Facades\Route;

Route::group([
        'prefix' => 'jkn',
        'namespace' => 'ThirdParty\BPJS\JKN',
        'middleware' => 'debug-false'
    ], function () {
    Route::group(['prefix' => 'dashboard', 'namespace' => 'Dashboard'], function () {
        Route::get('waktutunggu/tanggal/{tanggal}/waktu/{waktu}', 'ReadController@getHarian');
        Route::get('waktutunggu/bulan/{bulan}/tahun/{tahun}/waktu/{waktu}',
            'ReadController@bulanan');
    });

    Route::group(['prefix' => 'antrean', 'namespace' => 'Antrean'], function () {
        Route::post('add', 'CreateController@addAntrean');
        Route::post('updatewaktu', 'PostController@updateWaktuAntrean');
        Route::post('batal', 'PostController@batal');
        Route::post('getlisttask', 'ReadController@getListTask');
    });

    Route::group(['prefix' => 'jadwaldokter', 'namespace' => 'JadwalDokter'], function() {
        Route::get('kodepoli/{kodepoli}/tanggal/{tanggal}', 'ReadController@getReferensiJadwalDokter');
        Route::post('updatejadwaldokter','EditController@updateJadwalDokter');
    });
    Route::group(['prefix' => 'ref', 'namespace' => 'Referensi'], function() {
        Route::get('{url}', 'ReadController@getReferensi');
    });
});