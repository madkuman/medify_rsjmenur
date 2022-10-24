<?php
Route::group(['prefix' => 'mobile-pasien'], function() {
	Route::group(['prefix'=>'auth'], function(){
		Route::post('checkPhone', 'MobileAPI\Pasien\Auth\Login\PostController@checkPhoneNumber');
		Route::post('login', 'MobileAPI\Pasien\Auth\Login\PostController@login');
		Route::post('no-login', 'MobileAPI\Pasien\Auth\Login\PostController@nologin');

		Route::post('register', 'MobileAPI\Pasien\Auth\Register\PostController@register');
	});


	Route::group(['middleware'=>'pasien-mobile-auth'], function(){

		Route::post('uploadFotoAvatar', 'MobileAPI\Pasien\Auth\Register\PostController@uploadFotoAvatar');
		Route::post('uploadFotoKtp', 'MobileAPI\Pasien\Auth\Register\PostController@uploadFotoKtp');
		Route::post('sendOTP', 'Pasien\Auth\OTPController@generateOTP');

		Route::post('layanan/all', 'MobileAPI\Pasien\ReadController@getAllLayanan');
		Route::post('histori', 'MobileAPI\Pasien\ReadController@getHistoriTransaksi');
		Route::post('etiket', 'MobileAPI\Pasien\ReadController@etiket');


		Route::post('layanan/detail', 'MobileAPI\Pasien\ReadController@getSingleLayanan');
		Route::post('layanan/poli/today', 'MobileAPI\Pasien\ReadController@getSinglePoliToday');

		Route::post('layanan/pesan', 'MobileAPI\Pasien\Booking\PostController@pesan');


		Route::post('user/get', 'MobileAPI\Pasien\ReadController@dataUser');
		Route::post('user/save', 'MobileAPI\Pasien\PostController@save');

	});
});

?>