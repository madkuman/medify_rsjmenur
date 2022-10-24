<?php
Route::group(['prefix' => 'covid19'], function(){
	Route::get('/','Covid19\Statistik\ViewController@index');
});
Route::group(['prefix' => 'api/covid19'], function(){
	Route::get('/get-data','Covid19\Statistik\ReadController@getData');
});

?>