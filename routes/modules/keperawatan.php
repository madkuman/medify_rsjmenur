<?php
Route::group(['prefix' => 'keperawatan'], function () {
	Route::get('/', 'Keperawatan\RencanaAsuhan\ViewController@index');
	Route::get('rencana-asuhan/baru', 'Keperawatan\RencanaAsuhan\ViewController@create');
	Route::post('rencana-asuhan/baru', 'Keperawatan\RencanaAsuhan\PostController@create');


	Route::get('rencana-asuhan/{id}', 'Keperawatan\RencanaAsuhan\ViewController@single');
	Route::get('rencana-asuhan/delete/{id}', 'Keperawatan\RencanaAsuhan\DeleteController@destroy');
	Route::get('rencana-asuhan/edit/{id}', 'Keperawatan\RencanaAsuhan\ViewController@edit');
	Route::post('rencana-asuhan/edit/{id}', 'Keperawatan\RencanaAsuhan\EditController@update');
});


Route::group(['prefix' => 'api/keperawatan'], function () {
	Route::get('rencana-asuhan/{id}', 'Keperawatan\RencanaAsuhan\ViewController@APIsingle');
	Route::get('rencana-asuhan/get-list/{id}', 'Keperawatan\RencanaAsuhan\ReadController@getListRencanaAsuhan');
});

?>