<?php
Route::group(['prefix' => 'third-party-medify-online'], function(){
	Route::group(['prefix' => 'pasien'], function(){
		Route::get('get','ThirdParty\MedifyOnline\PasienController@getPasien');
		Route::get('get-metode-bayar','ThirdParty\MedifyOnline\PasienController@getPasienPembayaran');
		Route::get('check-approval-asuransi','ThirdParty\MedifyOnline\PasienController@checkApprovalAsuransi');
    	Route::get('get-rujukan','ThirdParty\MedifyOnline\PasienController@getRujukan');
    	Route::post('baru','ThirdParty\MedifyOnline\PasienController@createPasien');

	});

	// Route::get('api/get','MobileAPI\Pasien\ReadController@APIGetPasien');
 //    Route::get('api/get-pembayaran','MobileAPI\Pasien\ReadController@APIGetPasienPembayaran');


	Route::group(['prefix' => 'poliklinik'], function(){
		Route::get('get-all','ThirdParty\MedifyOnline\PoliklinikController@getPoliklinikAll');
		Route::get('get-single','ThirdParty\MedifyOnline\PoliklinikController@getPoliklinikSingle');
		Route::get('get-by-id','ThirdParty\MedifyOnline\PoliklinikController@getPoliklinikById');
	});

    Route::group(['prefix' => 'medical-checkup'], function(){
        Route::get('get-all','ThirdParty\MedifyOnline\MedicalCheckUpController@getPaketAll');
        Route::get('get-single','ThirdParty\MedifyOnline\MedicalCheckUpController@getPaketSingle');
        Route::post('pendaftaran-baru','ThirdParty\MedifyOnline\MedicalCheckUpController@pendaftaranBaru');
        Route::get('get-by-id','ThirdParty\MedifyOnline\MedicalCheckUpController@getPaketById');
    });

	Route::group(['prefix' => 'dokter'], function(){
		Route::get('get-jadwal-klinik','ThirdParty\MedifyOnline\DokterController@getJadwalKlinik');
		Route::get('get-single','ThirdParty\MedifyOnline\DokterController@getSingle');
	});
	Route::group(['prefix' => 'payment'], function(){
		Route::get('get-daftar-biaya','ThirdParty\MedifyOnline\PaymentController@getDaftarBiaya');
        Route::get('get-daftar-biaya-telekonsultasi','ThirdParty\MedifyOnline\PaymentController@getDaftarBiayaTelekonsultasi');
	});
	Route::group(['prefix' => 'rawatjalan'], function(){
    	Route::get('transaksi-today','ThirdParty\MedifyOnline\RawatJalanController@getTransaksiToday');
		Route::post('pendaftaran-baru','ThirdParty\MedifyOnline\RawatJalanController@pendaftaranBaru');
    	Route::post('cancel-appointment', 'ThirdParty\MedifyOnline\RawatJalanController@cancelAppointment');
	});


	Route::group(['prefix' => 'data'], function(){
	    Route::get('alamat-kota', 'Pasien\AlamatKota\ReadController@get');
		Route::get('alamat-kecamatan-get/{id}', 'Pasien\AlamatKecamatan\ReadController@get');
	    Route::get('alamat/kelurahan-get/{id}', 'Pasien\AlamatKelurahan\ReadController@get');
	    Route::get('pangkat-get/{id}', 'Pasien\Keanggotaan\ReadController@getPangkat');
		Route::get('satker-get/{id}', 'Pasien\Keanggotaan\ReadController@getSatker');
	});

	Route::get('rawatinap/get-ketersediaan-bed', 'ThirdParty\MedifyOnline\RawatInapController@getKetersediaanBed');
});
?>