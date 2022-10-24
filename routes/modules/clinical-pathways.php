<?php 

Route::group(['prefix' => 'clinical-pathways'], function () {
	Route::group(['middleware' => ['check-module']], function(){ 
		Route::get('/', 'ClinicalPathway\ArticleController@index');
		Route::get('/new', 'ClinicalPathway\ArticleController@create');
		Route::get('/{article}/edit', 'ClinicalPathway\ArticleController@edit');
		Route::post('/', 'ClinicalPathway\ArticleController@store');
		Route::post('/{article}/update', 'ClinicalPathway\ArticleController@update');
		Route::post('/{article}/delete', 'ClinicalPathway\ArticleController@destroy');
		Route::post('/upload', 'ClinicalPathway\FileController@upload');
	});
	Route::get('/{article}', 'ClinicalPathway\ArticleController@show');
});

?>