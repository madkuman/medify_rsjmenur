<?php

Route::group(['prefix' => 'harmat'], function(){
	Route::get('/', 'Harmat\ListrikMati\ViewController@index');
	Route::get('/listrik-mati', 'Harmat\ListrikMati\ViewController@index');
	Route::post('/listrik-mati', 'Harmat\ListrikMati\PostController@create');
	Route::post('/listrik-mati/{id}/update', 'Harmat\ListrikMati\PostController@update');
	Route::post('/listrik-mati/{id}/delete', 'Harmat\ListrikMati\PostController@delete');

	Route::get('/perbaikan-alat', 'Harmat\PerbaikanAlat\ViewController@index');
	Route::post('/perbaikan-alat', 'Harmat\PerbaikanAlat\PostController@create');
	Route::post('/perbaikan-alat/{id}/update', 'Harmat\PerbaikanAlat\PostController@update');
	Route::post('/perbaikan-alat/{id}/delete', 'Harmat\PerbaikanAlat\PostController@delete');
	Route::post('/perbaikan-alat/{id}/update-status', 'Harmat\PerbaikanAlat\PostController@updateStatus');
});

Route::group(['prefix' => 'api/harmat'], function(){
	Route::get('/listrik-mati/getEachJSON', 'Harmat\ListrikMati\ViewController@getJSON');
	Route::get('/listrik-mati/getDataTable', 'Harmat\ListrikMati\ViewController@getDataTable');

	Route::get('/perbaikan-alat', 'Harmat\PerbaikanAlat\ViewController@getJSON');
	Route::get('/perbaikan-alat/getLokasi', 'Harmat\PerbaikanAlat\ViewController@getLokasi');
	Route::get('/perbaikan-alat/getDataTable', 'Harmat\PerbaikanAlat\ViewController@getDataTable');
});

?>