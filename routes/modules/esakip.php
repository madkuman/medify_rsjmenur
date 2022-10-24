<?php

Route::group(['prefix' => 'e-sakip'], function(){
    Route::get('/', 'Esakip\Dashboard\ViewController@index');
    Route::post('/save', 'Esakip\Dashboard\PostController@save');
    Route::post('/edit', 'Esakip\Dashboard\PostController@edit');
    Route::post('/delete/{id}', 'Esakip\Dashboard\PostController@delete');
    Route::group(['prefix' => 'verifikasi'], function () {
        Route::get('/', 'Esakip\Verifikasi\ViewController@index');
        Route::post('/edit/{id}', 'Esakip\Verifikasi\PostController@verifikasi');
        Route::post('/batal/{id}', 'Esakip\Verifikasi\PostController@batalVerifikasi');
    });
    Route::group(['prefix' => 'monitoring'], function () {
        Route::get('/', 'Esakip\Monitoring\ViewController@index');
    });


});
Route::group(['prefix' => 'api/e-sakip'], function () {
    Route::get('/', 'Esakip\Dashboard\ReadController@dataTable');
    Route::group(['prefix' => 'verifikasi'], function () {
        Route::get('/', 'Esakip\Verifikasi\ReadController@dataTable');
    });
    Route::group(['prefix' => 'monitoring'], function () {
        Route::get('/', 'Esakip\Monitoring\ReadController@dataTable');
    });
});

