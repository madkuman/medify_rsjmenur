<?php

	Route::group(['prefix' => '/profil'], function(){
		Route::get('/{id}', ['uses' => 'Users\ViewController@profile', 'as' => 'profil']);
		Route::get('/import/pendidikan', 'Users\ViewController@getPendidikan');
		Route::get('/import/pelatihan', 'Users\ViewController@getPelatihan');
		Route::post('/create/pendidikan', ['uses' => 'Users\PostController@pendidikan', 'as' => 'create.pendidikan']);
		Route::post('/create/pelatihan', ['uses' => 'Users\PostController@pelatihan', 'as' => 'create.pelatihan']);
		Route::post('/create/karya', ['uses' => 'Users\PostController@karya', 'as' => 'create.karya']);
		Route::post('/create/jadwal', ['uses' => 'Users\PostController@jadwal', 'as' => 'create.jadwal']);
		Route::post('/create/skill', ['uses' => 'Users\PostController@skill', 'as' => 'create.skill']);
		Route::post('/edit/aboutme', ['uses' => 'Users\EditController@aboutme', 'as' => 'edit.aboutme']);
		Route::post('/edit/pendidikan', ['uses' => 'Users\EditController@pendidikan', 'as' => 'edit.pendidikan']);
		Route::post('/edit/pelatihan', ['uses' => 'Users\EditController@pelatihan', 'as' => 'edit.pelatihan']);
		Route::post('/edit/karya', ['uses' => 'Users\EditController@karya', 'as' => 'edit.karya']);
		Route::post('/edit/jadwal', ['uses' => 'Users\EditController@jadwal', 'as' => 'edit.jadwal']);
		Route::post('/edit/skill', ['uses' => 'Users\EditController@skill', 'as' => 'edit.skill']);
		Route::post('/delete/pendidikan', ['uses' => 'Users\DeleteController@pendidikan', 'as' => 'delete.pendidikan']);
		Route::post('/delete/pelatihan', ['uses' => 'Users\DeleteController@pelatihan', 'as' => 'delete.pelatihan']);
		Route::post('/delete/karya', ['uses' => 'Users\DeleteController@karya', 'as' => 'delete.karya']);
		Route::post('/delete/jadwal', ['uses' => 'Users\DeleteController@jadwal', 'as' => 'delete.jadwal']);
		Route::post('/delete/skill', ['uses' => 'Users\DeleteController@skill', 'as' => 'delete.skill']);
	}); 
?>