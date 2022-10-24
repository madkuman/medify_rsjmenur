<?php
Route::group(['prefix' => 'labpk'], function(){
	Route::group(['middleware' => ['check-module']], function(){
		Route::get('/', 'LabPK\Transaksi\ViewController@index');
		Route::group(['prefix' => 'pengaturan'], function(){
			Route::get('/', 'LabPK\Pengaturan\ViewController@index');
			Route::get('/layanan', 'LabPK\Pengaturan\ViewController@indexLayanan');
			Route::post('/layanan', 'LabPK\Pengaturan\EditController@update');
			Route::get('/layanan/{id}', 'LabPK\Pengaturan\ViewController@view');



			Route::get('mikrobiologi-spesimen', 'LabPK\MikrobiologiSpesimen\ViewController@index');
			Route::get('mikrobiologi-spesimen/create', 'LabPK\MikrobiologiSpesimen\ViewController@create');
			Route::post('mikrobiologi-spesimen/create', 'LabPK\MikrobiologiSpesimen\PostController@create');
			Route::get('mikrobiologi-spesimen/edit/{id}', 'LabPK\MikrobiologiSpesimen\ViewController@edit');
			Route::post('mikrobiologi-spesimen/edit/{id}', 'LabPK\MikrobiologiSpesimen\PostController@edit');
			Route::post('mikrobiologi-spesimen/delete/{id}', 'LabPK\MikrobiologiSpesimen\PostController@delete');


			
			Route::get('mikrobiologi-spesimen-kategori', 'LabPK\MikrobiologiSpesimenKategori\ViewController@index');
			Route::get('mikrobiologi-spesimen-kategori/create', 'LabPK\MikrobiologiSpesimenKategori\ViewController@create');
			Route::post('mikrobiologi-spesimen-kategori/create', 'LabPK\MikrobiologiSpesimenKategori\PostController@create');
			Route::get('mikrobiologi-spesimen-kategori/edit/{id}', 'LabPK\MikrobiologiSpesimenKategori\ViewController@edit');
			Route::post('mikrobiologi-spesimen-kategori/edit/{id}', 'LabPK\MikrobiologiSpesimenKategori\PostController@edit');
			Route::post('mikrobiologi-spesimen-kategori/delete/{id}', 'LabPK\MikrobiologiSpesimenKategori\PostController@delete');
		});

		Route::group(['prefix' => 'transaksi'], function(){
			Route::get('/new', 'LabPK\Transaksi\ViewController@new');
			Route::post('/new', 'LabPK\Transaksi\CreateController@create');
			Route::post('/filter', 'LabPK\Transaksi\ReadController@datatablesUnread');
			Route::get('/periksa/{slug}', 'LabPK\Transaksi\ViewController@periksa');
			Route::post('/periksa/{slug}/{detail_id}', 'LabPK\Transaksi\PostController@periksa');
			Route::post('/edit/{slug}/{detail_id}', 'LabPK\Transaksi\EditController@editPemeriksaan');
			Route::post('/permintaan/edit/{slug}', 'LabPK\Transaksi\EditController@editInspectionDate');
			Route::get('/permintaan/{slug}', 'LabPK\Transaksi\ViewController@permintaan');
			Route::get('/edit/{slug}', 'LabPK\Transaksi\ViewController@editResult');
			Route::post('/edit/{slug}', 'LabPK\Transaksi\EditController@updateResult');
            Route::post('/tambah-pemeriksaan/{slug}', 'LabPK\Transaksi\PostController@tambahPemeriksaan');
			// Route::post('/periksa', function(){
			// 	return "hok";
			// });
			Route::post('/periksa', 'LabPK\Transaksi\CreateController@createResult');
			Route::post('/cancel/{slug}', 'LabPK\Transaksi\DeleteController@cancelTransaksi');
            Route::post('/hasil/{slug}/verifikasi', 'LabPK\Transaksi\EditController@verifikasi');
			Route::get('/verifikasi', 'LabPK\Transaksi\ViewController@verifikasi');
			Route::post('/update/penunjang', 'LabPK\Transaksi\EditController@updatePenunjang');
			Route::post('/delete/penunjang', 'LabPK\Transaksi\DeleteController@deletePenunjang');
			Route::post('/edit', 'LabPK\Transaksi\EditController@editTransaksi');
			Route::post('/sep/edit/{slug}', 'LabPK\Transaksi\EditController@editSEPNumber');
			Route::get('/kirim-tagihan/{slug}', 'LabPK\Transaksi\PostController@kirimTagihan');
			Route::get('/cetak/permintaan/{slug}', 'LabPK\Transaksi\ViewController@cetakPermintaan');
			Route::get('/cetak/bukti-layanan/{slug}', 'LabPK\Transaksi\ViewController@cetakBuktiLayanan');
			Route::get('/cetak/kwitansi/{slug}', 'LabPK\Transaksi\ViewController@cetakKwitansi');
			Route::get('/cetak/bukti-penyerahan-darah/{slug}', 'LabPK\Transaksi\ViewController@cetakBuktiPenyerahanDarah');

			Route::post('/mikrobiologi-spesimen-terima/{slug}', 'LabPK\Transaksi\EditController@mikrobiologiTerimaSpesimen');

		});

		Route::group(['prefix' => 'laporan'], function(){
			Route::get('/', 'LabPK\Laporan\ViewController@index');
			Route::get('/rekap-jumlah-pasien-bulanan', 'LabPK\Laporan\PostController@rekapJumlahPasienBulanan');
			Route::get('/kunjungan-berdasarkan-gender-dan-usia', 'LabPK\Laporan\PostController@kunjunganBerdasarkanGenderDanUsia');
			Route::get('/laporan-pemeriksaan-laboratorium', 'LabPK\Laporan\PostController@laporanPemeriksaanLaboratorium');
			Route::get('/laporan-jumlah-penderita', 'LabPK\Laporan\PostController@laporanJumlahPenderita');
			Route::get('/laporan-data-status-ranap', 'LabPK\Laporan\PostController@laporanDataStatusRanap');
			Route::get('/laporan-data-status-rajal', 'LabPK\Laporan\PostController@laporanDataStatusRajal');
			Route::get('/laporan-penerimaan', 'LabPK\Laporan\PostController@laporanPenerimaan');
			Route::get('/laporan-kunjungan-tahunan-per-lokasi', 'LabPK\Laporan\PostController@laporanKunjunganTahunanPerLokasi');
			Route::get('/laporan-kunjungan-tahunan-per-tarif', 'LabPK\Laporan\PostController@laporanKunjunganTahunanPerTarif');
			Route::get('/laporan-kunjungan-tahunan-per-debitur', 'LabPK\Laporan\PostController@laporanKunjunganTahunanPerDebitur');
			Route::get('testing','LabPK\Laporan\ViewController@testing');
			Route::get('/seed-rekap', 'LabPK\Laporan\PostController@seedRekap');
			Route::get('/pengaturan/{slug}', 'LabPK\Laporan\ViewController@pengaturan');
			Route::post('/pengaturan/{slug}', 'LabPK\Laporan\PostController@update');
			Route::get('/{slug}', 'LabPK\Laporan\ViewController@cetak');
		});
		Route::get('/histori', 'LabPK\Transaksi\ViewController@histori');
		Route::get('/histori/download', 'LabPK\Transaksi\ReadController@historiDownload');
		Route::get('/histori/ajax', 'LabPK\Transaksi\ReadController@getHistori');
		Route::post('/upload/gambar', 'LabPK\Transaksi\CreateController@uploadPicture');
		Route::post('/delete/gambar', 'LabPK\Transaksi\CreateController@deletePicture');
		Route::group(['prefix' => 'api'], function(){
			Route::post('/transaksi/periksa/{slug}/{detail_slug}', 'LabPK\Transaksi\PostController@insertHasil');
		});
	});
	Route::get('/transaksi/hasil/{slug}', 'LabPK\Transaksi\ViewController@hasil');
	Route::get('/transaksi/hasil/{slug}/cetak/LIS/{hasil_id}', 'LabPK\Laporan\ViewController@cetakLIS');
	Route::get('/transaksi/hasil/{slug}/cetak/{detail_slug}', 'LabPK\Laporan\ViewController@cetakDetail');

	Route::get('/monitoring', 'LabPK\Monitoring\ViewController@index');


	Route::group(['prefix' => 'pengaturan'], function(){
		Route::get('/form', 'LabPK\Form\ViewController@index');
		Route::get('/form/create', 'LabPK\Form\ViewController@create');
		Route::post('/form/create', 'LabPK\Form\PostController@create');
		Route::get('/form/edit/{id}', 'LabPK\Form\ViewController@edit');
		Route::post('/form/edit/{id}', 'LabPK\Form\PostController@edit');
		Route::post('/form/delete/{id}', 'LabPK\Form\PostController@delete');

		Route::get('/form-tarif/{tarif_master_id}', 'LabPK\FormTarif\ViewController@edit');
		Route::post('/form-tarif/{tarif_master_id}', 'LabPK\FormTarif\PostController@edit');
		Route::post('/form-tarif/delete/{tarif_master_id}', 'LabPK\FormTarif\PostController@delete');
	});
});


Route::group(['prefix' => 'api/labpk'], function(){
	Route::get('/monitoring/get-data', 'LabPK\Monitoring\ReadController@getData');
	Route::get('/mikrobiologi-spesimen/get-all', 'LabPK\MikrobiologiSpesimen\ReadController@APIgetAll');
});

?>