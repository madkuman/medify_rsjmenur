<?php

Route::group(['prefix' => 'remunerasi'], function(){
    Route::get('/', 'Remunerasi\Dashboard\ViewController@index');

    // Absensi
    Route::group(['prefix' => 'absensi'], function () {
        Route::get('/', 'Remunerasi\Absensi\ViewController@index');
        Route::get('/baru', 'Remunerasi\Absensi\ViewController@create');
        Route::post('/create', 'Remunerasi\Absensi\CreateController@create');
        Route::post('/delete/{id}', 'Remunerasi\Absensi\DeleteController@delete');
    });

    // Keuangan
    Route::group(['prefix' => 'keuangan'], function () {
        Route::get('/', 'Remunerasi\Keuangan\ViewController@index');
        Route::get('/baru', 'Remunerasi\Keuangan\ViewController@create');
        Route::post('/create', 'Remunerasi\Keuangan\CreateController@create');
        Route::post('/delete/{id}', 'Remunerasi\Keuangan\DeleteController@delete');
    });

    // Denda
    Route::group(['prefix' => 'denda'], function () {
        Route::get('/', 'Remunerasi\Denda\ViewController@index');
        Route::post('/create', 'Remunerasi\Denda\PostController@store');
    });

    // Beban Kerja
    Route::group(['prefix' => 'beban-kerja'], function () {
        Route::get('/', 'Remunerasi\BebanKerja\ViewController@index');
        Route::post('/create', 'Remunerasi\BebanKerja\PostController@create');
        Route::post('/update', 'Remunerasi\BebanKerja\PostController@update');
    });

     // Resiko Kerja
     Route::group(['prefix' => 'resiko-kerja'], function () {
        Route::get('/', 'Remunerasi\ResikoKerja\ViewController@index');
        Route::post('/create', 'Remunerasi\ResikoKerja\PostController@create');
        Route::post('/update', 'Remunerasi\ResikoKerja\PostController@update');
    });

    // Pajak
    Route::group(['prefix' => 'pajak'], function () {
        Route::get('/', 'Remunerasi\Pajak\ViewController@index');
        Route::post('/create', 'Remunerasi\Pajak\PostController@create');
        Route::post('/update', 'Remunerasi\Pajak\PostController@update');
    });

    // Dana
    Route::group(['prefix' => 'dana'], function () {
        Route::get('/', 'Remunerasi\Dana\ViewController@index');
        Route::post('/', 'Remunerasi\Dana\CreateController@create');
        Route::post('/create', 'Remunerasi\Dana\CreateController@create');
        Route::post('/edit', 'Remunerasi\Dana\EditController@edit');
        Route::post('/delete/{id}', 'Remunerasi\Dana\DeleteController@delete');
    });

     // Laporan
     Route::group(['prefix' => 'laporan'], function () {
        Route::get('/', 'Remunerasi\Laporan\ViewController@index');
        Route::get('/personal/{id}', 'Remunerasi\Laporan\ReadController@laporanPersonal');
        Route::get('/pegawai', 'Remunerasi\Laporan\ReadController@laporanPegawai');
         Route::post('/create', 'Remunerasi\Laporan\PostController@create');
    });

    // Master Index
    Route::group(['prefix' => 'master-index'], function () {
        Route::get('/', 'Remunerasi\MasterIndex\ViewController@index');
    });

    Route::group(['prefix' => 'api'], function () {
        Route::get('/get-pegawai', 'Remunerasi\ReadController@getPegawai');
        // Absensi
        Route::post('/data-absensi', 'Remunerasi\Absensi\ReadController@index');
        // Keuangan
        Route::post('/data-keuangan', 'Remunerasi\Keuangan\ReadController@index');
         // Dana
         Route::post('/data-dana', 'Remunerasi\Dana\ReadController@index');
        // Denda
        Route::post('/data-denda', 'Remunerasi\Denda\ReadController@index');
        // Pajak
        Route::post('/data-pajak', 'Remunerasi\Pajak\ReadController@index');
        // Beban Kerja
        Route::post('/data-beban-kerja', 'Remunerasi\BebanKerja\ReadController@index');
        // Resiko Kerja
        Route::post('/data-resiko-kerja', 'Remunerasi\ResikoKerja\ReadController@index');
         // Laporan
         Route::post('/data-laporan', 'Remunerasi\Laporan\ReadController@remunerasi');
        Route::get('/data-laporan-index-pajak', 'Remunerasi\Laporan\ReadController@totalIndexPajak');
    });
    
});

