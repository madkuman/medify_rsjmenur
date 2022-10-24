<?php

Route::group(['prefix' => 'testing'], function() {
	Route::get('/seed/keuangan/pemasukan', 'Keuangan\Testing\Seeder\PemasukanSeederController@seed');
	Route::get('/seed/keuangan/tarif','Keuangan\Testing\Seeder\PemasukanSeederController@tarif123view');
});


?>