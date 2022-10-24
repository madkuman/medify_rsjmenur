<?php
Route::group(['middleware' => ['check-module']], function(){
	Route::group(['prefix' => 'humas'], function(){
		Route::get('', 'Humas\Komplain\ViewController@index');
	    Route::post('/komplain/new','Humas\Komplain\CreateController@create');
		Route::post('/komplain/edit','Humas\Komplain\EditController@update');
		Route::post('/komplain/delete','Humas\Komplain\DeleteController@deleteKomplain');		
    });
});

Route::group(['prefix' => 'api/humas'], function(){
	Route::get('/komplain/get/{id}','Humas\Komplain\ReadController@getKomplainModal');
	Route::get('/komplain/search/{id}','Humas\Komplain\ReadController@getKomplain');
});
?>
