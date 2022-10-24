<?php
Route::group(['middleware' => ['check-module']], function(){
	Route::group(['prefix' => 'survey-kepuasan'], function() {
		Route::get('/', 'SurveyKepuasan\ViewController@index');
	});
});