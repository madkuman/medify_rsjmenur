<?php
	Route::group(['middleware' => ['check-module']], function(){ 
		Route::group(['prefix' => '/gudang'], function(){
			// Dashboard
			Route::get('/', 'Gudang\Dashboard\ViewController@index');

			// Pengadaan
			Route::get('/pengadaan', 'Gudang\Pengadaan\ViewController@index');
			Route::post('/pengadaan', 'Gudang\Pengadaan\ViewController@index');
			Route::post('/pengadaan/load-data', 'Gudang\Pengadaan\ViewController@loadData');
			Route::get('/pengadaan/add-items', 'Gudang\Pengadaan\ViewController@addItems');
			Route::get('/pengadaan/print-faktur/', 'Gudang\Pengadaan\ViewController@printFaktur');
			Route::get('/pengadaan/{slug}', 'Gudang\Pengadaan\ViewController@single');
			Route::get('/pengadaan/{slug}/print/', 'Gudang\Pengadaan\ViewController@printNota');
			Route::post('/pengadaan/new', 'Gudang\Pengadaan\CreateController@create');
			Route::post('/pengadaan/edit', 'Gudang\Pengadaan\EditController@edit');
			Route::post('/pengadaan/delete', 'Gudang\Pengadaan\DeleteController@delete');

			// Distribusi
			Route::get('/distribusi', 'Gudang\Distribusi\ViewController@index');
			Route::post('/distribusi', 'Gudang\Distribusi\ViewController@index');
			Route::post('/distribusi/load-data', 'Gudang\Distribusi\ViewController@loadData');
			Route::get('/distribusi/print/{slug}', 'Gudang\Distribusi\ViewController@print');
			Route::get('/distribusi/{slug}', 'Gudang\Distribusi\ViewController@single');
			Route::get('/distribusi/add-items', 'Gudang\distribusi\ViewController@addItems');
			Route::post('/distribusi/new', 'Gudang\Distribusi\CreateController@create');
			Route::post('/distribusi/konfirmasi', 'Gudang\Distribusi\EditController@confirm');
			Route::post('/distribusi/verify', 'Gudang\Distribusi\EditController@verify');
			Route::post('/distribusi/edit', 'Gudang\Distribusi\EditController@edit');
			Route::post('/distribusi/reject', 'Gudang\Distribusi\EditController@reject');
			Route::post('/distribusi/delete', 'Gudang\Distribusi\DeleteController@delete');

			// Penghapusan
			Route::get('/penghapusan', 'Gudang\Penghapusan\ViewController@index');
			Route::post('/penghapusan', 'Gudang\Penghapusan\ViewController@index');
			Route::post('/penghapusan/load-data', 'Gudang\Penghapusan\ViewController@loadData');		
			Route::get('/penghapusan/{slug}', 'Gudang\Penghapusan\ViewController@single');
			Route::get('/penghapusan/{slug}/print/', 'Gudang\Penghapusan\ViewController@printNota');
			Route::post('/penghapusan/new', 'Gudang\Penghapusan\CreateController@create');
			Route::post('/penghapusan/edit', 'Gudang\Penghapusan\EditController@edit');
			Route::post('/penghapusan/delete', 'Gudang\Penghapusan\DeleteController@delete');

			// Barang
			Route::get('/item', 'Gudang\Items\ViewController@index');
			Route::post('/item', 'Gudang\Items\ViewController@index');
			Route::get('/item-exp', 'Gudang\Items\ViewController@expired');
			Route::post('/item-exp', 'Gudang\Items\ViewController@expired');
			Route::get('/item-stok', 'Gudang\Items\ViewController@stokKosong');
			Route::post('/item-stok', 'Gudang\Items\ViewController@stokKosong');
			Route::post('/item/load-data', 'Gudang\Items\ViewController@loadData');
			Route::post('/item/load-exp', 'Gudang\Items\ViewController@loadExp');
			Route::post('/item/load-stok', 'Gudang\Items\ViewController@loadStok');
			Route::get('/item/tes', 'Gudang\Items\ViewController@tes');
			Route::get('/item/stok/{slug}', 'Gudang\Items\ViewController@allStok');
			Route::get('/item/{slug}', 'Gudang\Items\ViewController@single');
			Route::get('/item/{slug}/kartu-stok', 'Gudang\Laporan\ViewController@kartuStok');
			Route::post('/item/new', 'Gudang\Items\CreateController@create');
			Route::post('/item/edit', 'Gudang\Items\EditController@edit');
			Route::post('/item/delete', 'Gudang\Items\DeleteController@delete');

			// Supplier
			Route::get('/supplier', 'Gudang\Supplier\ViewController@index');
			Route::get('/supplier/{slug}', 'Gudang\Supplier\ViewController@single');
			Route::post('/supplier/new', 'Gudang\Supplier\CreateController@create');
			Route::post('/supplier/edit', 'Gudang\Supplier\EditController@edit');
			Route::post('/supplier/delete', 'Gudang\Supplier\DeleteController@delete');

			// Kategori
			Route::get('/kategori', 'Gudang\Kategori\ViewController@index');
			Route::get('/kategori/{slug}', 'Gudang\Kategori\ViewController@single');
			Route::post('/kategori/new', 'Gudang\Kategori\CreateController@create');
			Route::post('/kategori/edit', 'Gudang\Kategori\EditController@edit');
			Route::post('/kategori/delete', 'Gudang\Kategori\DeleteController@delete');

			//stok opname
			Route::get('/stokopname', 'Gudang\StokOpname\ViewController@index');
			Route::get('/stokopname/new', 'Gudang\StokOpname\ViewController@new');
			Route::post('/stokopname', 'Gudang\StokOpname\ViewController@index');
			Route::post('/stokopname/load-data', 'Gudang\StokOpname\ViewController@loadData');
			Route::get('/stokopname/review/{slug}', 'Gudang\StokOpname\ViewController@review');
			Route::get('/stokopname/print/{slug}', 'Gudang\StokOpname\ViewController@print');
			Route::get('/stokopname/download/{slug}', 'Gudang\StokOpname\ViewController@download');
			Route::get('/stokopname/{slug}/{flag}', 'Gudang\StokOpname\ViewController@single');
			Route::get('/stokopname/{slug}/print/', 'Gudang\StokOpname\ViewController@printNota');
			Route::post('/stokopname/new', 'Gudang\StokOpname\CreateController@create');
			Route::post('/stokopname/add', 'Gudang\StokOpname\EditController@add');
			Route::post('/stokopname/edit', 'Gudang\StokOpname\EditController@edit');
			Route::post('/stokopname/confirm', 'Gudang\StokOpname\EditController@confirm');
			Route::post('/stokopname/delete', 'Gudang\StokOpname\DeleteController@delete');

			// Laporan

			Route::get('/laporan/distribusi-obat-keluar', 'Gudang\Laporan\ViewController@laporanObatKeluar');
			Route::get('/laporan', 'Gudang\Laporan\ViewController@index');
			Route::get('/laporan/stok-sekarang', 'Gudang\Laporan\ViewController@stokSekarang');
			Route::get('laporan/kartu-stok', 'Gudang\Laporan\ViewController@kartuStok');
			Route::get('laporan/kegiatan-kesehatan', 'Gudang\Laporan\ViewController@kegiatanKesehatan');
			Route::get('laporan/rekapitulasi-narkotika', 'Gudang\Laporan\ViewController@rekapitulasiNarkotika');
			Route::get('laporan/stok-opname', 'Gudang\Laporan\ViewController@stokOpname');
			Route::get('laporan/penerimaan', 'Gudang\Laporan\ViewController@penerimaan');
			//Route::get('laporan/pemakaian-obat', 'Gudang\Laporan\ViewController@pemakaianObat');
			Route::get('laporan/pengeluaran-obat', 'Gudang\Laporan\ViewController@pengeluaranObat');
			Route::get('laporan/pemberian-obat', 'Gudang\Laporan\ViewController@pemberianObat');
			Route::get('laporan/resep-obat', 'Gudang\Laporan\ViewController@resepObat');
			Route::get('laporan/kegiatan-kesehatan-farmasi', 'Gudang\Laporan\ViewController@kegiatanKesehatanFarmasi');

			// Route::get('transaksi/buat-racikan', 'Farmasi\Transaksi\ViewController@createRacikan');
		});
	});

	Route::group(['prefix' => '/api/gudang'], function(){
		Route::get('/item/get', 'Gudang\Items\ReadController@getItems');
		Route::get('/item/active/{slug}', 'Gudang\Items\ReadController@getActiveItemList');
		Route::get('/item/produksi/get', 'Gudang\Items\ReadController@getProduksi');
		Route::get('/item/{slug}/mutasi/{page}', 'Gudang\Items\ReadController@getItemList');
		Route::post('/stokopname/save-changes', 'Gudang\StokOpname\EditController@editFix');

	});
?>