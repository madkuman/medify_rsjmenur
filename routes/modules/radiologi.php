<?php
Route::group(['middleware' => ['check-module']], function(){
	Route::group(['prefix' => 'radiologi'], function(){
		Route::get('/', 'Radiology\Transaction\ViewController@index');
		Route::group(['prefix' => 'pengaturan'], function(){
			Route::get('/', 'Radiology\Pengaturan\ViewController@index');
			Route::get('/hasil-baca', 'Radiology\Pengaturan\ViewController@indexHasil');
			Route::get('/hasil-baca/new', 'Radiology\Pengaturan\ViewController@newHasil');
			Route::post('/hasil-baca/new', 'Radiology\Pengaturan\PostController@new');
			Route::post('/hasil-baca/delete', 'Radiology\Pengaturan\PostController@delete');
			Route::get('/hasil-baca/{generic_id}', 'Radiology\Pengaturan\ViewController@editHasil');
			Route::post('/hasil-baca/{generic_id}', 'Radiology\Pengaturan\PostController@update');
			Route::post('/layanan', 'Radiology\Pengaturan\EditController@update');
			Route::get('/layanan/{id}', 'Radiology\Pengaturan\ViewController@view');
			Route::get('/layanan/edit/{id}', 'Radiology\Pengaturan\ViewController@edit');
		});

		Route::group(['prefix' => 'transaksi'], function(){
			Route::get('/new', 'Radiology\Transaction\ViewController@new');
			Route::post('/new', 'Radiology\Transaction\CreateController@create');
			Route::post('/filter', 'Radiology\Transaction\ReadController@datatablesUnread');
			Route::get('/periksa/{slug}', 'Radiology\Transaction\ViewController@periksa');
			Route::post('/permintaan/edit/{slug}', 'Radiology\Transaction\EditController@editInspectionDate');
			Route::get('/permintaan/{slug}', 'Radiology\Transaction\ViewController@permintaan');
			Route::get('/edit/{slug}', 'Radiology\Transaction\ViewController@editResult');
			Route::post('/edit/{slug}', 'Radiology\Transaction\EditController@updateResult');
			Route::post('/periksa', 'Radiology\Transaction\CreateController@createResult');
			Route::post('/periksa/{slug}/batal', 'Radiology\Transaction\CreateController@inspectCancel');
			Route::post('/hasil/{slug}/verifikasi', 'Radiology\Transaction\EditController@verifikasi');
			Route::post('/hasil/{slug}/update/hasilbaca', 'Radiology\Transaction\EditController@updateHasilBaca');
			Route::post('/cancel/{slug}', 'Radiology\Transaction\DeleteController@cancelTransaction');
			Route::post('/sep/edit/{slug}', 'Radiology\Transaction\EditController@editSEPNumber');
			Route::get('/verifikasi', 'Radiology\Transaction\ViewController@verifikasi');
			Route::post('/update/penunjang', 'Radiology\Transaction\EditController@updatePenunjang');
			Route::post('/delete/penunjang', 'Radiology\Transaction\DeleteController@deletePenunjang');
			Route::get('/kirim-tagihan/{slug}', 'Radiology\Transaction\PostController@kirimTagihan');
			Route::get('/cetak/permintaan/{slug}', 'Radiology\Transaction\ViewController@cetakPermintaan');
			Route::get('/cetak/bukti-layanan/{slug}', 'Radiology\Transaction\ViewController@cetakBuktiLayanan');
			Route::get('/cetak/kwitansi/{slug}', 'Radiology\Transaction\ViewController@cetakKwitansi');
		});

		Route::group(['prefix' => 'laporan'], function(){
			Route::get('/', 'Radiology\Laporan\ViewController@index');
			Route::get('/rekap-pemeriksaan-pasien-bulanan', 'Radiology\Laporan\PostController@rekapPemeriksaanPasienBulanan');
			Route::get('/rekap-pemeriksaan-pasien-harian', 'Radiology\Laporan\PostController@rekapPemeriksaanPasienHarian');
			Route::get('/histori-pemeriksaan-pasien-harian', 'Radiology\Laporan\PostController@historiPemeriksaanPasienHarian');

		});
		Route::get('/histori', 'Radiology\Transaction\ViewController@histori');
		Route::get('/histori/download', 'Radiology\Transaction\ReadController@historiDownload');
		Route::get('/histori/ajax', 'Radiology\Transaction\ReadController@getHistori');
		Route::get('/dummins/{typeInsurance}', 'Radiology\Transaction\ReadController@getByInsurance');
		Route::post('/upload/gambar', 'Radiology\Transaction\CreateController@uploadPicture');
		Route::post('/delete/gambar', 'Radiology\Transaction\CreateController@deletePicture');
		Route::group(['prefix' => 'api'], function(){
			Route::get('services', 'Radiology\Pengaturan\ReadController@getAll');
		});
	});
});

Route::get('/radiologi/transaksi/hasil/{slug}', 'Radiology\Transaction\ViewController@hasil');
Route::get('radiologi/transaksi/hasil/{slug}/cetak/{detail_slug}', 'Radiology\Laporan\ViewController@cetakDetail');
?>