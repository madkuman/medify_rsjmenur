<?php 

//Route::group(['middleware' => ['check-module']], function(){ 
	Route::group(['prefix' => 'online'], function () {
	    Route::get('/', 'Online\Transaksi\ViewController@index');
	    Route::get('/transaksi', 'Online\Transaksi\ViewController@index');
	    Route::post('/transaksi/konfirmasi', 'Online\Transaksi\PostController@konfirmasi');
	    Route::get('/transaksi/histori', 'Online\Transaksi\ViewController@histori');
	});
//});

?>