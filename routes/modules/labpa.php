<?php
Route::group(['middleware' => ['check-module']], function(){
	Route::group(['prefix' => 'labpa'], function(){
		Route::get('/', 'LabPA\Transaction\ViewController@index');
		Route::group(['prefix' => 'pengaturan'], function(){
			Route::get('/', 'LabPA\Pengaturan\ViewController@index');
			Route::post('/layanan', 'LabPA\Pengaturan\EditController@update');
			Route::get('/layanan/{id}', 'LabPA\Pengaturan\ViewController@view');
			Route::get('/layanan/edit/{id}', 'LabPA\Pengaturan\ViewController@edit');
		});

		Route::group(['prefix' => 'transaksi'], function(){
			Route::get('/new', 'LabPA\Transaction\ViewController@new');
			Route::post('/new', 'LabPA\Transaction\CreateController@create');
			Route::post('/filter', 'LabPA\Transaction\ReadController@datatablesUnread');
			Route::get('/periksa/{slug}', 'LabPA\Transaction\ViewController@periksa');
			Route::post('/permintaan/edit/{slug}', 'LabPA\Transaction\EditController@editInspectionDate');
			Route::get('/permintaan/{slug}', 'LabPA\Transaction\ViewController@permintaan');
			Route::get('/edit/{slug}', 'LabPA\Transaction\ViewController@editResult');
			Route::post('/edit/{slug}', 'LabPA\Transaction\EditController@updateResult');
			Route::post('/periksa', 'LabPA\Transaction\CreateController@createResult');
			Route::post('/periksa/{slug}/batal', 'LabPA\Transaction\CreateController@inspectCancel');
			Route::post('/cancel/{slug}', 'LabPA\Transaction\DeleteController@cancelTransaction');
            Route::post('/hasil/{slug}/verifikasi', 'LabPA\Transaction\EditController@verifikasi');
			Route::post('/hasil/{slug}/update/hasilbaca', 'LabPA\Transaction\EditController@updateHasilBaca');
			Route::post('/sep/edit/{slug}', 'LabPA\Transaction\EditController@editSEPNumber');
			Route::get('/verifikasi', 'LabPA\Transaction\ViewController@verifikasi');
			Route::post('/update/penunjang', 'LabPA\Transaction\EditController@updatePenunjang');
			Route::post('/delete/penunjang', 'LabPA\Transaction\DeleteController@deletePenunjang');
			Route::get('/kirim-tagihan/{slug}', 'LabPA\Transaction\PostController@kirimTagihan');
			Route::get('/cetak/permintaan/{kelas_id}/{slug}', 'LabPA\Transaction\ViewController@cetakPermintaan');
			Route::get('/cetak/bukti-layanan/{slug}', 'LabPA\Transaction\ViewController@cetakBuktiLayanan');
			Route::get('/cetak/kwitansi/{slug}', 'LabPA\Transaction\ViewController@cetakKwitansi');
		});
		Route::group(['prefix' => 'laporan'], function(){
			Route::get('/', 'LabPA\Laporan\ViewController@index');
			Route::get('/data-diagnosa-pasien-bulanan', 'LabPA\Laporan\PostController@dataDiagnosaPasienBulanan');
			Route::get('/rekap-jumlah-pasien-bulanan', 'LabPA\Laporan\PostController@rekapJumlahPasienBulanan');

		});
		Route::get('/histori', 'LabPA\Transaction\ViewController@histori');
		Route::get('/histori/download', 'LabPA\Transaction\ReadController@historiDownload');
		Route::get('/histori/ajax', 'LabPA\Transaction\ReadController@getHistori');
		Route::get('/dummins/{typeInsurance}', 'LabPA\Transaction\ReadController@getByInsurance');
		Route::post('/upload/gambar', 'LabPA\Transaction\CreateController@uploadPicture');
		Route::post('/delete/gambar', 'LabPA\Transaction\CreateController@deletePicture');
		Route::group(['prefix' => 'api'], function(){
			Route::get('services', 'LabPA\Pengaturan\ReadController@getAll');
			Route::post('transaksi', 'LabPA\Transaction\CreateController@apiCreate');
		});
	});
});

Route::get('labpa/transaksi/hasil/{slug}', 'LabPA\Transaction\ViewController@hasil');
Route::get('labpa/transaksi/hasil/{slug}/cetak/{detail_slug}', 'LabPA\Laporan\ViewController@cetakDetail');
?>