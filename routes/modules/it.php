<?php
Route::group(['middleware' => ['check-module']], function(){
	Route::group(['prefix' => 'it'], function() {
		Route::get('/', 'IT\Komplain\ViewController@index');
		Route::get('/komplain', 'IT\Komplain\ViewController@index');
		Route::get('/komplain-buat', 'IT\Komplain\ViewController@create');
		Route::get('/komplain/{id}/respon', 'IT\Komplain\ViewController@respon');
		Route::post('/komplain', 'IT\Komplain\PostController@create');
		Route::post('/komplain/{id}/respon', 'IT\Komplain\PostController@respon');
		Route::post('/komplain/{id}/edit', 'IT\Komplain\PostController@edit');
		Route::post('/komplain/delete', 'IT\Komplain\PostController@delete');
	});

	Route::group(['prefix' => 'api/it'], function(){
		Route::get('/komplain', 'IT\Komplain\ViewController@getJSON');
		Route::get('/komplain/getDataTable', 'IT\Komplain\ViewController@getDataTable');
		Route::get('/getLokasi', 'IT\Komplain\ViewController@getLokasi');
		Route::get('/getTeknisi', 'IT\Komplain\ViewController@getTeknisi');
	});
});