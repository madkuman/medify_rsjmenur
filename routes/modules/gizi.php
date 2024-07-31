<?php
Route::group(['middleware' => ['check-module']], function(){
	Route::group(['prefix' => 'gizi'], function() {
		Route::get('/', 'Gizi\DashBoard\ViewController@index');

        Route::group(['prefix' => 'pemesanan'], function() {
            Route::get('/', 'Gizi\Pemesanan\ViewController@index');
            Route::get('/load-data', 'Gizi\Pemesanan\ReadController@loadData');
            Route::post('/simpan', 'Gizi\Pemesanan\PostController@addPemesanan');
            Route::get('/baru', 'Gizi\Pemesanan\ViewController@new');
            Route::post('/set-mutu-gizi', 'Gizi\Pemesanan\CreateController@setMutuGizi');
            Route::post('/edit', 'Gizi\Pemesanan\PostController@edit');
            Route::post('/delete', 'Gizi\Pemesanan\PostController@delete');
            Route::get('/{id}', 'Gizi\Pemesanan\ViewController@single');
            Route::post('/rekap-permintaan/baru', 'Gizi\Pemesanan\PostController@buatRekapPermintaan');
        });

        Route::get('/pemesanan/rekap-diet','Gizi\Pemesanan\ViewController@rekap_diet');
        Route::get('/pemesanan/rekap-diet-v2','Gizi\Pemesanan\ViewController@rekap_diet_v2');
        Route::get('/pemesanan/rekap-resep', 'Gizi\Pemesanan\ViewController@rekap_resep');
        Route::get('/pemesanan/rekap-jp', 'Gizi\Pemesanan\ViewController@rekap_jp');

        Route::get('/pemesanan/batal/{id}','Gizi\Pemesanan\ViewController@batal');
        Route::post('pemesanan/batal','Gizi\Pemesanan\PostController@batal');
        Route::get('/pemesanan/print/rekap-diet','Gizi\Pemesanan\ViewController@print_diet');
        Route::get('/pemesanan/print/rekap-resep','Gizi\Pemesanan\ViewController@print_resep');
        Route::get('/pemesanan/print/rekap-jp','Gizi\Pemesanan\ViewController@print_jp');
        Route::post('/pemesanan/print/label-pemesanan','Gizi\Pemesanan\ViewController@print_label');

        Route::group(['prefix' => 'monitoring'], function() {
            Route::get('/','Gizi\Monitoring\ViewController@index');
            Route::get('/bangsal/{id}','Gizi\Monitoring\ViewController@single');
        });

		Route::get('/belanja', 'Gizi\Belanja\ViewController@index');
		Route::get('/belanja/baru', 'Gizi\Belanja\ViewController@new');
		Route::get('/belanja/auto', 'Gizi\Belanja\ViewController@new_auto');
		Route::post('/belanja/finalisasi', 'Gizi\Belanja\PostController@finalisasiBelanja');
		Route::post('/belanja/konfirmasi', 'Gizi\Belanja\PostController@addBelanja');
		Route::get('/belanja/histori', 'Gizi\Belanja\ViewController@histori');
		Route::get('/belanja/edit/{id}', 'Gizi\Belanja\ViewController@edit');
		Route::get('/belanja/delete/{id}', 'Gizi\Belanja\DeleteController@delete');
		Route::get('/belanja/konfirmasi/{id}', 'Gizi\Belanja\ViewController@konfirmasi');
		Route::get('/belanja/finalisasi/{id}', 'Gizi\Belanja\ViewController@finalisasi');
		Route::get('/belanja/{id}', 'Gizi\Belanja\ViewController@final');

		Route::get('/produksi', 'Gizi\Produksi\ViewController@index');
		Route::get('produksi/baru/auto','Gizi\Produksi\ViewController@new');
		Route::post('produksi/baru/simpan-makanan','Gizi\Produksi\ViewController@newBahan');
		Route::get('/produksi/baru', 'Gizi\Produksi\ViewController@newTanggal');
		Route::get('/produksi/baru/pilih-tanggal', function () { return view('gizi.produksi.create-tanggal'); });
		Route::get('/produksi/baru/catat-makanan', 'Gizi\Produksi\ViewController@new');
		Route::post('/produksi/baru/catat-bahan', 'Gizi\Produksi\PostController@addProduksiBahan');
		Route::get('/produksi/histori','Gizi\Produksi\ViewController@histori');
		Route::get('/produksi/{id}', 'Gizi\Produksi\ViewController@final');
		Route::get('/produksi/edit/{id}','Gizi\Produksi\ViewController@edit');
		Route::get('/produksi/delete/{id}/{flag}','Gizi\Produksi\DeleteController@delete');

        Route::group(['prefix' => 'pengaturan'], function() {
            Route::get('/', 'Gizi\Pengaturan\ViewController@index');
            Route::group(['prefix' => 'bahan'], function() {
                Route::get('/', 'Gizi\Pengaturan\Bahan\ViewController@index');
                Route::post('/create', 'Gizi\Pengaturan\Bahan\PostController@create');
                Route::post('/{id}/edit','Gizi\Pengaturan\Bahan\PostController@edit');
                Route::post('/{id}/delete','Gizi\Pengaturan\Bahan\PostController@delete');
            });

            Route::group(['prefix' => 'resep'], function() {
                Route::get('/', 'Gizi\Pengaturan\Resep\ViewController@index');
                Route::get('/baru', 'Gizi\Pengaturan\Resep\ViewController@create');
                Route::post('/simpan', 'Gizi\Pengaturan\Resep\PostController@simpan');
                Route::get('/{id}', 'Gizi\Pengaturan\Resep\ViewController@detail');
                Route::get('/edit/{id}', 'Gizi\Pengaturan\Resep\ViewController@edit');
                Route::get('/delete/{id}', 'Gizi\Pengaturan\Resep\PostController@delete');
            });

            Route::group(['prefix' => 'menu'], function() {
                Route::get('/', 'Gizi\Pengaturan\JadwalMenu\ViewController@index');
                Route::get('/baru', 'Gizi\Pengaturan\JadwalMenu\ViewController@create');
                Route::post('/simpan', 'Gizi\Pengaturan\JadwalMenu\PostController@simpan');
                Route::get('/{id}', 'Gizi\Pengaturan\JadwalMenu\ViewController@detail');
                Route::get('/edit/{id}', 'Gizi\Pengaturan\JadwalMenu\ViewController@edit');
                Route::get('/delete/{id}', 'Gizi\Pengaturan\JadwalMenu\PostController@delete');
            });

            Route::group(['prefix' => 'kode-diet'], function() {
                Route::get('/', 'Gizi\Pengaturan\KodeDiet\ViewController@index');
                Route::get('/single/{id}', 'Gizi\Pengaturan\KodeDiet\ViewController@single');
            });

            Route::group(['prefix' => 'diet'], function() {
                Route::get('/', 'Gizi\Pengaturan\Diet\ViewController@index');
                Route::post('/create', 'Gizi\Pengaturan\Diet\PostController@create');
                Route::post('/{id}/edit','Gizi\Pengaturan\Diet\PostController@edit');
                Route::post('/{id}/delete','Gizi\Pengaturan\Diet\PostController@delete');
            });

            Route::group(['prefix' => 'jenis-makanan'], function() {
                Route::get('/', 'Gizi\Pengaturan\JenisMakanan\ViewController@index');
                Route::post('/create', 'Gizi\Pengaturan\JenisMakanan\PostController@create');
                Route::post('/{id}/edit','Gizi\Pengaturan\JenisMakanan\PostController@edit');
                Route::post('/{id}/delete','Gizi\Pengaturan\JenisMakanan\PostController@delete');
            });

            Route::group(['prefix' => 'anggaran-makanan'], function() {
                Route::get('/', 'Gizi\Pengaturan\AnggaranMakanan\ViewController@index');
                Route::post('/create', 'Gizi\Pengaturan\AnggaranMakanan\PostController@create');
                Route::post('/{id}/edit','Gizi\Pengaturan\AnggaranMakanan\PostController@edit');
                Route::post('/{id}/delete','Gizi\Pengaturan\AnggaranMakanan\PostController@delete');
                Route::get('/{id}','Gizi\Pengaturan\AnggaranMakanan\ViewController@detail');
            });

            Route::group(['prefix' => 'anggaran-makanan-detail'], function() {
                Route::post('/create', 'Gizi\Pengaturan\AnggaranMakananDetail\PostController@create');
                Route::post('/{id}/edit','Gizi\Pengaturan\AnggaranMakananDetail\PostController@edit');
                Route::post('/{id}/delete','Gizi\Pengaturan\AnggaranMakananDetail\PostController@delete');
            });
        });

		Route::get('/pengantaran','Gizi\Pengantaran\ViewController@index');
		Route::get('/pengantaran/print','Gizi\Pengantaran\ViewController@print');

		Route::get('/stok-bahan', 'Gizi\StokBahan\StokBahanController@index');
		Route::get('/stok','Gizi\StokBahan\StokBahanController@getbahan');
		Route::get('/laporan/laporan-bahan','Gizi\Laporan\PostController@rekapbahan');

        Route::group(['prefix' => 'laporan'], function() {
            Route::get('/','Gizi\Laporan\ViewController@index');
            Route::get('/laporan-permintaan-makanan','Gizi\Laporan\ViewController@laporanPermintaanMakanan');
            Route::get('/laporan-surat-pemesanan-makanan','Gizi\Laporan\ViewController@laporanSuratPemesananMakanan');
            Route::get('/laporan-diet-pasien-bulanan','Gizi\Laporan\ViewController@laporanDietPasienBulanan');
            Route::get('/laporan-penyerapan-porsi-makanan','Gizi\Laporan\ViewController@laporanPenyerapanPorsiMakanan');
            Route::get('/laporan-rekap-diet-pelayanan-makanan-pasien','Gizi\Laporan\ViewController@laporanRekapDietPelayananMakananPasien');
        });

		/*Route::get('/laporan/laporan-dinas','Gizi\Laporan\PostController@rekap_dinas');
		Route::get('/laporan/laporan-hankam','Gizi\Laporan\PostController@rekap_hankam');
		Route::get('/laporan/laporan-nonhankam','Gizi\Laporan\PostController@rekap_nonhankam');
		Route::get('/laporan/laporan-jamkesmas','Gizi\Laporan\PostController@rekap_jamkesmas');
		Route::get('/laporan/laporan-pc','Gizi\Laporan\PostController@rekap_pc');*/

		Route::get('/seed/tambahkode', 'Gizi\Seed\ViewController@addKode');
		Route::post('/seed/kirimkode', 'Gizi\Seed\PostController@create');

	});
});

Route::group(['prefix'=>'api/gizi'], function(){
    Route::get('/pengantaran/{id}','Gizi\Pengantaran\PostController@post');
    Route::group(['prefix'=>'pemesanan'], function(){
        Route::post('/getPembayaranPasien','Gizi\Pemesanan\ReadController@getPembayaranPasien');
        Route::get('/getmutugizi/{id}','Gizi\Pemesanan\ReadController@getPemesananMutuEdit');
        Route::post('/getKodeDietPasien','Gizi\Pemesanan\ReadController@getKodeDietPasien');
        Route::post('/getDietPasien','Gizi\Pemesanan\ReadController@getDietPasien');
        Route::post('/getBentukMakanan','Gizi\Pemesanan\ReadController@getBentukMakanan');
        Route::post('/getKategoriMakanan','Gizi\Pemesanan\ReadController@getKategoriMakanan');
        Route::post('/deleteDuplicate','Gizi\Pemesanan\DeleteController@deleteDuplicateKodeDiet');
        Route::get('/load-data', 'Gizi\Pemesanan\ReadController@loadData');
        Route::get('/rekomendasi-order', 'Gizi\Pemesanan\ReadController@rekomendasiOrder');
        Route::get('/edit/{id}','Gizi\Pemesanan\ReadController@getPemesananEdit');

    });
    Route::get('/kode-diet/load-data', 'Gizi\Pengaturan\KodeDiet\ReadController@loadData');
    Route::get('/kode-diet/single/load-data', 'Gizi\Pengaturan\KodeDiet\ReadController@loadDataSingle');
    Route::get('/dashboard/statistik', 'Gizi\DashBoard\ReadController@loadDataStatistik');

    Route::group(['prefix'=>'pengaturan'], function(){
        Route::get('/diet/getDataTable', 'Gizi\Pengaturan\Diet\ReadController@getDataTable');
        Route::get('/diet/single-data', 'Gizi\Pengaturan\Diet\ReadController@single');

        Route::get('/jenis-makanan/getDataTable', 'Gizi\Pengaturan\JenisMakanan\ReadController@getDataTable');
        Route::get('/jenis-makanan/single-data', 'Gizi\Pengaturan\JenisMakanan\ReadController@single');

        Route::get('/anggaran-makanan/getDataTable', 'Gizi\Pengaturan\AnggaranMakanan\ReadController@getDataTable');
        Route::get('/anggaran-makanan-detail/getDataTable', 'Gizi\Pengaturan\AnggaranMakananDetail\ReadController@getDataTable');
        Route::get('/anggaran-makanan-detail/single-data', 'Gizi\Pengaturan\AnggaranMakananDetail\ReadController@single');
    });

    Route::get('/pemesanan/edit/{id}','Gizi\Pemesanan\ReadController@getPemesananEdit');
    Route::get('/pemesanan/delete/{id}', 'Gizi\Pemesanan\DeleteController@delete');
});

Route::post('gizi/pemesanan/simpan', 'Gizi\Pemesanan\PostController@addPemesanan');
Route::post('gizi/pemesanan/set-mutu-gizi', 'Gizi\Pemesanan\CreateController@setMutuGizi');
//Route::post('gizi/pemesanan/simpanv2', 'Gizi\Pemesanan\PostController@addPemesananv2');
Route::get('gizi/pemesanan/baru', 'Gizi\Pemesanan\ViewController@new');
Route::get('gizi/pemesanan/{id}', 'Gizi\Pemesanan\ViewController@single');
Route::get('gizi/import/menu','Gizi\Import\ImportController@importMenu');
Route::get('gizi/import/menu-detail','Gizi\Import\ImportController@importMenuDetail');
Route::get('gizi/ganti-nama','Gizi\Import\ImportController@gantiNama');
Route::get('gizi/hapus-pokok','Gizi\Import\ImportController@hapusPokok');
Route::get('gizi/import/menu-pokok','Gizi\Import\ImportController@importMenuPokok');
Route::get('gizi/import/menu-snack','Gizi\Import\ImportController@importMenuSnack');
Route::get('gizi/import/menu-detail-pokok','Gizi\Import\ImportController@importMenuDetailPokok');
Route::get('gizi/import/menu-detail-snack','Gizi\Import\ImportController@importMenuDetailSnack');
Route::get('gizi/import/pivot-makanan-pokok','Gizi\Import\ImportController@importPivotMakananPokok');
Route::get('gizi/import/pivot-lauk','Gizi\Import\ImportController@importPivotLauk');
Route::get('gizi/import/pivot-kurang','Gizi\Import\ImportController@importPivotKurang');
Route::get('gizi/import/mapping','Gizi\Import\ImportController@mappingPivotDietMenu');
Route::get('gizi/import/resep-detail','Gizi\Import\ImportController@insertResepDetail');
Route::get('gizi/import/ganti-jadi-koma','Gizi\Import\ImportController@gantiJadiKoma');
Route::get('gizi/testing/all_test','Gizi\Import\ImportController@allTest');
Route::get('/gizi/import/cair_kertas','Gizi\Import\ImportController@importMenuCairKertas');
?>