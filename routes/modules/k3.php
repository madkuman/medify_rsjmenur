<?php
Route::group(['middleware' => ['check-module']], function(){
	Route::group(['prefix' => 'k3'], function(){
		Route::get('/', 'K3\Logbook\ViewController@index');
		Route::get('/logbook', 'K3\Logbook\ViewController@index');
		Route::post('/logbook/delete','K3\Logbook\DeleteController@delete');
		Route::get('/laporkan-k3', 'K3\Logbook\ViewController@addPage');
	    Route::post('/laporkan-k3','K3\Logbook\CreateController@create');
    });
});

Route::group(['prefix' => 'api/k3'], function(){
	Route::get('/logbook/get','K3\Logbook\ReadController@getLogbookList');
	Route::get('/pegawai/get','K3\Logbook\ReadController@getPegawaiList');
});
?>
