<?php
Route::group(['prefix' => 'urikkes'], function(){
	Route::get('/pemeriksaan-harian', 'Urikkes\Transaksi\ViewController@index');

	Route::get('/histori-transaksi', 'Urikkes\Transaksi\ViewController@histori');
	Route::get('/', 'Urikkes\Transaksi\ViewController@histori');

	Route::group(['prefix' => 'pengaturan'], function(){
		Route::get('/', 'Urikkes\Pengaturan\ViewController@index');
		Route::get('dokter', 'Urikkes\Pengaturan\ViewController@dokter');
		Route::post('dokter/save', 'Urikkes\Pengaturan\PostController@dokterSave');
		Route::post('dokter/delete', 'Urikkes\Pengaturan\PostController@dokterDelete');

		Route::get('paket', 'Urikkes\Pengaturan\ViewController@paket');
		Route::get('paket/detail/{paket_id}', 'Urikkes\Pengaturan\ViewController@detail');
		Route::get('paket/edit/{paket_id}', 'Urikkes\Pengaturan\ViewController@edit');
		Route::get('paket/add', 'Urikkes\Pengaturan\ViewController@tambah');
		Route::post('paket/save', 'Urikkes\Pengaturan\PostController@simpan');
		Route::post('paket/delete', 'Urikkes\Pengaturan\PostController@hapus');
	});
	Route::group(['prefix' => 'layanan'], function(){
		Route::get('/', 'Urikkes\Layanan\ViewController@index');
		Route::post('save', 'Urikkes\Layanan\PostController@simpan');
		Route::post('delete', 'Urikkes\Layanan\PostController@hapus');
	});

	Route::group(['prefix' => 'transaksi'], function(){
		Route::get('/', 'Urikkes\Transaksi\ViewController@index');
        Route::get('batalkan/{transaksi_id}', 'Urikkes\Transaksi\PostController@batalkan');
		Route::post('layani', 'Urikkes\Transaksi\PostController@layani');
		Route::get('detail/{paket_id}', 'Urikkes\Transaksi\ViewController@detail');
		Route::get('edit/{paket_id}', 'Urikkes\Transaksi\ViewController@edit');
		Route::get('add', 'Urikkes\Transaksi\ViewController@tambah');
	});


	Route::group(['prefix' => 'laporan'], function(){
		Route::get('/', 'Urikkes\Laporan\ViewController@index');
		Route::post('riwayat', 'Urikkes\Laporan\ViewController@riwayat');
		Route::post('pasien_umum', 'Urikkes\Laporan\ViewController@pasienUmum');
		Route::post('rekap', 'Urikkes\Laporan\ViewController@rekap');
		Route::post('diskesal', 'Urikkes\Laporan\ViewController@sistemDiskesal');
		Route::post('pamen-pns-jiwa-treadmill', 'Urikkes\Laporan\ViewController@pamenPnsJiwaTreadmill');
        Route::post('rekap-transaksi', 'Urikkes\Laporan\ViewController@rekapTransaksi');

	});
});
Route::group(['prefix' => 'api/urikkes'], function() {
    Route::group(['prefix' => 'pengaturan'], function(){
        Route::get('all-tipe-tarif', 'Urikkes\Pengaturan\ReadController@allTipeTarif');
    });
});
?>