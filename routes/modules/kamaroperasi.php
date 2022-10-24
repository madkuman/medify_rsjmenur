<?php
Route::group(['middleware' => ['check-module']], function(){ 
  Route::group(['prefix' => 'kamaroperasi'], function(){

    Route::get('/', 'KamarOperasi\ViewController@index');
    Route::get('/jadwal', 'KamarOperasi\Ruangan\ViewController@index');
    Route::get('/jadwal/rekap', 'KamarOperasi\Transaksi\ViewController@jadwalRekap');

    // Route::get('/pendaftaran', 'KamarOperasi\Transaksi\ViewController@index');
    Route::get('/pendaftaran', 'KamarOperasi\Transaksi\ViewController@pendaftaran');
    Route::get('/pendaftaran/tambah_permintaan', 'KamarOperasi\Transaksi\ViewController@tambahPermintaan');
    Route::post('/pendaftaran/tambah_permintaan', 'KamarOperasi\Transaksi\PostController@submitTambahPermintaan');
    Route::get('/pendaftaran/download', 'KamarOperasi\Transaksi\ViewController@download');
    Route::get('/pendaftaran/{id?}', 'KamarOperasi\Transaksi\ViewController@pendaftaran');
    Route::post('/pendaftaran/{id?}', 'KamarOperasi\Transaksi\PostController@daftarOperasiFromOperator');
    Route::get('/pendaftaran/{id}/{kasus_id?}', 'KamarOperasi\Transaksi\PostController@pendaftaranOperasi');


    Route::get('/pengaturan', 'KamarOperasi\Pengaturan\ViewController@index');
    Route::post('/upload/gambar','KamarOperasi\Transaksi\PostController@uploadGambar');
    Route::get('/delete/gambar','KamarOperasi\Transaksi\PostController@deleteGambar');

    Route::group(['prefix' => 'pemesanan'], function(){
      Route::get('/', 'KamarOperasi\Transaksi\ViewController@pemesanan');
      Route::get('/baru', 'KamarOperasi\Transaksi\ViewController@tanggal');
      Route::get('/tolak/{id}', 'KamarOperasi\Transaksi\DeleteController@pemesanan');
      Route::post('/masa_tunggu', 'KamarOperasi\Transaksi\PostController@fillMasaTunggu');

      Route::get('/{transaksi_id}', 'KamarOperasi\Transaksi\PostController@pickdate');
      Route::post('/{transaksi_id}', 'KamarOperasi\Transaksi\PostController@listkamar');
      Route::post('/{transaksi_id}/dokter', 'KamarOperasi\Transaksi\PostController@listdokter');
      Route::post('/{transaksi_id}/konfirmasi', 'KamarOperasi\Transaksi\PostController@konfirmasiKamar');
      Route::post('/{transaksi_id}/submit', 'KamarOperasi\Transaksi\PostController@submit');


    });

    Route::group(['prefix' => 'kamar'], function(){
      Route::get('/', 'KamarOperasi\Kamar\ViewController@index');
      Route::get('/create', 'KamarOperasi\Kamar\ViewController@create');
      Route::post('/new', 'KamarOperasi\Kamar\PostController@new');
      Route::get('/edit/{id}', 'KamarOperasi\Kamar\ViewController@edit');
      Route::post('/edit/{id}', 'KamarOperasi\Kamar\EditController@update');
      Route::get('/delete/{id}', 'KamarOperasi\Kamar\EditController@destroy');
    });

    Route::group(['prefix' => 'paket'], function(){
      Route::get('/', 'KamarOperasi\Paket\ViewController@index');
      Route::get('/show/{id}', 'KamarOperasi\Paket\ViewController@show');
      Route::get('/create', 'KamarOperasi\Paket\ViewController@create');
      Route::post('/new', 'KamarOperasi\Paket\PostController@new');
      Route::get('/edit/{id}', 'KamarOperasi\Paket\ViewController@edit');
      Route::post('/edit/{id}', 'KamarOperasi\Paket\EditController@update');
      Route::get('/delete/{id}', 'KamarOperasi\Paket\EditController@destroy');
    });

    Route::group(['prefix' => 'pelaksanaan'], function(){
      Route::get('/{id}', 'KamarOperasi\Transaksi\ViewController@pelaksanaan');
      Route::get('/{id}/print/hasil', 'KamarOperasi\Transaksi\ViewController@printHasil');
      // Route::post('/pasca', 'KamarOperasi\Transaksi\PostController@submitHasil');
      Route::post('/pengaturan', 'KamarOperasi\Transaksi\EditController@editDetail');
      Route::post('/pengaturan/ganti_jadwal', 'KamarOperasi\Transaksi\EditController@requestGantiJadwal');
      Route::post('/pengaturan/edit_dokter', 'KamarOperasi\Transaksi\EditController@editDokter');
      Route::post('/pengaturan/edit_judul', 'KamarOperasi\Transaksi\EditController@editJudul');
      Route::post('/pengaturan/batal_operasi', 'KamarOperasi\Transaksi\EditController@batalOperasi');
      Route::post('/pengaturan/edit_operasi_join', 'KamarOperasi\Transaksi\EditController@editOperasiJoin');
      Route::post('/pengembalian', 'KamarOperasi\Pasca\CreateController@pengembalian');
      Route::post('/rencana/obat', 'KamarOperasi\Rencana\CreateController@rencanaObat');
      Route::post('/rencana/tim', 'KamarOperasi\Tim\CreateController@syncTim');
      Route::post('/rencana/submit', 'KamarOperasi\Rencana\PostController@submitRencana');
      Route::post('/pemakaian/submit', 'KamarOperasi\Pemakaian\PostController@submitPemakaian');
      Route::post('/pengembalian/submit', 'KamarOperasi\Pengembalian\PostController@submitPengembalian');
      Route::get('/tim/hapus/{id}', 'KamarOperasi\Tim\DeleteController@anggota');
      Route::post('/pasca', 'KamarOperasi\Pasca\PostController@hasilOperasiAdd');
      Route::post('/rencana', 'KamarOperasi\Rencana\PostController@rencanaAddEdit');
      Route::post('/ganti_plafon', 'KamarOperasi\Pemakaian\PostController@gantiPlafon');

      Route::post('/tagihan-tambah', 'KamarOperasi\Transaksi\PostController@createTagihanKasus');
      Route::post('/tagihan-edit', 'KamarOperasi\Transaksi\PostController@editTagihanKasus');
      Route::post('/ganti-diagnosis', 'KamarOperasi\Transaksi\EditController@gantiDiagnosis');
    });


    Route::group(['prefix' => 'jenis-operasi'], function(){
      Route::get('/', 'KamarOperasi\JenisOperasi\ViewController@index');
      Route::post('/create', 'KamarOperasi\JenisOperasi\PostController@create');
      Route::post('/edit', 'KamarOperasi\JenisOperasi\PostController@edit');
      Route::post('/delete', 'KamarOperasi\JenisOperasi\PostController@delete');
    });

    Route::group(['prefix' => 'peran-tim'], function(){
      Route::get('/', 'KamarOperasi\PeranTim\ViewController@index');
      Route::post('/create', 'KamarOperasi\PeranTim\PostController@create');
      Route::post('/edit', 'KamarOperasi\PeranTim\PostController@edit');
      Route::post('/delete', 'KamarOperasi\PeranTim\PostController@delete');
    });

    Route::group(['prefix' => 'laporan'], function(){
      Route::get('/', 'KamarOperasi\Laporan\ViewController@index');
      Route::get('/rekap-jenis-operasi', 'KamarOperasi\Laporan\ViewController@rekapJenisOperasi');
      Route::get('/laporan-penggunaan-ruangan', 'KamarOperasi\Laporan\ViewController@laporanPenggunaanRuangan');
      Route::get('/diagnosis-terbanyak', 'KamarOperasi\Laporan\ViewController@diagnosisTerbanyak');
    });

  });
});

Route::group(['prefix' => 'ajax/kamaroperasi'], function(){
  Route::get('/rencana/tim', 'KamarOperasi\Tim\ReadController@ajaxGetTim');
  Route::get('/rencana/item', 'KamarOperasi\Rencana\ReadController@ajaxGetItem');
  Route::get('/pemakaian/item', 'KamarOperasi\Pemakaian\ReadController@ajaxGetItemPemakaian');
  Route::get('/pengembalian/item', 'KamarOperasi\Pengembalian\ReadController@ajaxGetItemPengembalian');
  Route::get('/search_paket', 'KamarOperasi\Paket\ReadController@ajaxSearchPaket');
  Route::get('/search_item', 'KamarOperasi\Rencana\ReadController@ajaxSearchItem');
  Route::get('/search_obat', 'KamarOperasi\Rencana\ReadController@ajaxSearchObat');
  Route::get('/search_alkes', 'KamarOperasi\Rencana\ReadController@ajaxSearchAlkes');
  Route::get('/search_matkes', 'KamarOperasi\Matkes\ReadController@ajaxSearchMatkes');
  Route::get('/search_implan', 'KamarOperasi\Implan\ReadController@ajaxSearchImplan');
  Route::get('/get_paket_item', 'KamarOperasi\Paket\ReadController@getPaketItem');
  Route::get('/search_tim', 'KamarOperasi\Rencana\ReadController@ajaxSearchTim');
  Route::get('/search_role', 'KamarOperasi\Rencana\ReadController@ajaxSearchRole');
  Route::get('/search_pasien', 'KamarOperasi\Transaksi\ReadController@ajaxSearchPasien');
  Route::get('/search_ruangan', 'KamarOperasi\Ruangan\ReadController@ajaxSearchRuangan');
  Route::get('/search_diagnosis', 'KamarOperasi\Transaksi\ReadController@ajaxSearchDiagnosis');
  Route::get('/get_pasien_summary', 'KamarOperasi\Transaksi\ReadController@ajaxGetPasienSummary');
  Route::get('/ronde_sisa', 'KamarOperasi\Transaksi\ReadController@ajaxRondeSisa');
  Route::get('/get_permintaan_jadwal', 'KamarOperasi\Transaksi\ReadController@ajaxGetPermintaanJadwal');
  Route::post('/jadwal', 'KamarOperasi\Transaksi\ReadController@ajaxGetJadwalKosong');
  Route::get('/jadwal/rekap', 'KamarOperasi\Transaksi\ReadController@ajaxGetJadwalRekap');
  Route::post('/transaksi', 'KamarOperasi\Transaksi\ReadController@ajaxGetTransaksi');
  Route::post('/rencana', 'KamarOperasi\Rencana\PostController@ajaxRencanaAdd');
  Route::post('/pasca', 'KamarOperasi\Pasca\PostController@ajaxPascaAdd');
  Route::get('/dokter', 'KamarOperasi\Transaksi\ReadController@getdokter');
  Route::get('/check-duplicate-transaksi', 'KamarOperasi\Transaksi\ReadController@checkDuplicateTransaksi');

});

?>
