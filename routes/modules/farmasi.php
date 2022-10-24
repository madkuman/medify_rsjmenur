<?php 
	Route::group(['prefix' => '/farmasi'], function(){
		// Apotek
		Route::get('/fill-laporan-transaksi', 'Farmasi\Farmasi\ReadController@fillTabelLaporanTransaksi');
		Route::get('/fill-laporan-distribusi', 'Farmasi\Farmasi\ReadController@fillTabelLaporanDistribusi');
		Route::get('/fill-laporan-penghapusan', 'Farmasi\Farmasi\ReadController@fillTabelLaporanPenghapusan');
		Route::get('/fill-laporan-pengadaan', 'Farmasi\Farmasi\ReadController@fillTabelLaporanPengadaan');

		Route::get('/', 'Farmasi\Farmasi\ViewController@index');
		Route::post('/new', 'Farmasi\Farmasi\CreateController@create');
		Route::get('/item/stok/{item}', 'Farmasi\Items\ViewController@allStok');
        Route::get('/check-in', 'Farmasi\Screen\ViewController@checkIn');
        Route::post('/check-in', 'Farmasi\Screen\PostController@checkIn');
        Route::post('/check-in/konfirmasi', 'Farmasi\Screen\PostController@confirm');
        Route::post('/check-in/print', 'Farmasi\Screen\PostController@print');
		Route::group(['middleware' => ['check-module', 'farmasi-shift']], function(){
			Route::post('/{farmasi}/edit', 'Farmasi\Farmasi\EditController@edit');
			Route::post('/{farmasi}/edit-shift', 'Farmasi\Farmasi\EditController@editShift');

			// Paket Obat
			Route::get('/{farmasi}/paket-obat', 'Farmasi\PaketObat\ViewController@index');
			Route::post('/{farmasi}/paket-obat/create', 'Farmasi\PaketObat\PostController@create');
			Route::post('/{farmasi}/paket-obat/edit', 'Farmasi\PaketObat\PostController@edit');
			Route::post('/{farmasi}/paket-obat/delete', 'Farmasi\PaketObat\PostController@delete');

			// Dashboard
			Route::get('/{farmasi}', 'Farmasi\Dashboard\ViewController@index');
			Route::get('/{farmasi}/dashboard', 'Farmasi\Dashboard\ViewController@index');

			// Distribusi
			Route::get('/{farmasi}/distribusi', 'Farmasi\Distribusi\ViewController@index');
			Route::post('/{farmasi}/distribusi', 'Farmasi\Distribusi\ViewController@index');
			Route::get('/{farmasi}/distribusi/print/{slug}', 'Farmasi\Distribusi\ViewController@print');
			Route::get('/{farmasi}/distribusi/{slug}', 'Farmasi\Distribusi\ViewController@single');
			Route::get('/{farmasi}/distribusi/slug/print', 'Farmasi\Distribusi\ViewController@printNota');
			Route::post('/{farmasi}/distribusi/new', 'Farmasi\Distribusi\CreateController@create');
			Route::post('/{farmasi}/distribusi/verify', 'Farmasi\Distribusi\EditController@verify');
			Route::post('/{farmasi}/distribusi/konfirmasi-permintaan', 'Farmasi\Distribusi\EditController@konfirmasiPermintaan');
			Route::post('/{farmasi}/distribusi/konfirmasi-terima', 'Farmasi\Distribusi\EditController@konfirmasiTerima');
			Route::post('/{farmasi}/distribusi/edit', 'Farmasi\Distribusi\EditController@edit');
			Route::post('/{farmasi}/distribusi/editTerkirim', 'Farmasi\Distribusi\EditController@editTerkirim');
			Route::post('/{farmasi}/distribusi/reject', 'Farmasi\Distribusi\EditController@rejectOwn');
			Route::post('/{farmasi}/distribusi/delete', 'Farmasi\Distribusi\DeleteController@delete');

			// Pengadaan
			Route::get('/{farmasi}/pengadaan', 'Farmasi\Pengadaan\ViewController@index');
			Route::get('/{farmasi}/pengadaan/{slug}', 'Farmasi\Pengadaan\ViewController@single');
			Route::get('/{farmasi}/pengadaan/{slug}/print/', 'Farmasi\Pengadaan\ViewController@printNota');
			Route::post('/{farmasi}/pengadaan/new', 'Farmasi\Pengadaan\CreateController@create');
			Route::post('/{farmasi}/pengadaan/edit', 'Farmasi\Pengadaan\EditController@edit');
			Route::post('/{farmasi}/pengadaan/delete', 'Farmasi\Pengadaan\DeleteController@delete');

			// Kategori
			Route::get('/{farmasi}/kategori', 'Farmasi\Kategori\ViewController@index');
			Route::get('/{farmasi}/kategori/{slug}', 'Farmasi\Kategori\ViewController@single');
			Route::post('/{farmasi}/kategori/new', 'Farmasi\Kategori\CreateController@create');
			Route::post('/{farmasi}/kategori/edit', 'Farmasi\Kategori\EditController@edit');
			Route::post('/{farmasi}/kategori/delete', 'Farmasi\Kategori\DeleteController@delete');

            // Sumber Dana
            Route::get('/{farmasi}/sumber-dana', 'Farmasi\SumberDana\ViewController@index');
            Route::get('/{farmasi}/sumber-dana/{slug}', 'Farmasi\SumberDana\ViewController@single');
            Route::post('/{farmasi}/sumber-dana/new', 'Farmasi\SumberDana\CreateController@create');
            Route::post('/{farmasi}/sumber-dana/edit', 'Farmasi\SumberDana\EditController@edit');
            Route::post('/{farmasi}/sumber-dana/delete', 'Farmasi\SumberDana\DeleteController@delete');

            // Katalog
            Route::get('/{farmasi}/katalog', 'Farmasi\Katalog\ViewController@index');
            Route::get('/{farmasi}/katalog/{id}', 'Farmasi\Katalog\ViewController@single');
            Route::post('/{farmasi}/katalog/new', 'Farmasi\Katalog\CreateController@create');
            Route::post('/{farmasi}/katalog/edit', 'Farmasi\Katalog\EditController@edit');
            Route::post('/{farmasi}/katalog/delete', 'Farmasi\Katalog\DeleteController@delete');
			
			// Penghapusan
			Route::get('/{farmasi}/penghapusan', 'Farmasi\Penghapusan\ViewController@index');
			Route::post('/{farmasi}/penghapusan', 'Farmasi\Penghapusan\ViewController@index');
			Route::get('/{farmasi}/penghapusan/{slug}', 'Farmasi\Penghapusan\ViewController@single');
			Route::get('/{farmasi}/penghapusan/{slug}/print/', 'Farmasi\Penghapusan\ViewController@printNota');
			Route::post('/{farmasi}/penghapusan/new', 'Farmasi\Penghapusan\CreateController@create');
			Route::post('/{farmasi}/penghapusan/edit', 'Farmasi\Penghapusan\EditController@edit');
			Route::post('/{farmasi}/penghapusan/delete', 'Farmasi\Penghapusan\DeleteController@delete');

			// Barang
			Route::get('/{farmasi}/item', 'Farmasi\Items\ViewController@index');
			Route::post('/{farmasi}/item', 'Farmasi\Items\ViewController@index');
			Route::get('/{farmasi}/item-exp', 'Farmasi\Items\ViewController@expired');
			Route::post('/{farmasi}/item-exp', 'Farmasi\Items\ViewController@expired');
			Route::get('/{farmasi}/item-stok', 'Farmasi\Items\ViewController@stokkosong');
			Route::post('/{farmasi}/item-stok', 'Farmasi\Items\ViewController@stokkosong');
			Route::post('/{farmasi}/item/load-exp', 'Farmasi\Items\ViewController@loadExp');
			Route::post('/{farmasi}/item/load-stok', 'Farmasi\Items\ViewController@loadStok');
			Route::get('/{farmasi}/item/{slug}', 'Farmasi\Items\ViewController@single');
			Route::get('/{farmasi}/item/{slug}/kartu-stok', 'Farmasi\Laporan\ViewController@kartuStok');
			Route::post('/{farmasi}/item/edit', 'Farmasi\Items\EditController@edit');
			Route::post('/{farmasi}/item/new', 'Farmasi\Items\CreateController@create');
			Route::post('/{farmasi}/item/delete', 'Farmasi\Items\DeleteController@delete');
            Route::post('/{farmasi}/item/recalculate', 'Farmasi\Items\EditController@recalculate');

			Route::get('/{farmasi}/item/filter/expired', 'Farmasi\Items\ViewController@filterExpired');
			Route::get('/{farmasi}/item/filter/low-stock', 'Farmasi\Items\ViewController@filterLowStock');

            Route::get('/{farmasi}/item/filter/low-stock/export', 'Farmasi\Items\ViewController@lowStockExport');

			// Stok Opname
			Route::get('/{farmasi}/stokopname', 'Farmasi\StokOpname\ViewController@index');
			Route::get('/{farmasi}/stokopname/new', 'Farmasi\StokOpname\ViewController@new');
			Route::post('/{farmasi}/stokopname', 'Farmasi\StokOpname\ViewController@index');
			Route::get('/{farmasi}/stokopname/review/{slug}', 'Farmasi\StokOpname\ViewController@review');
			Route::get('/{farmasi}/stokopname/review-print/{slug}', 'Farmasi\StokOpname\ViewController@reviewPrint');
			Route::get('/{farmasi}/stokopname/print/{slug}', 'Farmasi\StokOpname\ViewController@print');
			Route::get('/{farmasi}/stokopname/download/{slug}', 'Farmasi\StokOpname\ViewController@download');
			Route::get('/{farmasi}/stokopname/{slug}/{flag}', 'Farmasi\StokOpname\ViewController@single');
			Route::get('/{farmasi}/stokopname/{slug}/print/', 'Farmasi\StokOpname\ViewController@printNota');
			Route::post('/{farmasi}/stokopname/new', 'Farmasi\StokOpname\CreateController@create');
			Route::post('/{farmasi}/stokopname/add', 'Farmasi\StokOpname\EditController@add');
			Route::post('/{farmasi}/stokopname/edit', 'Farmasi\StokOpname\EditController@edit');
			Route::post('/{farmasi}/stokopname/confirm', 'Farmasi\StokOpname\EditController@confirm');
			Route::post('/{farmasi}/stokopname/delete', 'Farmasi\StokOpname\DeleteController@delete');

			//Transaksi
			Route::get('/{farmasi}/transaksi', 'Farmasi\Transaksi\ViewController@index');
			Route::post('/{farmasi}/transaksi', 'Farmasi\Transaksi\ViewController@index');
			Route::get('/{farmasi}/penunjang/{slug}','Farmasi\Transaksi\ViewController@loadPenunjang');
			//Route::get('/{farmasi}/transaksi/create', 'Farmasi\Transaksi\CreateController@create');
			// Route::get('/{farmasi}/transaksi/edit-kemoterapi/{slug}', 'Farmasi\Transaksi\ViewController@editKemoterapi');
			Route::get('/{farmasi}/transaksi/edit/{tipe}/{slug}', 'Farmasi\Transaksi\ViewController@edit');
			Route::get('/{farmasi}/transaksi/copy/{slug}', 'Farmasi\Transaksi\ViewController@copy');
			Route::post('/{farmasi}/transaksi/print/{slug}', 'Farmasi\Transaksi\ViewController@printNota');
			Route::post('/{farmasi}/transaksi/print-retur/{slug}', 'Farmasi\Transaksi\ViewController@printNotaRetur');
			Route::post('/{farmasi}/transaksi/print-kwitansi/{slug}', 'Farmasi\Transaksi\ViewController@printKwitansi');
			
			Route::get('/{farmasi}/transaksi/detail-kemoterapi', 'Farmasi\Transaksi\ViewController@singleKemoterapi');

			Route::get('/{farmasi}/transaksi/buat-racikan', 'Farmasi\Transaksi\ViewController@createRacikan');
			Route::get('/{farmasi}/transaksi/analisa-resep/{slug}', 'Farmasi\Transaksi\ViewController@analisaResep');
			Route::get('/{farmasi}/transaksi/cetak-analisa/{slug}', 'Farmasi\Transaksi\ViewController@cetakanalisa');
			Route::get('/{farmasi}/transaksi/cetak-copy/{slug}', 'Farmasi\Transaksi\ViewController@cetakcopy');
			Route::get('/{farmasi}/transaksi/{slug}', 'Farmasi\Transaksi\ViewController@single');
			Route::post('/{farmasi}/transaksi/{slug}/5-benar', 'Farmasi\Transaksi\EditController@limaBenar');
			Route::post('/{farmasi}/transaksi/{slug}/kerjakan', 'Farmasi\Transaksi\EditController@kerjakan');
			Route::post('/{farmasi}/transaksi/new', 'Farmasi\Transaksi\CreateController@createOwn');
			Route::post('/{farmasi}/transaksi/edit', 'Farmasi\Transaksi\EditController@edit');
			Route::post('/{farmasi}/transaksi/copy', 'Farmasi\Transaksi\CreateController@copy');
			Route::post('/{farmasi}/transaksi/delete', 'Farmasi\Transaksi\DeleteController@delete');
			Route::post('/{farmasi}/transaksi/payment', 'Farmasi\Transaksi\EditController@payment');
			Route::post('/{farmasi}/transaksi/analisa', 'Farmasi\Transaksi\EditController@analisa');
			Route::post('/{farmasi}/transaksi/retur', 'Farmasi\Transaksi\EditController@retur');
            Route::post('/{farmasi}/transaksi/delete-retur', 'Farmasi\Transaksi\EditController@deleteRetur');
            Route::post('/{farmasi}/transaksi/edit-retur', 'Farmasi\Transaksi\EditController@editRetur');
			Route::post('/{farmasi}/transaksi/kirim-kasir', 'Farmasi\Transaksi\EditController@kirimKasir');
			Route::post('/{farmasi}/transaksi/batal-kirim-kasir', 'Farmasi\Transaksi\EditController@batalKirimKasir');

			
			Route::get('/{farmasi}/resep/print/{slug}', 'Farmasi\Transaksi\ViewController@printResep');
			Route::get('/{farmasi}/resep-ori/print/{slug}', 'Farmasi\Transaksi\ViewController@printResepOri');
			Route::get('/{farmasi}/resep/print-format-dokter/{slug}', 'Farmasi\Transaksi\ViewController@printResepFormatDokter');
			Route::get('/{farmasi}/label-obat/print/{slug}', 'Farmasi\Transaksi\ViewController@labelObat');
			Route::post('/{farmasi}/transaksi/alih', 'Farmasi\Transaksi\CreateController@alihResep');
			Route::post('/{farmasi}/transaksi/consis/{slug}', 'Farmasi\Consis\PostController@createTransaksi');

			Route::get('/{farmasi}/print-kemo', 'Farmasi\Transaksi\ViewController@printKemo');
			Route::get('/{farmasi}/print-label-kemo', 'Farmasi\Transaksi\ViewController@labelObatKemo');

            //Screen
            Route::get('/{farmasi}/screen-tv', 'Farmasi\Screen\ViewController@index');
            Route::get('/{farmasi}/screen-tv/master/{master_screen_slug}', 'Farmasi\Screen\ViewController@single');
            Route::post('/{farmasi}/screen-tv/save', 'Farmasi\Screen\PostController@save');
            Route::post('/{farmasi}/screen-tv/delete', 'Farmasi\Screen\PostController@delete');
            Route::post('/{farmasi}/screen-tv/panggil-antrian', 'Farmasi\Screen\PostController@call');
            Route::get('/{farmasi}/screen-tv/pengaturan', 'Farmasi\Screen\ViewController@settings');        
            Route::get('/{farmasi}/screen-tv/jenis-antrian', 'Farmasi\JenisAntrian\ViewController@index');
            Route::post('/{farmasi}/screen-tv/jenis-antrian/save', 'Farmasi\JenisAntrian\PostController@save');
            Route::post('/{farmasi}/screen-tv/jenis-antrian/delete', 'Farmasi\JenisAntrian\PostController@delete');
            Route::get('/{farmasi}/screen-tv/waktu-estimasi', 'Farmasi\WaktuEstimasiJenisResep\ViewController@index');
            Route::post('/{farmasi}/screen-tv/waktu-estimasi/save', 'Farmasi\WaktuEstimasiJenisResep\PostController@save');
            Route::get('/{farmasi}/screen-tv/loket-antrian', 'Farmasi\LoketAntrian\ViewController@index');
            Route::post('/{farmasi}/screen-tv/loket-antrian/save', 'Farmasi\LoketAntrian\PostController@save');
            Route::post('/{farmasi}/screen-tv/loket-antrian/delete', 'Farmasi\LoketAntrian\PostController@delete');

			// Laporan
			Route::get('/{farmasi}/laporan', 'Farmasi\Laporan\ViewController@index');
			Route::get('/{farmasi}/laporan/pasien-kemoterapi', 'Farmasi\Laporan\ViewController@pasienKemoterapi');
			Route::get('/{farmasi}/laporan/barang-expired', 'Farmasi\Laporan\ViewController@expired');
			Route::get('/{farmasi}/laporan/kartu-stok', 'Farmasi\Laporan\ViewController@kartuStok');
			Route::get('/{farmasi}/laporan/kegiatan-kesehatan', 'Farmasi\Laporan\ViewController@kegiatanKesehatan');
			Route::get('/{farmasi}/laporan/rekapitulasi-narkotika', 'Farmasi\Laporan\ViewController@rekapitulasiNarkotika'); //edited
			Route::get('/{farmasi}/laporan/stok-opname', 'Farmasi\Laporan\ViewController@stokOpname');
			Route::get('/{farmasi}/laporan/stok-sekarang', 'Farmasi\Laporan\ViewController@stokSekarang');
			Route::get('/{farmasi}/laporan/pemakaian-obat', 'Farmasi\Laporan\ViewController@pemakaianObat');
			Route::get('/{farmasi}/laporan/pengeluaran-obat', 'Farmasi\Laporan\ViewController@pengeluaranObat');
			Route::get('/{farmasi}/laporan/pemberian-obat', 'Farmasi\Laporan\ViewController@pemberianObat');
			Route::get('/{farmasi}/laporan/pemberian-per-bangsal', 'Farmasi\Laporan\ViewController@pemberianPerBangsal');
			Route::get('/{farmasi}/laporan/resep-obat', 'Farmasi\Laporan\ViewController@resepObat');
			Route::get('/{farmasi}/laporan/kegiatan-kesehatan-farmasi', 'Farmasi\Laporan\ViewController@kegiatanKesehatanFarmasi');
			Route::get('/{farmasi}/laporan/laporan-penjualan-obat', 'Farmasi\Laporan\ViewController@laporanPenjualanObat');
			Route::get('/{farmasi}/laporan/laporan-penjualan-bebas', 'Farmasi\Laporan\ViewController@laporanPenjualanBebas');
			Route::get('/{farmasi}/laporan/distribusi-obat-masuk', 'Farmasi\Laporan\ViewController@laporanObatMasuk');
			Route::get('/{farmasi}/laporan/distribusi-obat-keluar', 'Farmasi\Laporan\ViewController@laporanObatKeluar');
			Route::get('/{farmasi}/laporan/obat-dukungan', 'Farmasi\Laporan\ViewController@obatDukungan');
			Route::get('/{farmasi}/laporan/put-gudang', 'Farmasi\Laporan\ViewController@putGudang');
			Route::get('/{farmasi}/laporan/penerimaan-gudang', 'Farmasi\Laporan\ViewController@penerimaanGudang'); //laporan penerimaan gudang

			//MENUR
			Route::get('/{farmasi}/laporan/laporan-pelayanan-resep', 'Farmasi\Laporan\PostController@laporanPelayananResep'); 
			Route::get('/{farmasi}/laporan/laporan-response-time-harian', 'Farmasi\Laporan\PostController@laporanResponseTimeHarian'); 
			Route::get('/{farmasi}/laporan/laporan-response-time-tahunan', 'Farmasi\Laporan\PostController@laporanResponseTimeTahunan'); 
			Route::get('/{farmasi}/laporan/laporan-waktu-pelayanan', 'Farmasi\Laporan\PostController@laporanWaktuPelayanan'); 
			Route::get('/{farmasi}/laporan/laporan-kesesuaian-dokter-fornas-bulanan', 'Farmasi\Laporan\PostController@laporanKesesuaianDokterFornasBulanan'); 
			Route::get('/{farmasi}/laporan/laporan-kesesuaian-dokter-fornas-harian', 'Farmasi\Laporan\PostController@laporanKesesuaianDokterFornasHarian'); 
			Route::get('/{farmasi}/laporan/laporan-telaah-resep', 'Farmasi\Laporan\PostController@laporanTelaahResep'); 
			Route::get('/{farmasi}/laporan/laporan-persediaan-farmasi', 'Farmasi\Laporan\PostController@laporanPersediaanFarmasi'); 
			Route::get('/{farmasi}/laporan/mutasi-stok-emergensi', 'Farmasi\Laporan\PostController@mutasiStokEmergensi'); 
			Route::get('/{farmasi}/laporan/laporan-stok-emergensi', 'Farmasi\Laporan\PostController@laporanStokEmergensi'); 
			Route::get('/{farmasi}/laporan/rekap-penggunaan-barang', 'Farmasi\Laporan\PostController@rekapPenggunaanBarang'); 
			Route::get('/{farmasi}/laporan/laporan-penggunaan-barang', 'Farmasi\Laporan\PostController@laporanPenggunaanBarang'); 
			Route::get('/{farmasi}/laporan/laporan-barang-telah-expired', 'Farmasi\Laporan\PostController@laporanBarangTelahExpired'); 
			Route::get('/{farmasi}/laporan/laporan-barang-mendekati-expired', 'Farmasi\Laporan\PostController@laporanBarangMendekatiExpired'); 
			Route::get('/{farmasi}/laporan/laporan-perbekalan-farmasi', 'Farmasi\Laporan\PostController@laporanPerbekalanFarmasi');
            Route::get('/{farmasi}/laporan/laporan-pelayanan-kefarmasian-jatim', 'Farmasi\Laporan\PostController@laporanPelayananKefarmasianJatim');
            Route::get('/{farmasi}/laporan/laporan-penggunaan-obat', 'Farmasi\Laporan\PostController@laporanPenggunaanObat');
            Route::get('/{farmasi}/laporan/laporan-pelayanan-obat-jkn', 'Farmasi\Laporan\PostController@laporanPelayananObatJkn');
            Route::get('/{farmasi}/laporan/penerimaan-barang-habis-pakai', 'Farmasi\Laporan\PostController@laporanPenerimaanBarangHabisPakai');
            Route::get('/{farmasi}/laporan/laporan-realisasi', 'Farmasi\Laporan\PostController@laporanRealisasi');
            Route::get('/{farmasi}/laporan/laporan-bpk-sumber-dana', 'Farmasi\Laporan\PostController@laporanBPKSumberDana');
            Route::get('/{farmasi}/laporan/laporan-bpk-pemakaian', 'Farmasi\Laporan\PostController@laporanBPKPemakaian');
            Route::get('/{farmasi}/laporan/laporan-bpk-penerimaan', 'Farmasi\Laporan\PostController@laporanBPKPenerimaan');



            Route::group(['prefix' => '/{farmasi}/laporan-v2'], function(){
                Route::get('/laporan-pelayanan-resep', 'Farmasi\LaporanV2\PelayananResep\ViewController@index');
                Route::post('/laporan-pelayanan-resep/download', 'Farmasi\LaporanV2\PelayananResep\ViewController@download');

            });



			Route::get('/{farmasi}/produksi', 'Farmasi\Produksi\ViewController@index');
			Route::get('/{farmasi}/produksi/{id}', 'Farmasi\Produksi\ViewController@single');
			Route::post('/{farmasi}/produksi/create', 'Farmasi\Produksi\PostController@create');
			Route::post('/{farmasi}/produksi/produksi', 'Farmasi\Produksi\PostController@produksi');
		});
	});

	Route::group(['prefix' => '/api/farmasi'], function(){
		Route::get('/item/get', 'Farmasi\ItemTemplate\ReadController@search');
		Route::get('/transaksi/get', 'Farmasi\Transaksi\ViewController@loadDataIndex'); //load datatable transaksi/index
		Route::get('/transaksi/get/{slug}', 'Farmasi\Transaksi\ReadController@ajaxGetTransaksi'); 
		Route::get('/{farmasi}/distribusi/get', 'Farmasi\Distribusi\ViewController@loadDataIndex'); //load datatable distribusi/index
		Route::get('/{farmasi}/pengadaan/get', 'Farmasi\Pengadaan\ViewController@loadDataIndex'); //load datatable pengadaan/index
		Route::get('/{farmasi}/item/load-data', 'Farmasi\Items\ViewController@loadDataIndex'); //load datatable item/index
		Route::get('/{farmasi}/penghapusan/get', 'Farmasi\Penghapusan\ViewController@loadDataIndex'); //load datatable item/index
		Route::get('/{farmasi}/stokopname/get', 'Farmasi\StokOpname\ViewController@loadDataIndex'); //load datatable item/index
		Route::get('/resep/check-penggunaan', 'Farmasi\Resep\ReadController@checkPenggunaanObat');
		Route::get('/aturan/get-has-usage', 'Farmasi\AturanObat\ReadController@getHasUsage');
		Route::get('/aturan/search-has-usage', 'Farmasi\AturanObat\ReadController@searchHasUsage');
		Route::get('/{farmasi}/item/get', 'Farmasi\Items\ReadController@getItems');
		Route::get('/{farmasi}/item/active/{slug}', 'Farmasi\Items\ReadController@getActiveItemList');
		Route::get('/{farmasi}/item/{slug}/mutasi/{date_start}/{date_end}', 'Farmasi\Items\ReadController@getMutasi');
		Route::get('/{farmasi}/paket-obat/get/all', 'Farmasi\PaketObat\ReadController@getAllAPI');
		Route::get('/{farmasi}/paket-obat/get/{id}', 'Farmasi\PaketObat\ReadController@getAPI');
		Route::post('/{farmasi}/stokopname/save-changes', 'Farmasi\StokOpname\EditController@editFix');
		Route::get('/{farmasi}/produksi/get', 'Farmasi\Produksi\ReadController@get');

		Route::get('/histori-resep/get/{id}', 'Farmasi\Transaksi\ReadController@getHistori');
		Route::get('/penyedia/get', 'Farmasi\Items\ReadController@getItems');

		Route::get('/screen/task/get/{farm_id}/{screen_id}', 'Farmasi\Screen\ViewController@loadDataTable');
    	Route::post('/screen/task/get-realtime/{farm_id}/{screen_id}', 'Farmasi\Screen\PostController@loadDataRealtime');
        Route::get('{farmasi}/antrian-screen/update', 'Farmasi\Screen\PostController@screenUpdateNomorAntrian');

        Route::group(['prefix' => '/{farmasi}/laporan-v2'], function(){
            Route::get('/laporan-pelayanan-resep/get-total-data', 'Farmasi\LaporanV2\PelayananResep\APIController@getTotalData');
            Route::get('/laporan-pelayanan-resep/get-data', 'Farmasi\LaporanV2\PelayananResep\APIController@getData');
        });
	});
?>