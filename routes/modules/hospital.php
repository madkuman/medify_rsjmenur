<?php 


Route::group(['prefix' => 'api'], function() {
	Route::get('undangan-kasus-saya/{id}', 'HomeController@getSingleUndanganKasus');
	Route::get('undangan-grup-saya/{id}', 'HomeController@getSingleUndanganGrup');
	Route::get('users/search', 'Users\ReadController@search');
	Route::get('pegawai/search', 'Kepegawaian\Pegawai\ReadController@search');
	Route::get('groups/search', 'Group\Group\ReadController@search');
	Route::get('laporan/list', 'Hospital\Laporan\ReadController@APIlaporan');
});

?>