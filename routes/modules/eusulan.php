<?php
Route::group(['prefix' => 'e-usulan'], function(){
    Route::group(['prefix' => 'pengaturan','middleware' => 'group-check-admin:e-usulan'], function () {
        Route::get('/', 'Eusulan\Pengaturan\ViewController@index');

        Route::group(['prefix' => 'akun-rekening'], function () {
            Route::get('/', 'Eusulan\Pengaturan\AkunRekening\ViewController@index');
            Route::post('/save', 'Eusulan\Pengaturan\AkunRekening\PostController@save');
            Route::post('/edit', 'Eusulan\Pengaturan\AkunRekening\PostController@edit');
            Route::post('/delete/{id}', 'Eusulan\Pengaturan\AkunRekening\PostController@delete');
        });

        Route::group(['prefix' => 'barang'], function () {
            Route::get('/', 'Eusulan\Pengaturan\Barang\ViewController@index');
            Route::post('/save', 'Eusulan\Pengaturan\Barang\PostController@save');
            Route::post('/edit', 'Eusulan\Pengaturan\Barang\PostController@edit');
            Route::post('/delete/{id}', 'Eusulan\Pengaturan\Barang\PostController@delete');
        });

        Route::group(['prefix' => 'unit'], function () {
            Route::get('/', 'Eusulan\Pengaturan\Unit\ViewController@index');
            Route::post('/save', 'Eusulan\Pengaturan\Unit\PostController@save');
            Route::post('/edit', 'Eusulan\Pengaturan\Unit\PostController@edit');
            Route::post('/delete/{id}', 'Eusulan\Pengaturan\Unit\PostController@delete');
        });

        Route::group(['prefix' => 'ubah-usulan'], function () {
            Route::get('/', 'Eusulan\Pengaturan\UbahUsulan\ViewController@index');
            Route::post('/save', 'Eusulan\Pengaturan\UbahUsulan\PostController@save');
            Route::post('/edit', 'Eusulan\Pengaturan\UbahUsulan\PostController@edit');
            Route::post('/delete/{id}', 'Eusulan\Pengaturan\UbahUsulan\PostController@delete');
        });
    });

    Route::group(['prefix' => 'laporan'], function () {
        Route::get('/', 'Eusulan\Laporan\ViewController@index');


        Route::get('/laporan-usulan-final', 'Eusulan\Laporan\PostController@laporanUsulanFinal');
        Route::get('/laporan-usulan-rekap', 'Eusulan\Laporan\PostController@laporanUsulanRekap');
    });

    Route::get('/', 'Eusulan\Usulan\ViewController@index');
    Route::get('/download-contoh-file', 'Eusulan\Usulan\ViewController@downloadContoh')->name('download-contoh-file-e-usulan');
    Route::get('/baru', 'Eusulan\Usulan\ViewController@baru');
    Route::post('/baru', 'Eusulan\Usulan\PostController@create');
    Route::get('/{id}', 'Eusulan\Usulan\ViewController@detail');
    Route::get('/{id}/edit', 'Eusulan\Usulan\ViewController@edit');
    Route::post('{id}/delete', 'Eusulan\Usulan\PostController@delete');
    Route::post('{id}/edit', 'Eusulan\Usulan\PostController@edit');
    Route::get('/{id}/print', 'Eusulan\Usulan\ViewController@print');
    Route::post('{id}/legalitas-atasan', 'Eusulan\Usulan\PostController@legalitasAtasan');
    Route::post('{id}/toggle-edit', 'Eusulan\Usulan\PostController@toggleEdit');
    Route::post('{id}/import', 'Eusulan\Usulan\PostController@import');
    Route::get('{id}/copy', 'Eusulan\Usulan\ViewController@baru');

});

Route::group(['prefix' => 'api/e-usulan'], function () {
    Route::get('/', 'Eusulan\Usulan\ReadController@dataTable');
    Route::group(['prefix' => 'pengaturan'], function () {
        Route::group(['prefix' => 'akun-rekening'], function () {
            Route::get('/', 'Eusulan\Pengaturan\AkunRekening\ReadController@dataTable');
            Route::get('/search', 'Eusulan\Pengaturan\AkunRekening\ReadController@search');
        });
        Route::group(['prefix' => 'barang'], function () {
            Route::get('/', 'Eusulan\Pengaturan\Barang\ReadController@dataTable');
            Route::get('/get/{id}', 'Eusulan\Pengaturan\Barang\ReadController@single');
            Route::get('/search', 'Eusulan\Pengaturan\Barang\ReadController@search');
            Route::get('/get-from-akun-rekening', 'Eusulan\Pengaturan\Barang\ReadController@getFromAkunRekening');
        });
        Route::group(['prefix' => 'unit'], function () {
            Route::get('/', 'Eusulan\Pengaturan\Unit\ReadController@dataTable');
        });
        Route::group(['prefix' => 'ubah-usulan'], function () {
            Route::get('/', 'Eusulan\Pengaturan\UbahUsulan\ReadController@dataTable');
        });
    });
});