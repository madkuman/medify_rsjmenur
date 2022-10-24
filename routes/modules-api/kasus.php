<?php

Route::group(['prefix' => 'api/kasus/{nomor_kasus}'], function() {
	Route::get('/datamedis/cppt/{id}', 'Kasus\CPPT\ReadController@get');
	Route::get('/datamedis/tindakan/{id}', 'Kasus\Tindakan\ReadController@get');
	Route::get('/datamedis/resep/{id}', 'Kasus\Resep\ReadController@get');
	Route::get('/tagihan/detail/{id}', 'Kasus\TagihanDetail\ReadController@get');
	Route::get('/datamedis/vital/{id}', 'Kasus\VitalSign\ReadController@fetchOne');


	Route::get('/kolaborator/user/search/', 'Kasus\Kolaborator\ReadController@search');
	Route::post('/kolaborator/create/', 'Kasus\Kolaborator\CreateController@create');



	Route::post('/home/todo/done/{id}', 'Kasus\ToDo\EditController@done');
	Route::get('/bpjs/get/{id}', 'Kasus\BPJS\ReadController@get');
});


	Route::get('api/kasus/kolaborator/user/search', 'Kasus\Kolaborator\ReadController@search');
	Route::get('api/kasus/datamedis/tindakan/get-top-tindakan-user', 'Kasus\Tindakan\ReadController@APIGetTopTindakanUser');
	Route::get('api/kasus/datamedis/resep/search', 'Kasus\Resep\ReadController@search');
	Route::post('api/kasus/administrasi/rujuk/igd', 'Kasus\Administrasi\EditController@rujukIGD');
	Route::post('api/kasus/administrasi/rujuk/rawatjalan', 'Kasus\Administrasi\EditController@rujukRawatjalan');
	Route::post('api/kasus/pengaturan/resume/create', 'Kasus\Resume\PostController@create');
	Route::post('api/kasus/pengaturan/resume/edit', 'Kasus\Resume\PostController@edit');

?>