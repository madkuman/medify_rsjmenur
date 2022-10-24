<?php

Route::group(['prefix' => 'laundry'], function() {
	Route::group(['middleware' => ['check-module']], function(){
	    Route::group(['prefix' => '/transaksi'], function() {
	        Route::get('/','Laundry\Permintaan\ViewController@index');
	    });

	    Route::group(['prefix' => '/permintaan'], function() {
	        Route::get('/detil-permintaan/{id}','Laundry\Permintaan\ViewController@detail');
	        Route::get('/add-permintaan','Laundry\Permintaan\ViewController@addPermintaan');
	    });

	    Route::get('/dashboard','Laundry\Dashboard\ViewController@index');
    });

    Route::group(['prefix' => '/permintaan'], function() {
        Route::get('/add-permintaan/{group_id}','Laundry\Permintaan\ViewController@addPermintaan');
    });

    Route::group(['prefix' => '/barang'], function() {
        Route::get('/','Laundry\Barang\ViewController@indexBarang');
        Route::get('/add-barang','Laundry\Barang\ViewController@addBarang');
    });

    Route::get('/dashboard','Laundry\Dashboard\ViewController@index');
    Route::get('/','Laundry\Dashboard\ViewController@index');
});

Route::group(['prefix' => 'api/laundry'], function() {
    Route::get('/permintaan/get/{id}','Laundry\Permintaan\ReadController@GetPermintaanDetail');
    Route::get('/transaksi/get','Laundry\Permintaan\ReadController@GetPermintaan');
    Route::get('/dashboard/get','Laundry\Dashboard\ReadController@GetPermintaan');
    Route::get('/barang/get','Laundry\Barang\ReadController@GetBarang');
    Route::post('/barang/add','Laundry\Barang\PostController@PostBarang');
    Route::post('/barang/delete','Laundry\Barang\PostController@DeleteBarang');
    Route::post('/barang/edit','Laundry\Barang\PostController@EditBarang');
    Route::get('/transaksi/filter','Laundry\Permintaan\ReadController@FilterPermintaan');
    Route::post('/permintaan/new','Laundry\Permintaan\PostController@PostDetailTransaksi');
    Route::post('/permintaan/delete','Laundry\Permintaan\PostController@DeleteTransaksi');
    Route::post('/permintaan/edit','Laundry\Permintaan\PostController@EditTransaksi');
    Route::post('/permintaan/editProsesCuci','Laundry\Permintaan\PostController@EditProsesCuciTransaksi');
    Route::post('/permintaan/add','Laundry\Permintaan\PostController@PostPermintaan');
    Route::post('/permintaan/reject','Laundry\Permintaan\PostController@Reject');
    Route::post('/permintaan/update/{id}','Laundry\Permintaan\EditController@UpdatePermintaan');
});

?>
