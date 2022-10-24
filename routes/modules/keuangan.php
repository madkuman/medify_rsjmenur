<?php 

Route::group(['middleware' => ['check-module']], function(){
	Route::group(['prefix' => 'keuangan'], function(){
		Route::get('/cok/{id}', 'Keuangan\Penagihan\ViewController@commandDownloadLaporan');
		Route::get('/', 'Keuangan\Dashboard\ViewController@index');
		Route::get('/dashboard', 'Keuangan\Dashboard\ViewController@index');
		Route::get('/akun', 'Keuangan\Akun\ViewController@index');
		Route::get('/anggaran', 'Keuangan\Anggaran\ViewController@index');
		Route::get('/faktur', 'Keuangan\Faktur\ViewController@index');
		Route::get('/gaji', 'Keuangan\Gaji\ViewController@index');
		Route::get('/jasamedis', 'Keuangan\JasaMedis\ViewController@index');
		Route::get('/layanan', 'Keuangan\Layanan\ViewController@index');
		Route::get('/jasa-medis', 'Keuangan\JasaMedis\ViewController@index');
		Route::get('/laporan', 'Keuangan\Laporan\ViewController@index');

		Route::get('/pemasukan', 'Keuangan\Pemasukan\ViewController@index')->name('pemasukan');
		Route::get('/pemasukan/baru', 'Keuangan\Pemasukan\ViewController@create');
		Route::get('/pemasukan/baru2', 'Keuangan\Pemasukan\ViewController@create2');
		Route::get('/pemasukan/history', 'Keuangan\Pemasukan\ViewController@history');
		Route::get('/pemasukan/history2', 'Keuangan\Pemasukan\ViewController@history2');
		Route::post('/pemasukan/gethistory2', 'Keuangan\Pemasukan\ReadController@gethistory2');
		Route::get('/pemasukan/edit/{id}', 'Keuangan\Pemasukan\ViewController@edit');
		Route::get('/pemasukan/edit2/{id}', 'Keuangan\Pemasukan\ViewController@edit2');
		Route::get('/pemasukan/kwitansi/{id}','Keuangan\Pemasukan\ViewController@kwitansi')->name('pemasukan_kwitansi');
		Route::get('/pemasukan/kwitansi/create/{id}','Keuangan\Pemasukan\KwitansiController@create')->name('pemasukan_kwitansi_create');
		Route::get('/pemasukan/{id}', 'Keuangan\Pemasukan\ViewController@single');
		Route::get('/pemasukan/{id}/print-nota', 'Keuangan\Pemasukan\ViewController@printNota');
		Route::get('/pemasukan/{id}/print-kwitansi', 'Keuangan\Pemasukan\ViewController@printKwitansi');
		Route::get('/pemasukan/{id}/print-rekap', 'Keuangan\Pemasukan\ViewController@printRekap');
		
		Route::get('/pengeluaran', 'Keuangan\Pengeluaran\ViewController@index')->name('pengeluaran');
		Route::get('/pengeluaran/baru', 'Keuangan\Pengeluaran\ViewController@create');
		Route::get('/pengeluaran/history', 'Keuangan\Pengeluaran\ViewController@history');
		Route::get('/pengeluaran/{id}', 'Keuangan\Pengeluaran\ViewController@single');
		Route::get('/pengeluaran/edit/{id}', 'Keuangan\Pengeluaran\ViewController@edit');
		Route::get('/pengeluaran/kwitansi/{id}','Keuangan\Pengeluaran\ViewController@kwitansi')->name('pengeluaran_kwitansi');
		Route::get('/pengeluaran/kwitansi/create/{id}','Keuangan\Pengeluaran\KwitansiController@create')->name('pengeluaran_kwitansi_create');

		Route::get('/tagihan-belum-checkout', 'Keuangan\TagihanBelumCheckout\ViewController@index');

		Route::get('/piutang', 'Keuangan\Piutang\ViewController@index');
		Route::get('/piutang/baru', 'Keuangan\Piutang\ViewController@create');
		Route::get('/piutang/histori', 'Keuangan\Piutang\ViewController@histori');
		Route::get('/piutang/rekap-penagihan', 'Keuangan\Piutang\ViewController@rekapPenagihan');
		Route::get('/piutang/rekap-penagihan/update-status', 'Keuangan\Piutang\PostController@updateStatusVclaim');
		Route::get('/piutang/rekap-penagihan/download-all', 'Keuangan\Piutang\ViewController@downloadAll');
		Route::get('/piutang/rekap-penagihan/print-daftar-penagihan', 'Keuangan\Piutang\ViewController@printDaftarPenagihan');
		Route::get('/piutang/rekap-penagihan/print-all/{id}', 'Keuangan\Piutang\ViewController@printAllByPiutang');
		Route::get('/piutang/rekap-penagihan/print-surat-pengantar', 'Keuangan\Piutang\ViewController@printSuratPengantar');
		Route::get('/piutang/rekap-penagihan/print-perincian-biaya', 'Keuangan\Piutang\ViewController@printPerincianBiaya');
		Route::get('/piutang/rekap-penagihan/print-kwitansi-satuan', 'Keuangan\Piutang\ViewController@printKwitansiSatuan');
		Route::get('/piutang/rekap-penagihan/print-kwitansi-total', 'Keuangan\Piutang\ViewController@printKwitansiTotal');
		Route::get('/piutang/rekap-penagihan/print-resume-medis', 'Keuangan\Piutang\ViewController@printResumeMedis');
		Route::get('/piutang/rekap-penagihan/print-bukti-ranap', 'Keuangan\Piutang\ViewController@printLayananRanap');
		Route::get('/piutang/rekap-penagihan/print-inacbg', 'Keuangan\Piutang\ViewController@printINACBG');
		Route::get('/piutang/rekap-penagihan/print-sep', 'Keuangan\Piutang\ViewController@printSep');
		Route::get('/piutang/rekap-penagihan/print-opname', 'Keuangan\Piutang\ViewController@printOpname');
		Route::get('/piutang/rekap-penagihan/print-operasi', 'Keuangan\Piutang\ViewController@printOperasi');
		Route::get('/piutang/rekap-penagihan/print-resep', 'Keuangan\Piutang\ViewController@printResep');
		Route::get('/piutang/rekap-penagihan/print-hasil/{penunjang}', 'Keuangan\Piutang\ViewController@printHasilPenunjang');
		Route::get('/piutang/rekap-penagihan/print-formulir/{penunjang}', 'Keuangan\Piutang\ViewController@printFormulirPenunjang');
		Route::get('/piutang/rekap-penagihan/print-perincian-biaya-sesuai-kelas', 'Keuangan\Piutang\ViewController@printPerincianBiayaSesuaiKelas');
		Route::get('/piutang/rekap-penagihan/print-hasil-usg', 'Keuangan\Piutang\ViewController@printHasilUSG');
		Route::get('/piutang/rekap-penagihan/print-form-obat-khusus', 'Keuangan\Piutang\ViewController@printFormObatKhusus');
		
		
		Route::get('/piutang/{id}', 'Keuangan\Piutang\ViewController@single');
		Route::get('/piutang/{id}/edit', 'Keuangan\Piutang\ViewController@edit');
		Route::post('/piutang/{id}/split', 'Keuangan\Piutang\PostController@split');
		Route::get('/piutang/{id}/split-revoke', 'Keuangan\Piutang\PostController@revokeSplit');
		Route::get('/piutang/{id}/print', 'Keuangan\Piutang\ViewController@printSingle');
		Route::get('/piutang/{id}/print-lokasi', 'Keuangan\Piutang\ViewController@printLokasi');
		Route::get('/piutang/{id}/print-rekap', 'Keuangan\Piutang\ViewController@printRekap');
		Route::get('/piutang/{id}/print-klaim', 'Keuangan\Piutang\ViewController@printKlaim');
		Route::get('/piutang/{id}/print-inacbg', 'Keuangan\Piutang\ViewController@printRekapInacbg');
		Route::post('/piutang/tagihkan', 'Keuangan\Piutang\PostController@tagihkan');
		Route::get('/piutang/referensi/{id}', 'Keuangan\Piutang\ViewController@referensi');

		Route::get('/po', 'Keuangan\PO\ViewController@index');
		Route::get('/po/baru', 'Keuangan\PO\ViewController@create');
		Route::get('/po/history', 'Keuangan\PO\ViewController@history');
		Route::get('/po/{id}', 'Keuangan\PO\ViewController@single');
		Route::get('/po/edit/{id}', 'Keuangan\PO\ViewController@edit');
		Route::post('/po/{id}/print', 'Keuangan\PO\PostController@print');

		Route::get('/penerimaan', 'Keuangan\Utang\ViewController@index');
		Route::get('/penerimaan/baru', 'Keuangan\Utang\ViewController@create');
		Route::get('/penerimaan/history', 'Keuangan\Utang\ViewController@history');
		Route::get('/penerimaan/{id}', 'Keuangan\Utang\ViewController@single');
		Route::get('/penerimaan/edit/{id}', 'Keuangan\Utang\ViewController@edit');

		Route::get('/berkas-pengadaan', 'Keuangan\PJK\ViewController@index');
		Route::get('/berkas-pengadaan/baru', 'Keuangan\PJK\ViewController@create');
		Route::get('/berkas-pengadaan/history', 'Keuangan\PJK\ViewController@history');
		Route::get('/berkas-pengadaan/{id}', 'Keuangan\PJK\ViewController@single');
		Route::get('/berkas-pengadaan/edit/{id}', 'Keuangan\PJK\ViewController@edit');

		Route::get('/spp', 'Keuangan\SPP\ViewController@index');
		Route::get('/spp/baru', 'Keuangan\SPP\ViewController@create');
		Route::get('/spp/history', 'Keuangan\SPP\ViewController@history');
		Route::get('/spp/{id}', 'Keuangan\SPP\ViewController@single');
		Route::get('/spp/edit/{id}', 'Keuangan\SPP\ViewController@edit');
		Route::get('/spp/print/{id}', 'Keuangan\SPP\ViewController@print');
		Route::post('/spp/print', 'Keuangan\SPP\PostController@printWithTTD');

		Route::get('/verifikasi', 'Keuangan\Uji\ViewController@index');
		Route::get('/verifikasi/baru', 'Keuangan\Uji\ViewController@create');
		Route::post('/verifikasi/baru', 'Keuangan\Pengeluaran\PostController@submit');
		Route::get('/verifikasi/print/{id}', 'Keuangan\Uji\ViewController@print');
		Route::get('/verifikasi/history', 'Keuangan\Uji\ViewController@history');
		Route::get('/verifikasi/{id}', 'Keuangan\Uji\ViewController@single');
		Route::get('/verifikasi/edit/{id}', 'Keuangan\Uji\ViewController@edit');
		Route::post('/verifikasi/edit/{id}', 'Keuangan\Pengeluaran\EditController@editPajak');

		Route::get('/transaksi-file', 'Keuangan\TransaksiFile\ViewController@index');
		Route::get('/transaksi-file/baru', 'Keuangan\TransaksiFile\ViewController@kirimBaru');
		Route::post('/transaksi-file/baru', 'Keuangan\TransaksiFile\PostController@send');
		Route::post('/transaksi-file/selesai', 'Keuangan\TransaksiFile\PostController@done');
		Route::post('/transaksi-file/konfirmasi', 'Keuangan\TransaksiFile\PostController@confirmSingle');
		Route::post('/transaksi-file/konfirmasi/cancel', 'Keuangan\TransaksiFile\PostController@cancelConfirmSingle');
		Route::post('/transaksi-file/konfirmasi/batch', 'Keuangan\TransaksiFile\PostController@confirmBatch');
		Route::post('/transaksi-file/konfirmasi/batch/cancel', 'Keuangan\TransaksiFile\PostController@cancelConfirmBatch');
		Route::post('/transaksi-file/kirim/cancel', 'Keuangan\TransaksiFile\PostController@cancelSendSingle');
		Route::post('/transaksi-file/kirim/batch/cancel', 'Keuangan\TransaksiFile\PostController@cancelSendBatch');
		Route::get('/transaksi-file/{utang_id}', 'Keuangan\TransaksiFile\ViewController@single');

		
		Route::get('/deposit', 'Keuangan\Deposit\ViewController@index');
		Route::get('/deposit/baru', 'Keuangan\Deposit\ViewController@create');
		Route::post('/deposit/baru', 'Keuangan\Deposit\PostController@create');
		Route::get('/deposit/single/{id}', 'Keuangan\Deposit\ViewController@single');
		Route::post('/deposit-log/delete', 'Keuangan\Deposit\PostController@delete');
		Route::get('/deposit-log/print/{id}', 'Keuangan\Deposit\ViewController@logPrint');


		
		Route::get('/tarif', 'Keuangan\Tarif\ViewController@index')->name('tarif');
		Route::get('/tarif/admin/update-tag', 'Keuangan\Tarif\ViewController@adminUpdateIndex');
		Route::get('/tarif/admin/update-tag/{min}/{max}', 'Keuangan\Tarif\EditController@updateMasterTag');
		Route::get('/tarif/admin/word-count', 'Keuangan\Tarif\ViewController@getStopword');


		Route::get('/tarif/baru', 'Keuangan\Tarif\ViewController@create')->name('tarif_baru');
		Route::get('/tarif/{id}', 'Keuangan\Tarif\ViewController@single');
		Route::post('/tarif/{id}/setting-urikkes', 'Keuangan\Tarif\PostController@settingUrikkes');
		Route::post('/tarif/baru', 'Keuangan\Tarif\PostController@create');
		Route::post('/tarif/baru/create', 'Keuangan\Tarif\CreateController@create')->name('tarif_baru_create');
		Route::get('/tarif/edit/{id}', 'Keuangan\Tarif\ViewController@edit');
		Route::post('/tarif/edit/{id}', 'Keuangan\Tarif\EditController@edit');
		Route::get('/gettarif', 'Keuangan\Tarif\ReadController@gettarif')->name('datatable/getdata');;

		Route::get('/kwitansi','Keuangan\Kwitansi\ViewController@index')->name('kwitansi');
		Route::get('/kwitansi/history','Keuangan\Kwitansi\ViewController@history')->name('kwitansi_history');
		Route::get('/kwitansi/history/getDate','Keuangan\Kwitansi\ViewController@getDate')->name('kwitansi_getDate');
		Route::get('/kwitansi/history/showDate/{tanggal}','Keuangan\Kwitansi\ViewController@showDate')->name('kwitansi_showDate');
		Route::get('/kwitansi/baru','Keuangan\Kwitansi\ViewController@create')->name('kwitansi_baru');
		Route::get('/kwitansi/baru/create','Keuangan\Kwitansi\CreateController@create')->name('kwitansi_create');
		Route::get('/kwitansi/{id}', 'Keuangan\Kwitansi\ViewController@single')->name('kwitansi_single');
		Route::get('/kwitansi/ubah/{id}','Keuangan\Kwitansi\ViewController@edit')->name('kwitansi_ubah');
		Route::get('/kwitansi/ubah/edit/{id}', 'Keuangan\Kwitansi\EditController@edit')->name('kwitansi_edit');
		Route::get('/kwitansi/delete/{id}', 'Keuangan\Kwitansi\EditController@delete')->name('kwitansi_delete');
		Route::get('/kwitansi/print/{id}', 'Keuangan\Kwitansi\TemplateController@createWordKwitansi')->name('kwitansi_print');

		Route::get('/laporan/riwayat-pemasukan-pasien', 'Keuangan\Laporan\ViewController@riwayatPemasukanPasien');
		Route::get('/laporan/riwayat-pemasukan-pasien/cetak', 'Keuangan\Laporan\PostController@riwayatPemasukanPasien');
		Route::get('/laporan/riwayat-pemasukan-pasien/cetak-mingguan', 'Keuangan\Laporan\PostController@riwayatPemasukanPasienMingguan');
		Route::get('/laporan/riwayat-pemasukan-pasien/cetak-harian', 'Keuangan\Laporan\PostController@riwayatPemasukanPasienHarian');

		// Route::get('/laporan/buku-utang', 'Keuangan\Laporan\ViewController@bukuUtang');
		// Route::get('/laporan/buku-utang/cetak', 'Keuangan\Laporan\PostController@bukuUtang');

		// Route::get('/laporan/buku-piutang', 'Keuangan\Laporan\ViewController@bukuPiutang');
		// Route::get('/laporan/buku-piutang/cetak', 'Keuangan\Laporan\PostController@bukuPiutang');

		Route::get('/laporan/pemasukan-pengeluaran', 'Keuangan\Laporan\ViewController@PemasukanPengeluaran');
		Route::get('/laporan/pemasukan-pengeluaran/cetak', 'Keuangan\Laporan\PemasukanPengeluaran\PostController@PemasukanPengeluaran');

		Route::get('/laporan/piutang-per-perusahaan', 'Keuangan\Laporan\ViewController@piutangPerPerusahaan');
		Route::get('/laporan/piutang-per-perusahaan/cetak', 'Keuangan\Laporan\PiutangPerPerusahaan\PostController@cetak');

		// Route::get('/laporan/buku-kas', 'Keuangan\Laporan\ViewController@bukuKas');
		// Route::get('/laporan/buku-kas/cetak', 'Keuangan\Laporan\PostController@bukuKas');

		// Route::get('/laporan/terima-keluar', 'Keuangan\Laporan\ViewController@terimaKeluar');
		// Route::get('/laporan/terima-keluar/tahunan/cetak', 'Keuangan\Laporan\PostController@terimaKeluarTahunan');
		// Route::get('/laporan/terima-keluar/bulanan/cetak', 'Keuangan\Laporan\PostController@terimaKeluarBulanan');
		
		Route::get('/laporan/rekap-pengeluaran', 'Keuangan\Laporan\ViewController@rekapPengeluaran');
		Route::get('/laporan/rekap-pengeluaran/cetak', 'Keuangan\Laporan\PostController@rekapPengeluaran');
		Route::get('/laporan/rekap-pengeluaran/laporanpjk', 'Keuangan\Laporan\PostController@laporanPJK');
		Route::get('/laporan/rekap-pengeluaran/laporanbk', 'Keuangan\Laporan\PostController@laporanBK');
		Route::get('/laporan/rekap-pengeluaran/laporanspp', 'Keuangan\Laporan\PostController@laporanSPP');
		Route::get('/laporan/rekap-pengeluaran/laporanpajak', 'Keuangan\Laporan\PostController@laporanPajak');

		Route::get('/laporan/pemasukan-harian', 'Keuangan\Laporan\ViewController@pemasukanHarian');
		Route::get('/laporan/pemasukan-harian/cetak', 'Keuangan\Laporan\PostController@pemasukanHarian');

		Route::get('/laporan/pengeluaran-pjk', 'Keuangan\Laporan\ViewController@pengeluaranPJK');
		Route::get('/laporan/pengeluaran-pjk/laporanpjk', 'Keuangan\Laporan\PostController@laporanPJK');

		Route::get('/laporan/pengeluaran-spp', 'Keuangan\Laporan\ViewController@pengeluaranSPP');
		Route::get('/laporan/pengeluaran-spp/laporanspp', 'Keuangan\Laporan\PostController@laporanSPP');
		Route::get('/laporan/pengeluaran-spp/laporanspp-detail', 'Keuangan\Laporan\PostController@laporanSPPDetail');

		Route::get('/laporan/pengeluaran-uji', 'Keuangan\Laporan\ViewController@pengeluaranUji');
		Route::get('/laporan/pengeluaran-uji/laporanuji', 'Keuangan\Laporan\PostController@laporanUJI');

		Route::get('/laporan/pengeluaran-bk', 'Keuangan\Laporan\ViewController@pengeluaranBK');
		Route::get('/laporan/pengeluaran-bk/laporanbk', 'Keuangan\Laporan\PostController@laporanBK');
		Route::get('/laporan/pengeluaran-bk/laporanbk-detail', 'Keuangan\Laporan\PostController@laporanBKDetail');

		Route::get('/laporan/transaksi-file', 'Keuangan\Laporan\ViewController@pengeluaranTransaksiFile');
		Route::get('/laporan/transaksi-file/print', 'Keuangan\Laporan\PostController@laporanTransaksiFile');
		
		Route::get('/laporan/po', 'Keuangan\Laporan\ViewController@pengeluaranPO');
		Route::get('/laporan/po/cetak', 'Keuangan\Laporan\PostController@laporanPO');

		// Remunerasi
		Route::get('/laporan/remunerasi', 'Keuangan\Laporan\ViewController@remunerasi');
		Route::get('/laporan/remunerasi/print-laporan-kinerja-berdasarkan-tagihan', 'Keuangan\Laporan\RemunerasiController@laporanKinerjaBerdasarkanTagihan');
		Route::get('/laporan/remunerasi/cetak-mingguan', 'Keuangan\Laporan\Remunerasi\PostController@LaporanRemunerasiMingguan');
		Route::get('/laporan/remunerasi/cetak-bulanan', 'Keuangan\Laporan\Remunerasi\PostController@LaporanRemunerasiBulanan');

		Route::get('/laporan/pendapatan-unit', 'Keuangan\Laporan\ViewController@pendapatanUnit');
		Route::get('/laporan/rekap-klaim', 'Keuangan\Laporan\ViewController@rekapKlaim');

		Route::get('/pengaturan','Keuangan\Pengaturan\ViewController@index');
		
		Route::get('/pengaturan/rekanan', 'Keuangan\Rekanan\ViewController@index');	
		Route::get('/pengaturan/rekanan/baru','Keuangan\Rekanan\ViewController@new');
		Route::get('/pengaturan/rekanan/edit/{id}','Keuangan\Rekanan\ViewController@edit');
		Route::post('/pengaturan/rekanan/submit','Keuangan\Rekanan\PostController@submit');

		Route::get('/pengaturan/kategori', 'Keuangan\Kategori\ViewController@index');
		Route::get('/pengaturan/kategori/baru','Keuangan\Kategori\ViewController@new');
		Route::post('/pengaturan/kategori/baru/simpan','Keuangan\Kategori\PostController@add');
		Route::get('/pengaturan/kategori/delete/{id}','Keuangan\Kategori\PostController@delete');
		Route::get('/pengaturan/kategori/edit/{id}','Keuangan\Kategori\ViewController@edit');
		Route::get('/pengaturan/kategori/{id}', 'Keuangan\Kategori\ViewController@single');

		Route::get('/pengaturan/jenis-pemasukan', 'Keuangan\Kategori\JenisPemasukan\ViewController@index');
		Route::post('/pengaturan/jenis-pemasukan/simpan','Keuangan\Kategori\JenisPemasukan\PostController@add');
		Route::post('/pengaturan/jenis-pemasukan/delete','Keuangan\Kategori\JenisPemasukan\PostController@delete');

		Route::get('/pengaturan/akun', 'Keuangan\Akun\ViewController@index');
		Route::post('/pengaturan/akun/baru', 'Keuangan\Akun\CreateController@create');
		Route::post('/pengaturan/akun/edit', 'Keuangan\Akun\EditController@edit');
		Route::post('/pengaturan/akun/delete', 'Keuangan\Akun\DeleteController@delete');

		Route::get('/pengaturan/ttd', 'Keuangan\TTD\ViewController@index');
		Route::post('/pengaturan/ttd/baru', 'Keuangan\TTD\CreateController@create');
		Route::post('/pengaturan/ttd/edit', 'Keuangan\TTD\EditController@edit');
		Route::post('/pengaturan/ttd/delete', 'Keuangan\TTD\DeleteController@delete');

		Route::get('/tarif_master/get_lab', 'Keuangan\TarifMaster\ReadController@getFromLab');
		Route::get('/penagihan', 'Keuangan\Penagihan\ViewController@index');
		Route::post('/penagihan/add', 'Keuangan\Penagihan\PostController@addPiutang');
		Route::get('/penagihan/{slug}', 'Keuangan\Penagihan\ViewController@single');
		Route::post('/penagihan/{slug}', 'Keuangan\Penagihan\PostController@kirimPenagihan');
		Route::get('/penagihan/{slug}/print/surat-klaim-fraud', 'Keuangan\Penagihan\ViewController@printKlaimFraud');
		Route::get('/penagihan/{slug}/print/surat-tanggung-jawab-mutlak', 'Keuangan\Penagihan\ViewController@printTanggungJawabMutlak');
		Route::get('/penagihan/{slug}/download-laporan', 'Keuangan\Penagihan\ViewController@downloadLaporan');
		Route::post('/penagihan/{slug}/edit-nomor-surat', 'Keuangan\Penagihan\PostController@updateNomorSurat');
		Route::get('/penagihan/{slug}/bpjs/{kategori_bpjs}', 'Keuangan\Penagihan\ViewController@detailBpjs');
		Route::post('/penagihan/{slug}/bpjs/{kategori_bpjs}', 'Keuangan\Penagihan\PostController@updateDetailBpjs');
		Route::get('/penagihan/{slug}/delete', 'Keuangan\Penagihan\PostController@deletePaketPenagihan');
		Route::get('/penagihan/{slug}/bpjs/{kategori_bpjs}/delete-detail-paket/{pivot_id}', 'Keuangan\Penagihan\PostController@deleteDetailPaketPenagihan');

		Route::get('/penagihan-siap', 'Keuangan\Penagihan\ViewController@indexSiap');
		Route::post('/penagihan-siap/add', 'Keuangan\Penagihan\PostController@addPiutang');
		Route::post('/penagihan-siap/delete', 'Keuangan\Penagihan\DeleteController@deletePenagihan');
		Route::get('/penagihan-siap/{slug}', 'Keuangan\Penagihan\ViewController@pembayaran');
		Route::post('/penagihan-siap/{slug}', 'Keuangan\Penagihan\PostController@pembayaran');
		Route::get('/penagihan-siap/{slug}/bpjs/{penagihan_bpjs_id}', 'Keuangan\Penagihan\ViewController@detailSiapBpjs');
		Route::post('/penagihan-siap/{slug}/bpjs/{penagihan_bpjs_id}', 'Keuangan\Penagihan\PostController@TagihkanDetailBpjs');
		Route::post('/penagihan-siap/{slug}/bpjs/{penagihan_bpjs_id}/edit-fpk', 'Keuangan\Penagihan\PostController@updateFPK'); #tandai hapus
		Route::post('/penagihan-siap/{slug}/edit-fpk', 'Keuangan\Penagihan\PostController@updateFPKPaketPenagihan');
        Route::get('/penagihan-download/template/umbal', 'Keuangan\Penagihan\ViewController@downloadTemplateUmbal');

		Route::get('/paket-pemasukan', 'Keuangan\PaketPemasukan\ViewController@index');
		Route::get('/paket-pemasukan/{slug}', 'Keuangan\PaketPemasukan\ViewController@single');
		Route::get('/paket-pemasukan/{slug}/pemasukan/{pemasukan_id}', 'Keuangan\PaketPemasukan\ViewController@detail');

		Route::group(['prefix' => '/penagihan/{slug}/print'], function () {
			Route::post('/meninggal-ritl', 'Keuangan\Penagihan\ViewController@printMeninggalRITL');
			Route::post('/meninggal-rjtl', 'Keuangan\Penagihan\ViewController@printMeninggalRJTL');
			Route::post('/ceklist-klaim-bpjs', 'Keuangan\Penagihan\ViewController@printCeklistKlaimBpjs');
		});
	});
});


Route::group(['prefix' => 'api/keuangan'], function(){
	Route::get('/layanan', 'Keuangan\Layanan\ReadController@get');
	
	Route::get('/tarif', 'Keuangan\Tarif\ReadController@get');
	Route::get('/tarif/get-single', 'Keuangan\Tarif\ReadController@APIGetSingle');
	Route::get('/tarif/get-master', 'Keuangan\Tarif\ReadController@APIGetSingleMaster');
	Route::get('/tarif/get-inacbg', 'Keuangan\Tarif\ReadController@APIGetINACBG');
	Route::get('/tarif/get-sister', 'Keuangan\Tarif\ReadController@APIGetSister');
	Route::get('/tarif/search', 'Keuangan\Tarif\ReadController@apiSearch');
	Route::get('/tarif/searchtariftindakan', 'Keuangan\Tarif\ReadController@searchTarifTindakan');
	Route::get('/tarif/searchkategori', 'Keuangan\Tarif\ReadController@searchTarifLayanan');
	Route::post('/tarif/getalldetail', 'Keuangan\Tarif\ReadController@getAllDetail');
	Route::post('/tarif/getdetail', 'Keuangan\Tarif\ReadController@getDetail');
	Route::post('/tarif/gettarifbydept', 'Keuangan\Tarif\ReadController@getTarifByDept');
	Route::post('/tarif/getdeptbytarifid', 'Keuangan\Tarif\ReadController@getDeptByTarifId');

	Route::get('/tarif/getkategori', 'Keuangan\Tarif\ReadController@getKategori');
	Route::post('/tarif/getkategorisub', 'Keuangan\Tarif\ReadController@getKategoriSub');
	Route::post('/tarif/baru', 'Keuangan\Tarif\PostController@apiSubmit');
	Route::post('/tarif/delete', 'Keuangan\Tarif\DeleteController@delete');

	Route::get('/dashboard/pemasukan', 'Keuangan\Dashboard\ReadController@index');
	Route::post('/pemasukan/baru', 'Keuangan\Pemasukan\PostController@apiSubmit');
	Route::post('/pemasukan/edit', 'Keuangan\Pemasukan\PostController@apiSubmit');
	Route::post('/pemasukan/delete', 'Keuangan\Pemasukan\DeleteController@delete');
	Route::post('/pemasukan/getbydate', 'Keuangan\Pemasukan\ReadController@getByDate');

	Route::post('/pengeluaran/baru', 'Keuangan\Pengeluaran\PostController@apiSubmit');
	Route::post('/pengeluaran/edit', 'Keuangan\Pengeluaran\PostController@apiSubmit');
	Route::post('/pengeluaran/delete', 'Keuangan\Pengeluaran\DeleteController@delete');
	Route::post('/pengeluaran/getbydate', 'Keuangan\Pengeluaran\ReadController@getByDate');

	Route::post('/piutang/baru', 'Keuangan\Piutang\PostController@apiSubmit');
	Route::post('/piutang/edit', 'Keuangan\Piutang\PostController@apiSubmit');
	Route::post('/piutang/delete', 'Keuangan\Piutang\DeleteController@delete');
	Route::get('/piutang/getbyfilter', 'Keuangan\Piutang\ReadController@getByFilter');
	Route::post('/piutang/pay', 'Keuangan\Piutang\PostController@pay');
	Route::post('/piutang/multiplepay', 'Keuangan\Piutang\PostController@multiplePay');
	Route::post('/piutang/split', 'Keuangan\Piutang\PostController@split');
	Route::get('/piutang/download-zip-piutang', 'Keuangan\Piutang\ViewController@downloadPenagihanZipFile');
	Route::get('/piutang/tunai/status/{piutang_id}', 'Keuangan\Piutang\ReadController@getTunaiStatus');

	Route::get('/piutang/histori/getbyfilter', 'Keuangan\Piutang\ReadController@historiGetByFilter');

	Route::get('/utang/{id}', 'Keuangan\Utang\ReadController@getPJKForSPP');
	Route::post('/utang/baru', 'Keuangan\Utang\PostController@apiSubmit');
	Route::post('/utang/edit', 'Keuangan\Utang\PostController@apiSubmit');
	Route::post('/utang/delete', 'Keuangan\Utang\DeleteController@delete');
	Route::post('/utang/getbyfilterpenerimaan', 'Keuangan\Utang\ReadController@getByFilterPenerimaan');
	Route::post('/utang/getbyfilterPJK', 'Keuangan\Utang\ReadController@getByFilterPJK');
	Route::post('/utang/getbyfilterSPP', 'Keuangan\Utang\ReadController@getByFilterSPP');
	Route::post('/utang/pay', 'Keuangan\Utang\PostController@pay');

	Route::get('/po/admin-import-data', 'Keuangan\PO\ReadController@adminImportData');
	Route::post('/po/get', 'Keuangan\PO\ReadController@get');
	Route::get('/po/getForPenerimaan', 'Keuangan\PO\ReadController@getForPenerimaan');
	Route::get('/po/{id}', 'Keuangan\PO\ReadController@getSingle');
	Route::post('/po/baru', 'Keuangan\PO\PostController@apiSubmit');
	Route::post('/po/edit', 'Keuangan\PO\PostController@apiSubmit');
	Route::post('/po/delete', 'Keuangan\PO\DeleteController@delete');

	Route::post('/spp/baru', 'Keuangan\SPP\PostController@apiSubmit');
	Route::post('/spp/edit', 'Keuangan\SPP\PostController@apiSubmit');

	Route::post('/pjk/baru', 'Keuangan\PJK\PostController@apiSubmit');
	Route::post('/pjk/edit', 'Keuangan\PJK\PostController@apiSubmit');
	Route::post('/pjk/delete', 'Keuangan\Utang\DeleteController@deletePJK');
	Route::get('/pjk/getforpjk', 'Keuangan\Utang\ReadController@getForPJK');

	Route::post('/transaksi-file/get-table', 'Keuangan\TransaksiFile\ReadController@getTable');
	Route::get('/transaksi-file/seed-file/{lokasi}', 'Keuangan\TransaksiFile\ReadController@getFileDipegang');

	Route::get('/jasa-medis/get/index', 'Keuangan\JasaMedis\ReadController@index');
	Route::post('/jasa-medis/get/index', 'Keuangan\JasaMedis\ReadController@index');
	Route::post('/jasa-medis/multiplepay', 'Keuangan\JasaMedis\PostController@multiplepay');

	Route::get('/akun/get', 'Keuangan\Akun\ReadController@get');

	Route::get('/perusahaan/get', 'Keuangan\Perusahaan\ReadController@get');

	Route::get('/pengaturan/kategori/get','Keuangan\Kategori\ReadController@allKategori');
	Route::get('/pengaturan/jenis-pemasukan/get','Keuangan\Kategori\JenisPemasukan\ReadController@getDatatables');
	Route::get('/pengaturan/rekanan/get','Keuangan\Perusahaan\ReadController@getIndex');
	Route::post('/pengaturan/rekanan/delete','Keuangan\Perusahaan\DeleteController@delete');
	Route::get('/perusahaan/search-select2','Keuangan\Perusahaan\ReadController@searchSelect2');
	Route::get('/penagihan-siap/getbyfilter', 'Keuangan\Penagihan\ReadController@getSiapByFilter');
	Route::get('/penagihan/getbyfilter', 'Keuangan\Penagihan\ReadController@getByFilter');
	Route::get('/penagihan/piutang-pivot', 'Keuangan\Penagihan\ReadController@getPiutangPivot');
	Route::post('/penagihan/{slug}/import-file', 'Keuangan\Penagihan\PostController@importFilePenagihanBPJS');
	Route::post('/penagihan/import-file-umbal', 'Keuangan\Penagihan\PostController@importFileUmbal');
	Route::post('/penagihan/import-file-fpk', 'Keuangan\Penagihan\PostController@importFileFPK');
	
	Route::get('/paket-pemasukan/getbydate', 'Keuangan\PaketPemasukan\ReadController@getByDate');
	// Route::post('/kwitansi/delete', 'Keuangan\Kwitansi\DeleteController@delete');
	// Route::post('/kwitansi/getbydate', 'Keuangan\Kwitansi\ReadController@getByDate');

	Route::get('/penagihan', 'Keuangan\PaketPemasukan\ViewController@paketPenagihanDatatable');
	Route::post('/penagihan/change-status-fpk', 'Keuangan\Piutang\PostController@changeStatusFPK');
	Route::post('/penagihan/delete-piutang', 'Keuangan\Piutang\PostController@deletePiutangPaket');
	Route::post('/penagihan/konfirmasi-fpk', 'Keuangan\Penagihan\PostController@konfirmasiFPK');
	Route::post('/penagihan/update-status-fpk', 'Keuangan\Penagihan\PostController@updateStatusFPK');
	
	Route::get('/rekap-penagihan', 'Keuangan\Penagihan\ViewController@datatableRekapPenagihan');

	Route::get('/tagihan-belum-checkout/datatable', 'Keuangan\TagihanBelumCheckout\ViewController@getDataTable');

	Route::group(['prefix' => '/laporan'], function(){
		Route::get('pendapatan-unit/get-total-data', 'Keuangan\Laporan\PendapatanUnitController@getTotalData');
		Route::get('pendapatan-unit/get-data', 'Keuangan\Laporan\PendapatanUnitController@getData');

        Route::get('rekap-klaim/get-total-data', 'Keuangan\Laporan\RekapKlaimController@getTotalData');
        Route::get('rekap-klaim/get-data', 'Keuangan\Laporan\RekapKlaimController@getData');
	});


});

?>
