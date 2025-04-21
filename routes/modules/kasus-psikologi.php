<?php
	
	Route::get("/psikologi/identifikasi-potensi-psikologi", "Kasus\Psikologi\IdentifikasiPotensiPsikologi\ViewController@index");
	Route::post("/psikologi/identifikasi-potensi-psikologi/save", "Kasus\Psikologi\IdentifikasiPotensiPsikologi\PostController@save");
	Route::post("/psikologi/identifikasi-potensi-psikologi/delete", "Kasus\Psikologi\IdentifikasiPotensiPsikologi\PostController@delete");
	Route::get("/psikologi/identifikasi-potensi-psikologi/print/{id}", "Kasus\Psikologi\IdentifikasiPotensiPsikologi\ViewController@print");

	Route::get("/psikologi/bakat-minat-anak", "Kasus\Psikologi\BakatMinatAnak\ViewController@index");
	Route::post("/psikologi/bakat-minat-anak/save", "Kasus\Psikologi\BakatMinatAnak\PostController@save");
	Route::post("/psikologi/bakat-minat-anak/delete", "Kasus\Psikologi\BakatMinatAnak\PostController@delete");
	Route::get("/psikologi/bakat-minat-anak/print/{id}", "Kasus\Psikologi\BakatMinatAnak\ViewController@print");

	Route::get("/psikologi/bakat-minat-dewasa", "Kasus\Psikologi\BakatMinatDewasa\ViewController@index");
	Route::post("/psikologi/bakat-minat-dewasa/save", "Kasus\Psikologi\BakatMinatDewasa\PostController@save");
	Route::post("/psikologi/bakat-minat-dewasa/delete", "Kasus\Psikologi\BakatMinatDewasa\PostController@delete");
	Route::get("/psikologi/bakat-minat-dewasa/print/{id}", "Kasus\Psikologi\BakatMinatDewasa\ViewController@print");

	Route::get("/psikologi/laporan-hasil-pemeriksaan-psikologi-rekruitmen", "Kasus\Psikologi\LaporanHasilPemeriksaanPsikologiRekruitmen\ViewController@index");
	Route::post("/psikologi/laporan-hasil-pemeriksaan-psikologi-rekruitmen/save", "Kasus\Psikologi\LaporanHasilPemeriksaanPsikologiRekruitmen\PostController@save");
	Route::post("/psikologi/laporan-hasil-pemeriksaan-psikologi-rekruitmen/delete", "Kasus\Psikologi\LaporanHasilPemeriksaanPsikologiRekruitmen\PostController@delete");
	Route::get("/psikologi/laporan-hasil-pemeriksaan-psikologi-rekruitmen/print/{id}", "Kasus\Psikologi\LaporanHasilPemeriksaanPsikologiRekruitmen\ViewController@print");

	Route::get("/psikologi/self-reporting-questionnaire", "Kasus\Psikologi\SelfReportingQuestionnaire\ViewController@index");
	Route::get("/psikologi/self-reporting-questionnaire/view/{id}", "Kasus\Psikologi\SelfReportingQuestionnaire\ViewController@single");
	Route::get("/psikologi/self-reporting-questionnaire/create", "Kasus\Psikologi\SelfReportingQuestionnaire\ViewController@create");
	Route::get("/psikologi/self-reporting-questionnaire/edit/{id}", "Kasus\Psikologi\SelfReportingQuestionnaire\ViewController@edit");
	Route::post("/psikologi/self-reporting-questionnaire/submit-form", "Kasus\Psikologi\SelfReportingQuestionnaire\PostController@submitForm");
	Route::post("/psikologi/self-reporting-questionnaire/delete", "Kasus\Psikologi\SelfReportingQuestionnaire\PostController@delete");
	Route::get("/psikologi/self-reporting-questionnaire/print/{id}", "Kasus\Psikologi\SelfReportingQuestionnaire\ViewController@print");
	Route::get("/psikologi/self-reporting-questionnaire/search-user", "Kasus\Psikologi\SelfReportingQuestionnaire\PostController@searchUser");
	Route::post("/psikologi/self-reporting-questionnaire/add-ttd", "Kasus\Psikologi\SelfReportingQuestionnaire\PostController@addTTD");

    Route::post("/psikologi/galeri/upload", "Kasus\Psikologi\Galeri\PostController@create");
    Route::post("/psikologi/galeri/delete", "Kasus\Psikologi\Galeri\PostController@delete");

	Route::post("/psikologi/pemeriksaan-psikologis-anak/save", "Kasus\Psikologi\PemeriksaanPsikologisAnak\PostController@save");
	Route::post("/psikologi/pemeriksaan-psikologis-anak/delete", "Kasus\Psikologi\PemeriksaanPsikologisAnak\PostController@delete");
	Route::get("/psikologi/pemeriksaan-psikologis-anak/print/{id}", "Kasus\Psikologi\PemeriksaanPsikologisAnak\ViewController@print");
?>
