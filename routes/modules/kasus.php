<?php
Route::group(['prefix' => '/kasus/{nomor_kasus}', 'middleware' => 'kasus-optimize'], function () {
	Route::get('/', 'Kasus\Kasus\ViewController@identitas');
	Route::get('/datamedis', 'Kasus\Kasus\ViewController@identitas');
	Route::post('/datamedis/identitas/update', 'Kasus\Identitas\EditController@updateIdentitas');
	Route::post('/datamedis/identitas/update-khusus', 'Kasus\Identitas\PostController@updateKhusus');
	Route::post('/datamedis/identitas/medis/update', 'Kasus\Identitas\EditController@updateIdentitasMedis');
	Route::post('/datamedis/identitas/rekammedis/update', 'Kasus\Identitas\EditController@updateNomorRekamMedis');
	Route::post('/datamedis/identitas/data/update', 'Kasus\Identitas\EditController@updateFromRekamMedis');

	Route::get('/datamedis/identitas/pembayaran/update', 'Kasus\Identitas\ViewController@updatePembayaran');
	Route::post('/datamedis/identitas/pembayaran/update', 'Kasus\Identitas\PostController@updatePembayaran');

	Route::post('/datamedis/cppt/create', 'Kasus\CPPT\PostController@createNewCPPT');
	Route::post('/datamedis/cppt/edit', 'Kasus\CPPT\PostController@editCPPT');
	Route::post('/datamedis/cppt/delete', 'Kasus\CPPT\PostController@deleteCPPT');
	Route::post('/datamedis/cppt/deletefile', 'Kasus\CPPT\PostController@deletefileCPPT');
	Route::post('/datamedis/cppt/override', 'Kasus\CPPT\PostController@overrideCPPT');
	Route::get('/datamedis/cppt/print-all', 'Kasus\CPPT\ViewController@printCPPTAll');
	Route::get('/datamedis/cppt/print-sebagian', 'Kasus\CPPT\ViewController@printCPPTSebagian');
	Route::get('/datamedis/cppt/print/{id}', 'Kasus\CPPT\ViewController@printCPPT');
	Route::get('/datamedis/cppt/print-rapt/{id}', 'Kasus\CPPT\ViewController@printRAPT');
	Route::get('/datamedis/cppt/histori', 'Kasus\CPPT\ReadController@historiCPPT');
	Route::post('/datamedis/cppt/save/{jenis}', 'Kasus\CPPT\PostController@saveCPPT');
	Route::post('/datamedis/cppt/review-post', 'Kasus\CPPT\PostController@reviewCPPT');
	Route::post('/covid-19/update-status', 'Kasus\Covid19Status\PostController@updateStatus');

	Route::post('/datamedis/diagnosis/create', 'Kasus\Diagnosis\CreateController@createNewDiagnosis');
	Route::post('/datamedis/diagnosis/delete', 'Kasus\Diagnosis\PostController@delete');
	Route::post('/datamedis/diagnosis/toggle-utama', 'Kasus\Diagnosis\PostController@toggleUtama');
	Route::post('/datamedis/diagnosis/update-kanker-stadium', 'Kasus\Diagnosis\PostController@updateKankerStadium');
	Route::get('/datamedis/diagnosis/histori', 'Kasus\Diagnosis\ReadController@historiDiagnosis');
	Route::get('/datamedis/diagnosis/{diagnosis_id}/{type}', 'Kasus\Diagnosis\PostController@updateType');


	Route::post('/datamedis/tindakan/create', 'Kasus\Tindakan\CreateController@createNewTindakan');
	Route::post('/datamedis/tindakan/create-manual', 'Kasus\Tindakan\CreateController@createTindakanManual');

	Route::post('/datamedis/tindakan/delete', 'Kasus\Tindakan\DeleteController@delete');
	Route::post('/datamedis/tindakan/edit', 'Kasus\Tindakan\EditController@edit');
	Route::post('/datamedis/tindakan/subscribe', 'Kasus\Tindakan\PostController@subscribe');
	Route::post('/datamedis/tindakan/unsubscribe', 'Kasus\Tindakan\PostController@unsubscribe');
	Route::get('/datamedis/tindakan/histori', 'Kasus\Tindakan\ReadController@historiTindakan10');
	Route::get('/datamedis/tindakan/histori-icd9', 'Kasus\Tindakan\ReadController@historiTindakan9');
	Route::post('/datamedis/tindakan/kesalahan-tindakan', 'Kasus\Tindakan\PostController@kesalahanTindakan');

	Route::post('/datamedis/vital-sign/create', 'Kasus\VitalSign\CreateController@create');
	Route::post('/datamedis/vital-sign/edit', 'Kasus\VitalSign\EditController@edit');
	Route::post('/datamedis/vital-sign/delete', 'Kasus\VitalSign\DeleteController@delete');
	Route::get('/datamedis/vital-sign/print', 'Kasus\VitalSign\ViewController@print');
	Route::get('/datamedis/vital-sign/print-observasi', 'Kasus\VitalSign\ViewController@printObservasi');

	Route::post('/datamedis/lokasi/create', 'Kasus\Lokasi\CreateController@createNewLokasi');

	Route::post('/datamedis/resep/create', 'Kasus\Resep\CreateController@createNewResep');
	Route::post('/datamedis/resep/edit', 'Kasus\Resep\EditController@editResep');
	Route::post('/datamedis/resep/delete', 'Kasus\Resep\DeleteController@deleteResep');
	Route::get('/datamedis/resep/print/{id}', 'Kasus\Resep\PostController@printResep');
	Route::get('/datamedis/resep/histori', 'Kasus\Resep\ReadController@historiResep');
	Route::post('/datamedis/resep/hitung-harga', 'Kasus\Resep\ReadController@hitungHarga');


	Route::post('/datamedis/gizi/create', 'Kasus\Gizi\CreateController@createNewPermintaanMakanan');
	Route::post('/datamedis/gizi/sisa-diet', 'Kasus\Gizi\PostController@setSisaDiet');


	Route::get('/datamedis', 'Kasus\Kasus\ViewController@identitas');
	Route::get('/datamedis/identitas', 'Kasus\Kasus\ViewController@identitas');
	Route::get('/datamedis/cppt', 'Kasus\Kasus\ViewController@cppt');
	Route::get('/datamedis/diagnosis', 'Kasus\Kasus\ViewController@diagnosis');
	Route::get('/datamedis/tindakan', 'Kasus\Kasus\ViewController@tindakan');
	Route::get('/datamedis/icd9', 'Kasus\Kasus\ViewController@tindakanICD9');
	Route::get('/datamedis/vital-sign', 'Kasus\Kasus\ViewController@vitalSign');
	Route::get('/datamedis/resep', 'Kasus\Kasus\ViewController@resep');
	Route::get('/datamedis/lokasi', 'Kasus\Kasus\ViewController@lokasi');
	Route::get('/datamedis/gizi', 'Kasus\Kasus\ViewController@gizi');
	Route::get('/datamedis/asesmenawal', 'Kasus\Kasus\ViewController@asesmenawal');
	Route::get('/datamedis/asesmenawal/print/{jenis}/{slug}', 'Kasus\Kasus\ViewController@asesmenawalPrint');
	Route::post('/datamedis/asesmenawal/save', 'Kasus\AsesmenAwal\PostController@save');
	Route::post('/datamedis/asesmenawal/delete', 'Kasus\AsesmenAwal\PostController@delete');
	Route::get('/datamedis/asesmenawal/verifikasi-dokter/{id}', 'Kasus\AsesmenAwal\PostController@verifikasiDokter');
	Route::get('/datamedis/asesmenawal/verifikasi-ners/{id}', 'Kasus\AsesmenAwal\PostController@verifikasiNERS');

	Route::post('/gizi/create', 'Kasus\Gizi\CreateController@createNewPermintaanMakanan');
	Route::get('/gizi', 'Kasus\Kasus\ViewController@gizi');
	Route::post('/gizi/order/create', 'Kasus\Gizi\PostController@createOrder');
	Route::post('/gizi/order/edit', 'Kasus\Gizi\PostController@editOrder');
	Route::post('/gizi/order/delete', 'Kasus\Gizi\PostController@deleteOrder');
	// Route::get('/gizi/skrining/print/{id}', 'Kasus\Kasus\ViewController@giziSkriningPrint');
	// Route::get('/gizi/asesmen/print/{id}', 'Kasus\Kasus\ViewController@giziAsesmenPrint');

	// Route Lama
	// Route::get('/farmasi', 'Kasus\Farmasi\ViewController@index');
	// Route::get('/farmasi/pengobatan-pasien', 'Kasus\Farmasi\ViewController@pengobatanPasien');
	// Route::get('/farmasi/pengobatan-pasien/print', 'Kasus\Farmasi\ViewController@print');
	// Route::get('/farmasi/pengobatan-pasien/print-obat-luar', 'Kasus\Farmasi\ViewController@obatLuar');
	// Route::get('/farmasi/pengobatan-pasien/print-obat-per-oral', 'Kasus\Farmasi\ViewController@obatPerOral');
	// Route::post('/farmasi/pengobatan-pasien/post', 'Kasus\Farmasi\CatatanPengobatanPasien\PostController@post');
	// Route::get('/farmasi/pengobatan-pasien/selesai/{id}', 'Kasus\Farmasi\CatatanPengobatanPasien\PostController@selesai');
	// Route::get('/farmasi/pengobatan-pasien/selesai-batal/{id}', 'Kasus\Farmasi\CatatanPengobatanPasien\PostController@batalSelesai');
	// Route::post('/farmasi/pengobatan-pasien/delete', 'Kasus\Farmasi\CatatanPengobatanPasien\PostController@delete');
	// Route::get('/farmasi/pengobatan-pasien/excel', 'Kasus\Farmasi\CatatanPengobatanPasien\ViewController@excel');

	// Route::post('/farmasi/pengobatan-pasien/pemberian-post', 'Kasus\Farmasi\CatatanPengobatanPasienDetail\PostController@post');
	// Route::post('/farmasi/pengobatan-pasien/pemberian-delete', 'Kasus\Farmasi\CatatanPengobatanPasienDetail\PostController@delete');

	// Route Copas Generik
	Route::get('/farmasi', 'Kasus\Farmasi\ViewController@index');
	Route::get('/farmasi/pengobatan-pasien', 'Kasus\Farmasi\ViewController@pengobatanPasien');
	Route::post('/farmasi/pengobatan-pasien/post', 'Kasus\Farmasi\CatatanPengobatanPasien\PostController@post');
	Route::get('/farmasi/pengobatan-pasien/selesai/{id}', 'Kasus\Farmasi\CatatanPengobatanPasien\PostController@selesai');
	Route::get('/farmasi/pengobatan-pasien/selesai-batal/{id}', 'Kasus\Farmasi\CatatanPengobatanPasien\PostController@batalSelesai');
	Route::post('/farmasi/pengobatan-pasien/delete', 'Kasus\Farmasi\CatatanPengobatanPasien\PostController@delete');
	Route::get('/farmasi/pengobatan-pasien/print', 'Kasus\Farmasi\CatatanPengobatanPasien\ViewController@print');
	Route::post('/farmasi/pengobatan-pasien/cetak-riwayat-pemberian-obat', 'Kasus\Farmasi\CatatanPengobatanPasien\ViewController@cetakRiwayatPemberianObat');

	Route::post('/farmasi/pengobatan-pasien/pemberian-post', 'Kasus\Farmasi\CatatanPengobatanPasienDetail\PostController@post');
	Route::post('/farmasi/pengobatan-pasien/pemberian-delete', 'Kasus\Farmasi\CatatanPengobatanPasienDetail\PostController@delete');


	Route::get('/farmasi/rekonsiliasi', 'Kasus\Farmasi\Rekonsiliasi\ViewController@index');
	Route::post('/farmasi/rekonsiliasi/create', 'Kasus\Farmasi\Rekonsiliasi\PostController@post');
	Route::post('/farmasi/rekonsiliasi/post', 'Kasus\Farmasi\Rekonsiliasi\PostController@post');
	Route::post('/farmasi/rekonsiliasi/delete', 'Kasus\Farmasi\Rekonsiliasi\PostController@delete');
	Route::get('/farmasi/rekonsiliasi/print', 'Kasus\Farmasi\Rekonsiliasi\ViewController@print');

	Route::get('/farmasi/formulir-pelayanan-obat', 'Kasus\Farmasi\FormulirPelayananObat\ViewController@index');
	Route::get('/farmasi/formulir-pelayanan-obat/{transaksi_id}/print-formulir', 'Kasus\Farmasi\FormulirPelayananObat\ViewController@printFormulir');

	Route::get('/farmasi/screening-pemantauan-terapi-obat-pasien', 'Kasus\Farmasi\ScreeningPemantauanTerapiObatPasien\ViewController@index');
	Route::post('/farmasi/screening-pemantauan-terapi-obat-pasien/create', 'Kasus\Farmasi\ScreeningPemantauanTerapiObatPasien\PostController@create');
	Route::get('/farmasi/screening-pemantauan-terapi-obat-pasien/print', 'Kasus\Farmasi\ScreeningPemantauanTerapiObatPasien\ViewController@print');
	Route::post('/farmasi/screening-pemantauan-terapi-obat-pasien/delete', 'Kasus\Farmasi\ScreeningPemantauanTerapiObatPasien\PostController@delete');

	Route::get('/farmasi/formulir-pasien-pemantauan-terapi-obat', 'Kasus\Farmasi\FormulirPasienPemantauanTerapiObat\ViewController@index');
	Route::get('/farmasi/formulir-pasien-pemantauan-terapi-obat/print/{id}', 'Kasus\Farmasi\FormulirPasienPemantauanTerapiObat\ViewController@print');
	Route::post('/farmasi/formulir-pasien-pemantauan-terapi-obat/create', 'Kasus\Farmasi\FormulirPasienPemantauanTerapiObat\PostController@create');


	Route::get('/update-plafon', 'Kasus\Kasus\PostController@updatePlafon');
	Route::get('/update-plafon-part-two', 'Kasus\Kasus\PostController@updatePlafonSecond');

	Route::group(['prefix' => 'farmasi/konseling-obat'], function () {
		Route::get('/', 'Kasus\Farmasi\KonselingObat\ViewController@index');
		Route::post('/save', 'Kasus\Farmasi\KonselingObat\PostController@save');
		Route::post('/delete', 'Kasus\Farmasi\KonselingObat\PostController@delete');
		Route::post('/add-ttd-pasien', 'Kasus\Farmasi\KonselingObat\PostController@submitTTD');
		Route::get('/print', 'Kasus\Farmasi\KonselingObat\ViewController@print');
	});

	Route::group(['prefix' => 'penunjang'], function () {
		Route::get('/', 'Kasus\Penunjang\ViewController@index');
		Route::get('/histori', 'Kasus\Penunjang\ViewController@histori');
		Route::get('/hasil-lab', 'Kasus\Penunjang\ViewController@hasilLab');
		Route::get('/histori-galeri', 'Kasus\Penunjang\ViewController@historiGaleri');
		Route::get('/form', 'Kasus\Penunjang\ViewController@form');
		Route::post('/baru', 'Kasus\Penunjang\CreateController@new');
		Route::post('/upload', 'Kasus\Penunjang\PostController@uploadPenunjang');
		Route::post('/edit', 'Kasus\Penunjang\PostController@editPenunjang');
		Route::post('/delete', 'Kasus\Penunjang\PostController@deletePenunjang');
		Route::get('/print-barcode/{barcode}/{slug}', 'Kasus\Penunjang\ViewController@printBarcode');
		Route::post('/galeri/detail-img/deletekomentar', 'Kasus\Penunjang\PostController@deleteKomentar');
		Route::post('/galeri/detail-img/updatekomentar', 'Kasus\Penunjang\PostController@updateKomentar');
		Route::get('/galeri/detail-img/{id}', 'Kasus\Penunjang\ViewController@detailImg');
		Route::post('/galeri/detail-img/{id}/komentar', 'Kasus\Penunjang\PostController@komentar');
	});


	Route::post('/permintaan-penunjang/create', 'Kasus\PenunjangPermintaan\PostController@create');
	Route::post('/permintaan-penunjang/tolak', 'Kasus\PenunjangPermintaan\EditController@cancel');

	Route::get('/alat-medis', 'Kasus\AlatMedis\ViewController@index');
	Route::post('/alat-medis/permintaan', 'Kasus\AlatMedis\PostController@permintaan');
	Route::post('/alat-medis/selesai', 'Kasus\AlatMedis\PostController@selesai');

	Route::get('/operasi', 'Kasus\Operasi\ViewController@index');
	Route::post('/operasi/permintaan', 'Kasus\Operasi\PostController@permintaan');
	Route::post('/operasi/tolak', 'Kasus\Operasi\DeleteController@tolak');
	Route::get('/operasi/print/{pasca_id}/hasil', 'Kasus\Operasi\ViewController@printHasil');


	Route::get('/tagihan', 'Kasus\Tagihan\ViewController@index');
	Route::post('/tagihan/tolak', 'Kasus\Tagihan\EditController@cancel');
	Route::post('/tagihan/checkout', 'Kasus\Tagihan\PostController@checkout');
	Route::post('/tagihan/sync', 'Kasus\Tagihan\PostController@syncSEP');
	Route::post('/tagihan/split', 'Kasus\Tagihan\PostController@split');
	Route::get('/tagihan/print/{tagihan_id}', 'Kasus\Tagihan\ViewController@print');
	Route::get('/tagihan-detail/flag-ipwl/{id}', 'Kasus\TagihanDetail\PostController@flagIpwl');
	Route::post('/tagihan-detail/create', 'Kasus\TagihanDetail\PostController@create');
	Route::post('/tagihan-detail/edit', 'Kasus\TagihanDetail\PostController@edit');
	Route::post('/tagihan-detail/pindahkan-multi', 'Kasus\TagihanDetail\PostController@pindahkanMulti');
	Route::post('/tagihan-detail/delete', 'Kasus\TagihanDetail\PostController@delete');

	Route::get('/histori-bayar', 'Kasus\HistoriBayar\ViewController@index');
	Route::post('/histori-bayar/create', 'Kasus\HistoriBayar\PostController@create');
	Route::post('/histori-bayar/tambahbayar', 'Kasir\Transaksi\PostController@apiSubmit');
	Route::post('/histori-bayar/edit', 'Kasus\HistoriBayar\PostController@edit');

	Route::get('/bpjs', 'Kasus\BPJS\ViewController@index');
	Route::get('/bpjs/print/{id}', 'Kasus\BPJS\ViewController@print');
	Route::post('/bpjs/create', 'Kasus\BPJS\PostController@create');
	Route::post('/bpjs/edit', 'Kasus\BPJS\PostController@edit');

	Route::get('/administrasi', 'Kasus\Administrasi\ViewController@index');
	Route::get('/administrasi/rawatinap/daftar', 'Kasus\Administrasi\PostController@rawatInapDaftar');
	Route::get('/administrasi/rawatinap/pindah', 'Kasus\Administrasi\PostController@rawatInapPindah');
	Route::get('/administrasi/rawatinap/daftar-intensif', 'Kasus\Administrasi\PostController@rawatInapDaftarIntensif');
	Route::get('/administrasi/rawatjalan/rujuk', 'Kasus\Administrasi\PostController@rawatJalanRujuk');
	Route::get('/administrasi/igd/pindah', 'Kasus\Administrasi\PostController@igdPindah');
	Route::get('/administrasi/rawatjalan/pindah', 'Kasus\Administrasi\PostController@rawatjalanPindah');
	Route::get('/administrasi/rawatinap/print-permintaan-opname/{id}', 'Kasus\Administrasi\ViewController@printPermintaanOpname');
	Route::post('/administrasi/rawatjalan/transaksi/pendaftaran/tolak', 'Kasus\Administrasi\PostController@rawatJalanTolak');

	include('kasus-alatbantu.php');
	include('kasus-asesmen.php');
	include('kasus-psikologi.php');

	Route::get('/mutu', 'Kasus\AlatBantu\ViewController@mutu');
	Route::get('/ppi', 'Kasus\AlatBantu\ViewController@ppi');

	Route::get('/kolaborator', 'Kasus\Kolaborator\ViewController@index');
	Route::get('/kolaborator/print-dpjp/{user_id}', 'Kasus\Kolaborator\ViewController@dpjp');
	Route::get('/kolaborator/print-konsul/{user_id}', 'Kasus\Kolaborator\ViewController@konsul');
	Route::post('/kolaborator/create', 'Kasus\Kolaborator\PostController@create');
	Route::post('/kolaborator/delete', 'Kasus\Kolaborator\PostController@delete');
	Route::post('/kolaborator/admin', 'Kasus\Kolaborator\EditController@admin');


	Route::get('/resume', 'Kasus\Asesmen\RingkasanPasienPulang\ViewController@index');
	Route::get('/resume/histori', 'Kasus\Resume\ViewController@histori');
	Route::get('/resume/create', 'Kasus\Resume\ViewController@create');
	Route::get('/resume/edit/{id}', 'Kasus\Resume\ViewController@edit');
	Route::get('/resume/print/{id}', 'Kasus\Resume\ViewController@printresume');
	Route::get('/resume/bukti-pelayanan', 'Kasus\Resume\ViewController@buktiPelayanan');
	Route::post('/resume/delete', 'Kasus\Resume\PostController@delete');

	Route::get('/timeline', 'Kasus\Home\ViewController@timeline');

	Route::get('/histori', 'Kasus\Histori\ViewController@index');

	Route::get('/pengaturan', 'Kasus\Pengaturan\ViewController@index');
	Route::post('/pengaturan/tutup-kasus', 'Kasus\Pengaturan\PostController@tutupKasus');
	Route::post('/pengaturan/data/krs', 'Kasus\Pengaturan\PostController@dataKRS');
	Route::post('/pengaturan/{sep}/update-plafon', 'Kasus\Pengaturan\PostController@updatePlafon');
	Route::get('/pengaturan/batal-krs', 'Kasus\Pengaturan\PostController@batalKRS');
	Route::get('/pengaturan/batal-tutup-kasus', 'Kasus\Pengaturan\PostController@batalTutupKasus');

	Route::post('todo/new', 'Kasus\ToDo\PostController@new');

	Route::get('/keperawatan', 'Kasus\Keperawatan\RencanaAsuhan\ViewController@index');
	Route::get('/keperawatan/rencana-asuhan', 'Kasus\Keperawatan\RencanaAsuhan\ViewController@index');
	Route::get('/keperawatan/rencana-asuhan/verifikasi-dokter/{id}', 'Kasus\Keperawatan\RencanaAsuhan\EditController@verifikasiDokter');
	Route::get('/keperawatan/rencana-asuhan/verifikasi-ners/{id}', 'Kasus\Keperawatan\RencanaAsuhan\EditController@verifikasiNers');
	Route::get('/keperawatan/delete/{id}', 'Kasus\Keperawatan\RencanaAsuhan\DeleteController@destroy');
	Route::post('/keperawatan', 'Kasus\Keperawatan\RencanaAsuhan\CreateController@create');
	Route::post('/keperawatan/edit', 'Kasus\Keperawatan\RencanaAsuhan\EditController@update');

	Route::get('/keperawatan/timbang-terima', 'Kasus\Keperawatan\TimbangTerima\ViewController@index');
	Route::get('/keperawatan/timbang-terima/verifikasi-terima-pasien/{id}', 'Kasus\Keperawatan\TimbangTerima\ViewController@verifikasiTerimaPasien');
	Route::get('/keperawatan/timbang-terima/verifikasi-ners/{id}', 'Kasus\Keperawatan\TimbangTerima\ViewController@verifikasiNers');

	Route::get('/keperawatan/nursing-notes', 'Kasus\Keperawatan\NursingNotes\ViewController@index');
	Route::post('/keperawatan/nursing-notes/post', 'Kasus\Keperawatan\NursingNotes\PostController@post');
	Route::post('/keperawatan/nursing-notes/delete', 'Kasus\Keperawatan\NursingNotes\PostController@delete');
	Route::get('/keperawatan/nursing-notes/verifikasi/{id}', 'Kasus\Keperawatan\NursingNotes\PostController@verifikasi');

	Route::get('/keperawatan/nursing-notes/delete', 'Kasus\Keperawatan\NursingNotes\PostController@delete');


	Route::post('/keperawatan/timbang-terima/save', 'Kasus\Keperawatan\TimbangTerima\PostController@save');
	Route::post('/keperawatan/timbang-terima/delete', 'Kasus\Keperawatan\TimbangTerima\PostController@delete');

	Route::post('/pemeriksaan-awal/pemeriksaan-umum/create', 'Kasus\Urikkes\PemeriksaanUmum\CreateController@index');
	Route::post('/pemeriksaan-awal/pemeriksaan-umum/edit', 'Kasus\Urikkes\PemeriksaanUmum\EditController@index');
	Route::post('/pemeriksaan-awal/pemeriksaan-umum/delete', 'Kasus\Urikkes\PemeriksaanUmum\DeleteController@index');

	Route::get('/pemeriksaan-awal/status-pasien', 'Kasus\PemeriksaanAwal\StatusPasien\ViewController@index');
	Route::post('/urikkes/evaluasi-klinis/create', 'Kasus\Urikkes\EvaluasiKlinis\CreateController@index');
	Route::post('/urikkes/evaluasi-klinis/edit', 'Kasus\Urikkes\EvaluasiKlinis\EditController@index');
	Route::post('/urikkes/evaluasi-klinis/delete', 'Kasus\Urikkes\EvaluasiKlinis\DeleteController@index');

	Route::get('/pemeriksaan-awal/nutrisi', 'Kasus\PemeriksaanAwal\Nutrisi\ViewController@index');
	Route::get('/pemeriksaan-awal/aktifitas-sehari-hari', 'Kasus\PemeriksaanAwal\AktifitasSehariHari\ViewController@index');
	Route::get('/pemeriksaan-awal/fisiologi-neonatus', 'Kasus\PemeriksaanAwal\FisiologiNeonatus\ViewController@index');
	Route::get('/pemeriksaan-awal/kebutuhan-edukasi', 'Kasus\PemeriksaanAwal\KebutuhanEdukasi\ViewController@index');


	Route::post('/pemeriksaan-spesialis/jiwa/create', 'Kasus\Urikkes\Jiwa\CreateController@index');
	Route::post('/pemeriksaan-spesialis/jiwa/edit', 'Kasus\Urikkes\Jiwa\EditController@index');
	Route::post('/pemeriksaan-spesialis/jiwa/delete', 'Kasus\Urikkes\Jiwa\DeleteController@index');

	Route::post('/pemeriksaan-spesialis/gigi/create', 'Kasus\Urikkes\Gigi\CreateController@index');
	Route::post('/pemeriksaan-spesialis/gigi/edit', 'Kasus\Urikkes\Gigi\EditController@index');
	Route::post('/pemeriksaan-spesialis/gigi/delete', 'Kasus\Urikkes\Gigi\DeleteController@index');

	Route::post('/pemeriksaan-spesialis/mata/create', 'Kasus\Urikkes\Mata\CreateController@index');
	Route::post('/pemeriksaan-spesialis/mata/edit', 'Kasus\Urikkes\Mata\EditController@index');
	Route::post('/pemeriksaan-spesialis/mata/delete', 'Kasus\Urikkes\Mata\DeleteController@index');

	Route::post('/pemeriksaan-spesialis/telinga/create', 'Kasus\Urikkes\Telinga\CreateController@index');
	Route::post('/pemeriksaan-spesialis/telinga/edit', 'Kasus\Urikkes\Telinga\EditController@index');
	Route::post('/pemeriksaan-spesialis/telinga/delete', 'Kasus\Urikkes\Telinga\DeleteController@index');

	Route::get('/urikkes', 'Kasus\Urikkes\ViewController@index');
	Route::post('/urikkes/resume/create', 'Kasus\Urikkes\Resume\CreateController@index');
	Route::post('/urikkes/resume/edit', 'Kasus\Urikkes\Resume\EditController@index');
	Route::post('/urikkes/resume/delete', 'Kasus\Urikkes\Resume\DeleteController@index');

	Route::post('urikkes/laporan/print', 'Kasus\Urikkes\Laporan\EditController@index');
	Route::get('urikkes/laporan/getprint', 'Kasus\Urikkes\Laporan\EditController@getPDF');

	Route::get('/urikkes/layanan', 'Kasus\Layanan\ViewController@index');
	Route::post('/urikkes/layanan/edit', 'Kasus\Layanan\EditController@index');


	// Route::get('/form-all','Kasus\Form\ViewController@index');
	// Route::get('/form-all/{id}','Kasus\Form\ViewController@single');

	// Route::get('/form-all/{id}/create','Kasus\Form\ViewController@create');
	// Route::get('/form-all/{id}/hasil/{hasil_id}','Kasus\FormHasil\ViewController@single');
	// Route::get('/form-all/{id}/hasil/{hasil_id}/edit','Kasus\FormHasil\ViewController@edit');

	// Route::post('/form-all/{id}/create','Kasus\Form\PostController@create');
	// Route::post('/form-all/{id}/hasil/{hasil_id}/edit','Kasus\Form\PostController@edit');


	Route::get('/form/{slug}', 'Kasus\Form\ViewController@index');
	Route::get('/form/{slug}/custom/{id}', 'Kasus\Form\ViewController@single');
	Route::get('/form/{slug}/custom/{id}/create', 'Kasus\Form\ViewController@create');
	Route::get('/form/{slug}/custom/{id}/hasil/{hasil_id}', 'Kasus\FormHasil\ViewController@single');
	Route::get('/form/{slug}/custom/{id}/hasil/{hasil_id}/edit', 'Kasus\FormHasil\ViewController@edit');
	Route::post('/form/{slug}/custom/{id}/create', 'Kasus\Form\PostController@create');
	Route::post('/form/{slug}/custom/{id}/hasil/{hasil_id}/edit', 'Kasus\Form\PostController@edit');
	Route::post('/form/{slug}/custom/{id}/hasil/{hasil_id}/delete', 'Kasus\Form\PostController@delete');


	Route::get('/form/{slug}/labpk/{id}', 'Kasus\FormLabPK\ViewController@single');
	Route::get('/form/{slug}/labpk/{id}/create', 'Kasus\FormLabPK\ViewController@create');
	Route::get('/form/{slug}/labpk/{id}/hasil/{hasil_id}', 'Kasus\FormLabPKHasil\ViewController@single');
	Route::get('/form/{slug}/labpk/{id}/hasil/{hasil_id}/edit', 'Kasus\FormLabPKHasil\ViewController@edit');
	Route::post('/form/{slug}/labpk/{id}/create', 'Kasus\FormLabPK\PostController@create');
	Route::post('/form/{slug}/labpk/{id}/hasil/{hasil_id}/edit', 'Kasus\FormLabPK\PostController@edit');

	Route::get('/pemeriksaanlab', 'Kasus\PemeriksaanLab\ViewController@index');
	Route::post('/pemeriksaanlab/darahlengkap/create', 'Kasus\PemeriksaanLab\PostController@create');
	Route::post('/pemeriksaanlab/darahlengkap/edit', 'Kasus\PemeriksaanLab\PostController@create');
	Route::post('/pemeriksaanlab/darahlengkap/delete', 'Kasus\PemeriksaanLab\DeleteController@delete');
	Route::post('/pemeriksaanlab/hematologi/create', 'Kasus\PemeriksaanLab\PostController@create');
	Route::post('/pemeriksaanlab/hematologi/edit', 'Kasus\PemeriksaanLab\PostController@create');
	Route::post('/pemeriksaanlab/hematologi/delete', 'Kasus\PemeriksaanLab\DeleteController@delete');
	Route::post('/pemeriksaanlab/urine/create', 'Kasus\PemeriksaanLab\PostController@createUrine');
	Route::post('/pemeriksaanlab/urine/edit', 'Kasus\PemeriksaanLab\PostController@createUrine');
	Route::post('/pemeriksaanlab/urine/delete', 'Kasus\PemeriksaanLab\DeleteController@deleteUrine');
	Route::post('/pemeriksaanlab/imun/create', 'Kasus\PemeriksaanLab\PostController@createImun');
	Route::post('/pemeriksaanlab/imun/edit', 'Kasus\PemeriksaanLab\PostController@createImun');
	Route::post('/pemeriksaanlab/imun/delete', 'Kasus\PemeriksaanLab\DeleteController@deleteImun');
	Route::post('/pemeriksaanlab/smear/create', 'Kasus\PemeriksaanLab\PostController@createSmear');
	Route::post('/pemeriksaanlab/smear/edit', 'Kasus\PemeriksaanLab\PostController@createSmear');
	Route::post('/pemeriksaanlab/smear/delete', 'Kasus\PemeriksaanLab\DeleteController@deleteSmear');
	Route::post('/pemeriksaanlab/feces/create', 'Kasus\PemeriksaanLab\PostController@createFeces');
	Route::post('/pemeriksaanlab/feces/edit', 'Kasus\PemeriksaanLab\PostController@createFeces');
	Route::post('/pemeriksaanlab/feces/delete', 'Kasus\PemeriksaanLab\DeleteController@deleteFeces');

	Route::get('/psikologi', 'Kasus\Psikologi\ViewController@index');
	Route::get('/psikologi/visum', 'Kasus\Psikologi\ViewController@visum');
	Route::get('/psikologi/pemeriksaan-psikologi-dewasa', 'Kasus\Psikologi\ViewController@pemeriksaanDewasa');
	Route::get('/psikologi/pemeriksaan-psikologi-anak', 'Kasus\Psikologi\ViewController@pemeriksaanAnak');
	Route::get('/psikologi/laporan-pemeriksaan-psikologi', 'Kasus\Psikologi\ViewController@laporanPemeriksaanPsikologi');

	Route::get('/daycare', 'Kasus\DayCare\ViewController@index');

	Route::post('/keluar-kasus', 'Kasus\Kolaborator\PostController@keluarKasus');
});

Route::group(['prefix' => 'api/kasus/get'], function () {
	Route::get('/list/tindakan', 'Keuangan\Tarif\ReadController@get');
	Route::get('/list/tarif', 'Keuangan\Tarif\ReadController@get');
	Route::get('/list/layanan', 'Keuangan\Layanan\ReadController@get');
	Route::get('/list/diagnosis', 'Kasus\Diagnosis\ReadController@DiagnosisList');
	Route::get('/list/tindakan/harga', 'Kasus\Tindakan\ReadController@tarifDetail');
	Route::get('/list/tarif/harga', 'Kasus\Tindakan\ReadController@tarifDetail');
	Route::get('/list/poedji/{id}', 'Kasus\AlatBantu\Poedji\ReadController@get');
	Route::get('/list/icd9', 'Kasus\Tindakan\ReadController@ICD9List');
	Route::get('/alat-bantu/val/{id}', 'Kasus\AlatBantu\PermintaanUSG\ViewController@getAlatBantuVal');
});

Route::group(['prefix' => 'api/kasus'], function () {
	Route::post('/administrasi/unit-tindakan/pendaftaran', 'Kasus\Administrasi\PostController@daftarUnitTindakan');
	Route::post('/administrasi/bayi-lahir', 'Kasus\Administrasi\PostController@bayiLahir');
	Route::post('/administrasi/rawatinap/ruang-kosong', 'RawatInap\TempatTidur\ReadController@apiRuangKosongNoTransaksi');
	Route::get('/administrasi/rawatinap/ruang-kosong-bayi', 'RawatInap\TempatTidur\ReadController@apiGetBedKosong');
	Route::post('/administrasi/rawatinap/daftar', 'Kasus\Administrasi\PostController@rawatInapDaftar');
	Route::post('/kolaborator/terima-undangan', 'Kasus\Kolaborator\EditController@terimaUndangan');
	Route::post('/kolaborator/tolak-undangan', 'Kasus\Kolaborator\EditController@tolakUndangan');
	Route::post('/kolaborator/join', 'Kasus\Kolaborator\CreateController@joinKasus');
	Route::get('/pemeriksaanlab/darahlengkap/{id}', 'Kasus\PemeriksaanLab\ReadController@single');
	Route::get('/pemeriksaanlab/urine/{id}', 'Kasus\PemeriksaanLab\ReadController@urineSingle');
	Route::get('/pemeriksaanlab/imun/{id}', 'Kasus\PemeriksaanLab\ReadController@imunSingle');
	Route::get('/pemeriksaanlab/smear/{id}', 'Kasus\PemeriksaanLab\ReadController@smearSingle');
	Route::get('/pemeriksaanlab/feces/{id}', 'Kasus\PemeriksaanLab\ReadController@fecesSingle');
	Route::get('/purifikasi/potensi/rawat-jalan', 'Kasus\PotensiPurifikasi\ViewController@cekPotensiRawatJalan');
	Route::get('/purifikasi/potensi/rawat-inap', 'Kasus\PotensiPurifikasi\ViewController@cekPotensiRawatInap');


	Route::post('{nomor_kasus}/cppt/set-readback', 'Kasus\CPPT\PostController@readback');
	Route::post('{nomor_kasus}/cppt/verifikasi-readback', 'Kasus\CPPT\PostController@verifReadback');
	Route::get('{nomor_kasus}/cppt/verifikasi/{id}', 'Kasus\CPPT\EditController@APIVerifikasi');
	Route::get('{nomor_kasus}/cppt/marked-print/{id}', 'Kasus\CPPT\EditController@APIMarkedPrint');
	Route::get('{nomor_kasus}/cppt/verifikasi-ners/{id}', 'Kasus\CPPT\EditController@APIVerifikasiNers');
	Route::get('{nomor_kasus}/suggest/cppt-objective-ttv', 'Kasus\CPPT\ReadController@getSuggestObjectiveTTV');
	Route::get('{nomor_kasus}/suggest/cppt-objective-keperawatan', 'Kasus\CPPT\ReadController@getSuggestObjectiveKeperawatan');
	Route::get('{nomor_kasus}/suggest/cppt-objective-evaluasi-implementasi-keperawatan', 'Kasus\CPPT\ReadController@getSuggestObjectiveEvaluasiImplementasiKeperawatan');


	Route::get('{nomor_kasus}/suggest/cppt-subjective-keperawatan', 'Kasus\CPPT\ReadController@getSuggestSubjectiveKeperawatan');
	Route::get('{nomor_kasus}/suggest/cppt-assessment-keperawatan', 'Kasus\CPPT\ReadController@getSuggestAssessmentKeperawatan');
	Route::get('{nomor_kasus}/suggest/cppt-plan-keperawatan', 'Kasus\CPPT\ReadController@getSuggestPlanKeperawatan');
	Route::get('{nomor_kasus}/suggest/cppt-subjective', 'Kasus\CPPT\ReadController@getSuggestSubjective');
	Route::get('{nomor_kasus}/suggest/cppt-assessment', 'Kasus\CPPT\ReadController@getSuggestAssessment');
	Route::get('{nomor_kasus}/suggest/cppt-plan-resep', 'Kasus\CPPT\ReadController@getSuggestPlanResep');
	Route::get('{nomor_kasus}/suggest/cppt-plan-icd9', 'Kasus\CPPT\ReadController@getSuggestPlanICD9');
	Route::get('{nomor_kasus}/suggest/cppt-subjective-template', 'Kasus\CPPT\ReadController@getSuggestSubjectiveTemplate');
	Route::get('{nomor_kasus}/suggest/cppt-objective-template', 'Kasus\CPPT\ReadController@getSuggestObjectiveTemplate');
	Route::get('{nomor_kasus}/suggest/cppt-plan-template', 'Kasus\CPPT\ReadController@getSuggestPlanTemplate');

	Route::get('{nomor_kasus}/suggest/cppt-adime-assessment-template', 'Kasus\CPPT\ReadController@getSuggestAdimeAssessmentTemplate');
	Route::get('{nomor_kasus}/suggest/cppt-adime-intervensi-template', 'Kasus\CPPT\ReadController@getSuggestAdimeIntervensiTemplate');

	Route::get('{nomor_kasus}/suggest/timbang-cppt-suggest', 'Kasus\Keperawatan\TimbangTerima\ViewController@getSuggestCppt');

	Route::get('{nomor_kasus}/suggest/cppt-plan-farmasi', 'Kasus\CPPT\ReadController@getSuggestPlanFarmasi');
	Route::get('{nomor_kasus}/suggest/cppt-assessment-farmasi', 'Kasus\CPPT\ReadController@getSuggestAssessmentFarmasi');


	Route::get('{nomor_kasus}/alat-bantu/norton/get/{id}', 'Kasus\AlatBantu\Norton\PostController@APIGetSurveilans');
	Route::get('{nomor_kasus}/alat-bantu/surveilans/get-post/{id}', 'Kasus\AlatBantu\Surveilans\PostController@APIGetSurveilans');
	Route::get('{nomor_kasus}/alat-bantu/surveilans/get-pre/{id}', 'Kasus\AlatBantu\Surveilans\PostController@APIGetSurveilans');
	Route::get('{nomor_kasus}/alat-bantu/surveilans/get-durante/{id}', 'Kasus\AlatBantu\Surveilans\PostController@APIGetSurveilans');
	Route::post('{nomor_kasus}/alat-bantu/edukasi-pasien/add-ttd-pasien', 'Kasus\AlatBantu\EdukasiPasien\PostController@APIAddTTDPasien');

	Route::post('{nomor_kasus}/farmasi/rekonsiliasi/ttd/save', 'Kasus\Farmasi\Rekonsiliasi\PostController@ttdSubmit');
});
