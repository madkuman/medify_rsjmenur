<?php
Route::group(['middleware' => ['check-module']], function () {
	Route::group(['prefix' => 'pasien'], function () {

		Route::get('/admin/import', 'Pasien\Import@pasien');

		Route::get('/admin-update-index', 'Pasien\Pasien\ViewController@adminUpdateIndex');
		Route::get('', 'Pasien\Pasien\ViewController@index');
		Route::get('dashboard', 'Pasien\Pasien\ViewController@index');
		Route::get('statistik', 'Pasien\Pasien\ViewController@statistik');
		Route::get('daftar-online', 'Pasien\Pasien\ViewController@daftarOnline');
		Route::get('daftar-online/update/{id}', 'Pasien\Pasien\ViewController@updateDaftarOnline');
		Route::post('daftar-online/update/{id}', 'Pasien\Pasien\PostController@updateDaftarOnline');
        Route::get('daftar-online-batal', 'Pasien\Pasien\ViewController@daftarOnlineBatal');
        Route::post('daftar-online-batal/konfirmasi/{id}', 'Pasien\Pasien\PostController@konfirmasiBatal');
		Route::get('pasien-baru-online', 'Pasien\Pasien\ViewController@pasienBaruOnline');
		Route::get('pasien-baru-online/{id}/edit', 'Pasien\Pasien\ViewController@pasienBaruOnlineEdit');
		
		//antrian pasien
		Route::get('antrian-pasien', 'Pasien\Antrian\ViewController@antrian');
		Route::get('antrian/get-dokter/{id_poli}', 'Pasien\Antrian\ViewController@getDokter');
		Route::get('antrian/pasien-lama', 'Pasien\Antrian\ViewController@pasienLama');
		Route::post('antrian/pasien-lama', 'Pasien\Antrian\PostController@pasienLama');
		Route::get('antrian/pasien-baru', 'Pasien\Antrian\ViewController@pasienBaru');
		Route::post('antrian/print', 'Pasien\Antrian\PostController@print');
		Route::get('antrian/print/{data}', 'Pasien\Antrian\ViewController@printBarcode');

		//pengaturan loket
		Route::get('pengaturan-loket', 'Pasien\PengaturanLoket\ViewController@index');
		Route::get('pengaturan-loket/update/{id}', 'Pasien\PengaturanLoket\ViewController@update');
		Route::post('pengaturan-loket/update/{id}', 'Pasien\PengaturanLoket\PostController@update');
		Route::post('pengaturan-loket/hapus/{id}', 'Pasien\PengaturanLoket\PostController@hapus');
		Route::post('pengaturan-loket/baru', 'Pasien\PengaturanLoket\PostController@create');
		Route::get('get-loket', 'Pasien\PengaturanLoket\ViewController@getLoket');
		Route::get('antrian/cek-antrian', 'Pasien\PengaturanLoket\ViewController@cekAntrian');
		Route::get('antrian/cek-kunjungan-poli', 'Pasien\PengaturanLoket\ViewController@cekKunjunganPoli');

		//konfirmasi antrian
		Route::get('konfirmasi-antrian', 'Pasien\KonfirmasiAntrian\ViewController@index');
		Route::get('konfirmasi-antrian/get-data', 'Pasien\KonfirmasiAntrian\ViewController@getData');
		Route::get('konfirmasi-antrian/konfirmasi/{id}', 'Pasien\KonfirmasiAntrian\ViewController@halamanKonfirmasi');
		Route::post('konfirmasi-antrian/konfirmasi/{id}', 'Pasien\KonfirmasiAntrian\PostController@halamanKonfirmasi');
		Route::post('konfirmasi-antrian/cancel', 'Pasien\KonfirmasiAntrian\PostController@batalkan');

		Route::group(['prefix' => 'laporan'], function () {
			Route::get('/', 'Pasien\Pasien\ViewController@laporan');
			Route::post('/printlaporan', 'Pasien\Pasien\ViewController@printLaporan');
			Route::post('/printlaporan/morbiditas', 'Pasien\Laporan\PostController@morbiditas');
			Route::post('/printlaporan/sepuluhbesar', 'Pasien\Laporan\PostController@sepuluhbesar');
			Route::post('/printlaporan/diagnosis', 'Pasien\Laporan\PostController@diagnosis');
			Route::post('/printlaporan/icd10', 'Pasien\Laporan\PostController@icd10');

			Route::post('/printlaporan/rekap-transaksi-rawatjalan-berdasarkan-jenis-pembayaran', 'Pasien\Laporan\PostController@rekapTransaksiRJPembayaran');
			Route::post('/printlaporan/pasien-resume-inap', 'Pasien\Laporan\PostController@pasienResumeInap');
			Route::post('/printlaporan/indeks-dokter', 'Pasien\Laporan\PostController@indeksDokter');
			Route::post('/printlaporan/indeks-penyakit', 'Pasien\Laporan\PostController@indeksPenyakit');
			Route::post('/printlaporan/indeks-kematian', 'Pasien\Laporan\PostController@indeksKematian');
			Route::post('/printlaporan/indeks-tindakan', 'Pasien\Laporan\PostController@indeksTindakan');
			Route::post('/printlaporan/rm-response-time', 'Pasien\Laporan\PostController@RmResponseTime');
			Route::post('/printlaporan/laporan-kematian', 'Pasien\Laporan\PostController@laporanKematian');
			Route::post('/printlaporan/rekap-laporan-kunjungan-rawat-jalan', 'Pasien\Laporan\PostController@rekapLaporanKunjunganRawatJalan');
			Route::post('/printlaporan/data-pendukung-rekap-laporan-kunjungan-rawat-jalan', 'Pasien\Laporan\PostController@dataPendukungRekapLaporanKunjunganRawatJalan');
			Route::post('/printlaporan/data-pelayanan-berdasarkan-usia-rawat-jalan', 'Pasien\Laporan\PostController@dataPelayananBerdasarkanUsiaRawatJalan');
			Route::post('/printlaporan/sepuluh-besar-rawat-jalan-icd', 'Pasien\Laporan\PostController@sepuluhBesarRawatJalanDiagnosaICD');
			Route::post('/printlaporan/sepuluh-besar-rawat-jalan-icd-setiap-poli', 'Pasien\Laporan\PostController@sepuluhBesarRawatJalanDiagnosaICDSetiapPoli');
			Route::post('/printlaporan/laporan-populasi', 'Pasien\Laporan\PostController@laporanPopulasi');
			Route::post('/printlaporan/laporan-demografi', 'Pasien\Laporan\PostController@laporanDemografi');
			Route::get('/printlaporan/surveilans', 'Pasien\Laporan\PostController@laporanSurveilans');
			Route::post('/printlaporan/diabetes', 'Pasien\Laporan\PostController@laporanDiabetes');
			Route::post('/printlaporan/hipertensi', 'Pasien\Laporan\PostController@laporanHipertensi');
			Route::post('/printlaporan/tbc', 'Pasien\Laporan\PostController@laporanTBC');
			Route::post('/printlaporan/penyisiran-kasus-tb', 'Pasien\Laporan\PostController@penyisiranKasusTB');
			Route::post('/printlaporan/katarak', 'Pasien\Laporan\PostController@laporanKatarak');
			Route::post('/printlaporan/kematianDinkes', 'Pasien\Laporan\PostController@kematianDinkes');
			Route::post('/printlaporan/kematianRSAL', 'Pasien\Laporan\PostController@kematianRSAL');
			Route::post('/printlaporan/P2K', 'Pasien\Laporan\PostController@P2K');
			Route::post('/printlaporan/stp', 'Pasien\Laporan\PostController@laporanSTP');
			Route::get('/printlaporan/ranap', 'Pasien\Laporan\PostController@ranap');
			Route::post('/printlaporan/lansia', 'Pasien\Laporan\PostController@lansia');
			Route::post('/printlaporan/indikatorKinerja', 'Pasien\Laporan\PostController@indikatorKinerja');
			Route::post('/printlaporan/krs', 'Pasien\Laporan\PostController@laporanKRS');
			Route::post('/printlaporan/surveilans-triage-igd', 'Pasien\Laporan\PostController@surveilansTriageIGD');

			Route::post('/printlaporan/kunjungan', 'Pasien\Laporan\PostController@kunjungan');
			Route::post('/printlaporan/pengunjung-rj-triwulan', 'Pasien\Laporan\PostController@pengunjungRawatJalanTriwulan');
			Route::post('/printlaporan/kunjungan-igd-triwulan', 'Pasien\Laporan\PostController@kunjunganIGDTriwulan');
			Route::post('/printlaporan/pengunjung-igd-triwulan', 'Pasien\Laporan\PostController@pengunjungIGDTriwulan');
			Route::post('/printlaporan/kunjungan-unit-tindakan-triwulan', 'Pasien\Laporan\PostController@kunjunganUnitTindakanTriwulan');
			Route::post('/printlaporan/laporan-kematian-bpjs', 'Pasien\Laporan\PostController@kematianBPJS');
			Route::post('/printlaporan/10-besar-penyakit-penyebab-meninggal', 'Pasien\Laporan\PostController@sepuluhBesarPenyakitPenyebabMeninggal');

			Route::post('/printlaporan/laporan-perawatan-integrasi', 'Pasien\Laporan\PostController@perawatanIntegrasi');
			Route::post('/printlaporan/laporan-kegiatan-rs', 'Pasien\Laporan\PostController@kegiatanRS');
			Route::post('/printlaporan/laporan-penderita-hipertensi', 'Pasien\Laporan\PostController@penderitaHipertensi_4B');
			Route::post('/printlaporan/laporan-penderita-hipertensi-4a', 'Pasien\Laporan\PostController@penderitaHipertensi_4A');
			Route::post('/printlaporan/laporan-penderita-hipertensi-4c', 'Pasien\Laporan\PostController@penderitaHipertensi_4C');

			Route::post('/printlaporan/laporan-persalinan', 'Pasien\Laporan\PostController@persalinan');
			Route::post('/printlaporan/penderita-usia-15-59', 'Pasien\Laporan\PostController@penderitaUsia1559');

			Route::post('/printlaporan/rincian-pasien-ranap', 'Pasien\Laporan\PostController@rincianPasienRanap');
			Route::post('/printlaporan/rincian-harian-pasien-dirawat', 'Pasien\Laporan\PostController@rincianHarianPasienDirawat');
			Route::post('/printlaporan/pengunjung-pulang', 'Pasien\Laporan\PostController@pengunjungPulang');
			Route::post('/printlaporan/kemoterapi-radioterapi', 'Pasien\Laporan\PostController@kemoterapiRadioterapi');
			Route::post('/printlaporan/kematian-bayi-balita', 'Pasien\Laporan\PostController@kematianBayiBalita');
			Route::post('/printlaporan/sars', 'Pasien\Laporan\PostController@sars');
			Route::post('/printlaporan/baru-lama', 'Pasien\Laporan\PostController@baruLama');
			Route::post('/printlaporan/wabah', 'Pasien\Laporan\PostController@wabah');
			Route::post('/printlaporan/pasien-jiwa', 'Pasien\Laporan\PostController@pasienJiwa');
			Route::post('/printlaporan/diabetes-bulanan', 'Pasien\Laporan\PostController@diabetesBulanan');
			Route::post('/printlaporan/diabetes-baru', 'Pasien\Laporan\PostController@diabetesBaru');
			Route::post('/printlaporan/ppi', 'Pasien\Laporan\PostController@ppi');
			Route::post('/printlaporan/kanker-baru', 'Pasien\Laporan\PostController@kankerBaru');

			Route::post('/printlaporan/pasien-rawat-jalan', 'Pasien\Laporan\PostController@pasienRawatJalan');
			Route::post('/printlaporan/pasien-rawat-inap', 'Pasien\Laporan\PostController@pasienRawatInap');
			Route::post('/printlaporan/wabah-mingguan', 'Pasien\Laporan\PostController@wabahMingguan');
			Route::post('/printlaporan/lahir-mati', 'Pasien\Laporan\PostController@lahirMati');
			Route::post('/printlaporan/laporan-katarak', 'Pasien\Laporan\PostController@katarak');
			Route::post('/printlaporan/rujukan-rs', 'Pasien\Laporan\PostController@rujukan');
			Route::get('/printlaporan/rekap-jumlah-kasus-user', 'Pasien\Laporan\PostController@rekapJumlahKasusUser');

			Route::post('/printlaporan/laporan-aktifitas-poli-psikologi', 'Pasien\Laporan\PostController@laporanAktifitasPoliPsikologi');
			Route::get('/printlaporan/rl-1-2-indikator-pelayanan', 'Pasien\Laporan\ViewController@indikatorPelayanan');
			Route::get('/printlaporan/rl-1-2-indikator-pelayanan/get-data', 'Pasien\Laporan\IndikatorPelayanan@getData');
			Route::post('/printlaporan/data-pasien-igd', 'Pasien\Laporan\PostController@dataPasienIgd');
			Route::post('/printlaporan/data-pasien-mcu', 'Pasien\Laporan\PostController@dataPasienMcu');

			Route::post('printlaporan/laporan-sensus-rawat-inap', 'Pasien\Laporan\PostController@sensusRawatInap');
			Route::post('printlaporan/laporan-sensus-rawat-inap-ruangan', 'Pasien\Laporan\PostController@sensusRawatInapRuangan');
		});


		Route::group(['prefix' => 'laporan-v2'], function () {
			Route::get('/', 'Pasien\LaporanV2\Index\ViewController@laporanIndex');


			Route::group(['prefix' => 'page'], function () {
				Route::get('data-rincian-igd', 'Pasien\LaporanV2\Page\DataRincianIGD\ViewController@index');
				Route::get('data-rincian-rawat-inap', 'Pasien\LaporanV2\Page\DataRincianRanap\ViewController@index');
				Route::get('data-rincian-rawat-jalan', 'Pasien\LaporanV2\Page\DataRincianRajal\ViewController@index');
				Route::get('data-rincian-medical-checkup', 'Pasien\LaporanV2\Page\DataRincianMCU\ViewController@index');
				Route::get('laporan-surveilans-covid', 'Pasien\LaporanV2\Page\LaporanSurveilansCovid\ViewController@index');
				Route::get('rl-1-2-indikator-pelayanan', 'Pasien\LaporanV2\Page\RL12IndikatorPelayanan\ViewController@index');
				Route::get('rawat-inap-laporan-10-besar-penyakit-per-bangsal', 'Pasien\LaporanV2\Page\RawatInapLaporan10BesarPenyakitPerBangsal\ViewController@index');
				Route::get('rawat-jalan-laporan-10-besar-penyakit-per-klinik', 'Pasien\LaporanV2\Page\RawatJalanLaporan10BesarPenyakitPerKlinik\ViewController@index');
				Route::get('igd-laporan-10-besar-penyakit', 'Pasien\LaporanV2\Page\IGDLaporan10BesarPenyakit\ViewController@index');
				Route::get('rl-1-2-indikator-pelayanan', 'Pasien\LaporanV2\Page\RL12IndikatorPelayanan\ViewController@index');
				Route::get('rl-13-tempat-tidur', 'Pasien\LaporanV2\Page\RL13TempatTidur\ViewController@index');
				Route::get('rl-34-kebidanan', 'Pasien\LaporanV2\Page\RL34Kebidanan\ViewController@index');
				Route::get('rl-36-pembedahan', 'Pasien\LaporanV2\Page\RL36Pembedahan\ViewController@index');
				Route::get('rl-37-radiologi', 'Pasien\LaporanV2\Page\RL37Radiologi\ViewController@index');
				Route::get('rl-38-laboratorium', 'Pasien\LaporanV2\Page\RL38Laboratorium\ViewController@index');
				Route::get('rl-35-perinatologi', 'Pasien\LaporanV2\Page\RL35Perinatologi\ViewController@index');
				Route::get('rl-33-gigi-mulut', 'Pasien\LaporanV2\Page\RL33GigiMulut\ViewController@index');
				Route::get('rl-39-rehab-medik', 'Pasien\LaporanV2\Page\RL39RehabMedik\ViewController@index');
				Route::get('rl-310-pelayanan-khusus', 'Pasien\LaporanV2\Page\RL310PelayananKhusus\ViewController@index');
				Route::get('rl-311-kesehatan-jiwa', 'Pasien\LaporanV2\Page\RL311KesehatanJiwa\ViewController@index');
				Route::get('rl-314-rujukan', 'Pasien\LaporanV2\Page\RL314Rujukan\ViewController@index');
				Route::get('rl-315-cara-bayar', 'Pasien\LaporanV2\Page\RL315CaraBayar\ViewController@index');
				Route::get('rl-313a-obat-pengadaan', 'Pasien\LaporanV2\Page\RL313aObatPengadaan\ViewController@index');
				Route::get('rl-313b-obat-pelayanan-resep', 'Pasien\LaporanV2\Page\RL313bObatPelayananResep\ViewController@index');
				Route::get('rl-51-pengunjung', 'Pasien\LaporanV2\Page\RL51Pengunjung\ViewController@index');
				Route::get('rl-53-10-besar-penyakit-ranap', 'Pasien\LaporanV2\Page\RL5310BesarPenyakitRanap\ViewController@index');
				Route::get('rl-54-10-besar-penyakit-rajal', 'Pasien\LaporanV2\Page\RL5410BesarPenyakitRajal\ViewController@index');
				Route::get('rl-4-penyakit-rawat-inap', 'Pasien\LaporanV2\Page\RL4PenyakitRawatInap\ViewController@index');
				Route::get('rl-4-penyakit-rawat-jalan', 'Pasien\LaporanV2\Page\RL4PenyakitRawatJalan\ViewController@index');
				Route::get('rl-3-1-rawat-inap', 'Pasien\LaporanV2\Page\RL31RawatInap\ViewController@index');
				Route::get('rl-52-kunjungan-rawat-jalan', 'Pasien\LaporanV2\Page\RL52KunjunganRawatJalan\ViewController@index');
				Route::get('rl-521-kunjungan-rawat-inap', 'Pasien\LaporanV2\Page\RL521KunjunganRawatInap\ViewController@index');
				Route::get('rl-522-kunjungan-gangguan-jiwa', 'Pasien\LaporanV2\Page\RL522KunjunganGangguanJiwa\ViewController@index');
				Route::get('rl-3-2-rawat-darurat', 'Pasien\LaporanV2\Page\RL32RawatDarurat\ViewController@index');
				Route::get('dkk-4-laporan-mingguan-w2-rs', 'Pasien\LaporanV2\Page\DKK4LaporanMingguanW2RS\ViewController@index');
				Route::get('dkk-34-laporan-bulanan-diare', 'Pasien\LaporanV2\Page\DKK34LaporanBulananDiare\ViewController@index');
				Route::post('dkk-34-laporan-bulanan-diare/download', 'Pasien\LaporanV2\Page\DKK34LaporanBulananDiare\PostController@download');
				Route::get('dkk-7-laporan-bulanan-katarak', 'Pasien\LaporanV2\Page\DKK7LaporanBulananKatarak\ViewController@index');
				Route::post('dkk-7-laporan-bulanan-katarak/download', 'Pasien\LaporanV2\Page\DKK7LaporanBulananKatarak\PostController@download');
				Route::get('dkk-33-laporan-bulanan-ispa', 'Pasien\LaporanV2\Page\DKK33LaporanBulananIspa\ViewController@index');
				Route::post('dkk-33-laporan-bulanan-ispa/download', 'Pasien\LaporanV2\Page\DKK33LaporanBulananIspa\PostController@download');
				Route::get('dkk-19-laporan-bulanan-kematian-rs', 'Pasien\LaporanV2\Page\DKK19LaporanBulananKematianRs\ViewController@index');
				Route::post('dkk-19-laporan-bulanan-kematian-rs/download', 'Pasien\LaporanV2\Page\DKK19LaporanBulananKematianRs\PostController@download');
				Route::get('dkk-22-laporan-bulanan-stp-rawat-jalan', 'Pasien\LaporanV2\Page\DKK22LaporanBulananSTPRawatJalan\ViewController@index');
				Route::get('dkk-23-laporan-bulanan-stp-rawat-inap', 'Pasien\LaporanV2\Page\DKK23LaporanBulananSTPRawatInap\ViewController@index');
				Route::get('dkk-18-laporan-bulanan-pelayanan-geriatri', 'Pasien\LaporanV2\Page\DKK18LaporanBulananPelayananGeriatri\ViewController@index');
				Route::post('dkk-18-laporan-bulanan-pelayanan-geriatri/download', 'Pasien\LaporanV2\Page\DKK18LaporanBulananPelayananGeriatri\PostController@download');
				Route::get('dkk-5-laporan-bulanan-kunjungan-rawat-jalan-penderita-baru-lama-p2ptm-keswa', 'Pasien\LaporanV2\Page\DKK5LaporanKunjunganRawatJalanPenderitaBaruLamaP2ptmKeswa\ViewController@index');
				Route::post('dkk-5-laporan-bulanan-kunjungan-rawat-jalan-penderita-baru-lama-p2ptm-keswa/download', 'Pasien\LaporanV2\Page\DKK5LaporanKunjunganRawatJalanPenderitaBaruLamaP2ptmKeswa\PostController@download');
				Route::get('dkk-11-laporan-bulanan-persalinan', 'Pasien\LaporanV2\Page\DKK11LaporanBulananPersalinan\ViewController@index');
				Route::post('dkk-11-laporan-bulanan-persalinan/download', 'Pasien\LaporanV2\Page\DKK11LaporanBulananPersalinan\PostController@download');
				Route::get('dkk-15-laporan-bulanan-lahir-mati', 'Pasien\LaporanV2\Page\DKK15LaporanBulananLahirMati\ViewController@index');
				Route::post('dkk-15-laporan-bulanan-lahir-mati/download', 'Pasien\LaporanV2\Page\DKK15LaporanBulananLahirMati\PostController@download');
				Route::get('dkk-10-laporan-bulanan-kematian-ibu', 'Pasien\LaporanV2\Page\DKK10LaporanBulananKematianIbu\ViewController@index');
				Route::post('dkk-10-laporan-bulanan-kematian-ibu/download', 'Pasien\LaporanV2\Page\DKK10LaporanBulananKematianIbu\PostController@download');
				Route::get('laporan-asal-rujukan-rajal-ranap-igd', 'Pasien\LaporanV2\Page\LaporanAsalRujukanRajal\ViewController@index');
				Route::get('laporan-rekap-perdokter', 'Pasien\LaporanV2\Page\LaporanRekapPerdokter\ViewController@index');
				Route::get('laporan-perdokter', 'Pasien\LaporanV2\Page\LaporanPerdokter\ViewController@index');
				Route::get('laporan-kunjungan-unit-tindakan', 'Pasien\LaporanV2\Page\LaporanKunjunganUnitTindakan\ViewController@index');
			});
		});

		Route::get('baru', 'Pasien\Pasien\ViewController@new');
		Route::get('baru/keluarga', 'Pasien\Pasien\ViewController@newKeluarga');
		Route::get('baru/pembayaran', 'Pasien\Pasien\ViewController@newPembayaran');


		Route::get('list-pasien', 'Pasien\Pasien\ViewController@listPasien');
		Route::post('baru', 'Pasien\Pasien\PostController@createPasien');
		Route::get('/import/pembayaran', 'Pasien\Import@pembayaran');
		Route::get('/import/pembayaranNew', 'Pasien\Import@pembayaranNew');
		Route::get('/import/updateJenisKel', 'Pasien\Import@updateJenisKel');
		Route::get('/import/updateRelasi', 'Pasien\Import@updateRelasi');
		Route::get('/import/updateWali', 'Pasien\Import@updateWali');
		Route::get('/import/kelas', 'Pasien\Import@updateKelas');
		Route::get('{id}', 'Pasien\Pasien\ViewController@profile');
		Route::get('{id}/print/profile', 'Pasien\Pasien\ViewController@printprofile');
		Route::get('{id}/print/gelang', 'Pasien\Pasien\ViewController@printgelang');
		Route::get('{id}/print/label', 'Pasien\Pasien\ViewController@printlabel');
		Route::get('{id}/print/kartu', 'Pasien\Pasien\ViewController@printkartu');
		Route::get('{id}/print/ktp', 'Pasien\Pasien\ViewController@printKtp');
		Route::get('{id}/print/gelangdewasa', 'Pasien\Pasien\ViewController@printgelangdewasa');
		Route::get('{id}/print/gelangbayi', 'Pasien\Pasien\ViewController@printgelangbayi');
		Route::get('{id}/print/ringkasan-ranap', 'Pasien\Pasien\ViewController@ringkasanRanap');
		Route::get('{id}/print/ringkasan-rajal', 'Pasien\Pasien\ViewController@ringkasanRajal');
		Route::get('{id}/print/prmrj', 'Pasien\Pasien\ViewController@prmrj');
		Route::get('{id}/print/general-consent', 'Pasien\Pasien\ViewController@generalConsent');
		Route::get('{id}/print/general-consent-treatment', 'Pasien\Pasien\ViewController@generalConsent');
		Route::get('{id}/print/tindakan-kedokteran', 'Pasien\Pasien\ViewController@tindakanKedokteran');
		Route::get('{id}/edit', 'Pasien\Pasien\ViewController@edit');
		Route::post('{id}/edit', 'Pasien\Pasien\PostController@editPasien');
		Route::get('{id}/edit/kerabat', 'Pasien\Pasien\ViewController@editKerabat');
		Route::post('{id}/edit/kerabat', 'Pasien\Pasien\PostController@editKerabat');
		Route::get('{id}/pembayaran/baru', 'Pasien\Pasien\ViewController@baruBayar');
		Route::get('{id}/pembayaran/edit/{bayar}', 'Pasien\Pasien\ViewController@editPembayaran');
		Route::post('{id}/pembayaran/delete', 'Pasien\PasienPembayaran\DeleteController@delete');
		Route::post('{id}/pembayaran/jadikan-utama', 'Pasien\Pasien\EditController@setPembayaranUtama');
		Route::get('{id}/pendaftaran/{id_antrian?}', 'Pasien\Pasien\ViewController@baruDaftar');
		Route::get('{id}/pendaftaran-inap', 'Pasien\Pasien\ViewController@daftarInap');
		Route::post('{id}/pendaftaran-inap/submit', 'Pasien\Pasien\PostController@daftarInap');
		Route::get('{id}/{kasus}/rujuk/igd', 'Pasien\Pasien\ViewController@rujukIGD');
		Route::get('{id}/{kasus}/rujuk/rawatjalan', 'Pasien\Pasien\ViewController@rujukRJ');
		Route::get('{id}/print/aktivitas-poli-psikologi', 'Pasien\Pasien\ViewController@aktivitasPoliPsikologi');

		Route::get('{id}/pernyataan-pilih-dokter', 'Pasien\PernyataanPilihDokter\ViewController@index');
		Route::post('{id}/pernyataan-pilih-dokter/save', 'Pasien\PernyataanPilihDokter\PostController@submit');
		Route::post('{id}/pernyataan-pilih-dokter/delete', 'Pasien\PernyataanPilihDokter\PostController@delete');
		Route::get('{id}/pernyataan-pilih-dokter/print/{id_surat}', 'Pasien\PernyataanPilihDokter\ViewController@print');

		Route::get('{id}/permohonan-pindah-kelas', 'Pasien\PermohonanPindahKelas\ViewController@index');
		Route::post('{id}/permohonan-pindah-kelas/save', 'Pasien\PermohonanPindahKelas\PostController@submit');
		Route::post('{id}/permohonan-pindah-kelas/delete', 'Pasien\PermohonanPindahKelas\PostController@delete');
		Route::get('{id}/permohonan-pindah-kelas/print/{id_surat}', 'Pasien\PermohonanPindahKelas\ViewController@print');
		Route::post('download/berkas', 'Pasien\Pasien\ReadController@downloadBerkas');
		
		Route::get('/asesmen/general-consent', 'Kasus\Asesmen\GeneralConsent\ViewController@create');
		Route::get("/asesmen/general-consent/single", "Kasus\Asesmen\GeneralConsent\ViewController@single");
		Route::get("/asesmen/general-consent/form/edit", "Kasus\Asesmen\GeneralConsent\ViewController@edit");
		Route::post("/asesmen/general-consent/form/create", "Kasus\Asesmen\GeneralConsent\CreateController@create");
		Route::put("/asesmen/general-consent/form/edit", "Kasus\Asesmen\GeneralConsent\EditController@edit");
		Route::get("/asesmen/general-consent/print", "Kasus\Asesmen\GeneralConsent\ViewController@print");
		Route::post("/asesmen/general-consent/delete", "Kasus\Asesmen\GeneralConsent\DeleteController@delete");
		Route::post("/asesmen/general-consent/add-ttd", "Kasus\Asesmen\GeneralConsent\PostController@addTTD");

		Route::get('/asesmen/general-consent-treatment', 'Kasus\Asesmen\GeneralConsentTreatment\ViewController@create');
		Route::get("/asesmen/general-consent-treatment/single", "Kasus\Asesmen\GeneralConsentTreatment\ViewController@single");
		Route::get("/asesmen/general-consent-treatment/form/edit", "Kasus\Asesmen\GeneralConsentTreatment\ViewController@edit");
		Route::post("/asesmen/general-consent-treatment/form/create", "Kasus\Asesmen\GeneralConsentTreatment\CreateController@create");
		Route::put("/asesmen/general-consent-treatment/form/edit", "Kasus\Asesmen\GeneralConsentTreatment\EditController@edit");
		Route::get("/asesmen/general-consent-treatment/print", "Kasus\Asesmen\GeneralConsentTreatment\ViewController@print");
		Route::post("/asesmen/general-consent-treatment/delete", "Kasus\Asesmen\GeneralConsentTreatment\DeleteController@delete");
		Route::post("/asesmen/general-consent-treatment/add-ttd", "Kasus\Asesmen\GeneralConsentTreatment\PostController@addTTD");
	});
});

Route::group(['prefix' => 'api/pasien'], function () {
	Route::get('/get', 'Pasien\Pasien\ReadController@get');
	Route::get('/get-daftar-online', 'Pasien\Pasien\ViewController@getDaftarOnline');
    Route::get('/get-daftar-online-batal', 'Pasien\Pasien\ViewController@getDaftarOnlineBatal');
	Route::get('/get-pasien-baru-online', 'Pasien\Pasien\ViewController@getPasienBaruOnline');
	Route::get('/get-pembayaran-utama', 'Pasien\Pasien\ReadController@APIGetSingle');
	Route::get('/get-bpjs/{keyword}', 'Pasien\Pasien\ReadController@getBPJS');
	Route::get('/get-bpjs-by-id/{id}', 'Pasien\Pasien\ReadController@getBPJSById');
	Route::group(['prefix' => 'statistik'], function () {
		Route::get('/', 'Pasien\Pasien\ReadController@getStatistik');
		Route::get('pasienbaru', 'Pasien\Pasien\ReadController@statistikPasienBaru');
		Route::get('jenispasien', 'Pasien\Pasien\ReadController@statistikJenisPasien');
		Route::get('kunjungan', 'Pasien\Pasien\ReadController@statistikKunjungan');
		Route::get('lamabaru', 'Pasien\Pasien\ReadController@statistikLamaBaru');
	});
	Route::get('/filter', 'Pasien\Pasien\ReadController@filter');
	Route::post('/baru', 'Pasien\Pasien\PostController@APICreatePasien');
	Route::post('/edit', 'Pasien\Pasien\PostController@APIEditPasien');
	Route::post('/kerabat/edit', 'Pasien\PasienWali\EditController@APIEditKerabatPasien');
	Route::get('/alamat/provinsi/get', 'Pasien\AlamatProvinsi\ReadController@get');
	Route::get('/alamat/kota/get', 'Pasien\AlamatKota\ReadController@get');
	Route::get('/alamat/kota/search/{id}', 'Pasien\AlamatKota\ReadController@search');
	Route::get('/alamat/kecamatan/get/{id}', 'Pasien\AlamatKecamatan\ReadController@get');
	Route::get('/alamat/kelurahan/get/{id}', 'Pasien\AlamatKelurahan\ReadController@get');
	Route::get('/asuransi/perusahaan/get', 'Pasien\Asuransi\ReadController@getAll');
	Route::get('/kerjasama/perusahaan/get', 'Pasien\PerusahaanKerjasama\ReadController@getAll');
	Route::post('/pembayaran/baru', 'Pasien\Pasien\PostController@APIPembayaranBaru');
	Route::post('/pembayaran/edit', 'Pasien\Pasien\PostController@APIPembayaranEdit');
	Route::post('/pendaftaran/baru', 'Pasien\Pasien\PostController@APIPendaftaranPasien');
	//Route::post('/pendaftaran/igd/baru', 'IGD\Transaksi\PostController@APIsubmitRuangan');
	//Route::post('/pendaftaran/rawatjalan/baru', 'RawatJalan\Transaksi\PostController@APIsubmitAntrian');

	Route::get('/pendaftaran/poli/get/{id}', 'RawatJalan\Transaksi\ReadController@APIsinglePoli');
	Route::get('/pendaftaran/poli/get-histori/{poli_id}/{pasien_id}', 'RawatJalan\Transaksi\ReadController@APIcekHistoriKunjunganPasienPoli');
	Route::get('/pendaftaran/metode/get/{id}', 'Pasien\Pasien\ReadController@APIsinglePembayaran');
    Route::post('/pendaftaran/antrian', 'RawatJalan\Transaksi\PostController@generateAntrianPasien');
	Route::post('/check/nama', 'Pasien\Pasien\ReadController@APIcheckNama');
	Route::post('/check/nomor', 'Pasien\Pasien\ReadController@APIcheckNomor');
	Route::post('/check/pembayaran', 'Pasien\Pasien\ReadController@APIcheckPembayaran');

	Route::get('{id}/kasus/', 'Pasien\Pasien\ReadController@APIGetKasus');
	Route::get('{id}/kasus-with-krs/', 'Pasien\Pasien\ReadController@APIGetKasusWithKRS');

	Route::get('/pangkat/get/{id}', 'Pasien\Keanggotaan\ReadController@getPangkat');
	Route::get('/satker/get/{id}', 'Pasien\Keanggotaan\ReadController@getSatker');

	Route::post('/rujukan/baru', 'Pasien\Pasien\CreateController@APIAsalRujukan');


	Route::get('/admin-update-index/{min}/{max}', 'Pasien\Pasien\EditController@adminUpdateIndex');
	Route::get('/data-sync-sim-lama/{min}/{max}', 'Pasien\Pasien\PostController@dataSyncSIMLama');

	Route::post('asal-rujukan', 'Pasien\Pasien\PostController@asalRujukan');

	Route::group(['prefix' => 'laporan-v2'], function () {
		Route::group(['prefix' => 'page'], function () {
			Route::get('data-rincian-igd/get-total-data', 'Pasien\LaporanV2\Page\DataRincianIGD\APIController@getTotalData');
			Route::get('data-rincian-igd/get-data', 'Pasien\LaporanV2\Page\DataRincianIGD\APIController@getData');
			Route::get('data-rincian-rawat-inap/get-total-data', 'Pasien\LaporanV2\Page\DataRincianRanap\APIController@getTotalData');
			Route::get('data-rincian-rawat-inap/get-data', 'Pasien\LaporanV2\Page\DataRincianRanap\APIController@getData');
			Route::get('data-rincian-rawat-jalan/get-total-data', 'Pasien\LaporanV2\Page\DataRincianRajal\APIController@getTotalData');
			Route::get('data-rincian-rawat-jalan/get-data', 'Pasien\LaporanV2\Page\DataRincianRajal\APIController@getData');
			Route::get('data-rincian-medical-checkup/get-total-data', 'Pasien\LaporanV2\Page\DataRincianMCU\APIController@getTotalData');
			Route::get('data-rincian-medical-checkup/get-data', 'Pasien\LaporanV2\Page\DataRincianMCU\APIController@getData');
			Route::get('laporan-surveilans-covid/get-total-data', 'Pasien\LaporanV2\Page\LaporanSurveilansCovid\APIController@getTotalData');
			Route::get('laporan-surveilans-covid/get-data', 'Pasien\LaporanV2\Page\LaporanSurveilansCovid\APIController@getData');
			Route::get('rl-12-indikator-pelayanan/get-data', 'Pasien\LaporanV2\Page\RL12IndikatorPelayanan\APIController@getData');
			Route::get('rawat-inap-laporan-10-besar-penyakit-per-bangsal/get-total-data', 'Pasien\LaporanV2\Page\RawatInapLaporan10BesarPenyakitPerBangsal\APIController@getTotalData');
			Route::get('rawat-inap-laporan-10-besar-penyakit-per-bangsal/get-data', 'Pasien\LaporanV2\Page\RawatInapLaporan10BesarPenyakitPerBangsal\APIController@getData');
			Route::get('rawat-jalan-laporan-10-besar-penyakit-per-klinik/get-total-data', 'Pasien\LaporanV2\Page\RawatJalanLaporan10BesarPenyakitPerKlinik\APIController@getTotalData');
			Route::get('rawat-jalan-laporan-10-besar-penyakit-per-klinik/get-data', 'Pasien\LaporanV2\Page\RawatJalanLaporan10BesarPenyakitPerKlinik\APIController@getData');
			Route::get('igd-laporan-10-besar-penyakit/get-total-data', 'Pasien\LaporanV2\Page\IGDLaporan10BesarPenyakit\APIController@getTotalData');
			Route::get('igd-laporan-10-besar-penyakit/get-data', 'Pasien\LaporanV2\Page\IGDLaporan10BesarPenyakit\APIController@getData');
			Route::get('rl-12-indikator-pelayanan/get-data', 'Pasien\LaporanV2\Page\RL12IndikatorPelayanan\APIController@getData');
			Route::get('rl-13-tempat-tidur/get-total-data', 'Pasien\LaporanV2\Page\RL13TempatTidur\APIController@getTotalData');
			Route::get('rl-13-tempat-tidur/get-data', 'Pasien\LaporanV2\Page\RL13TempatTidur\APIController@getData');
			Route::get('rl-34-kebidanan/get-total-data', 'Pasien\LaporanV2\Page\RL34Kebidanan\APIController@getTotalData');
			Route::get('rl-34-kebidanan/get-data', 'Pasien\LaporanV2\Page\RL34Kebidanan\APIController@getData');
			Route::get('rl-36-pembedahan/get-total-data', 'Pasien\LaporanV2\Page\RL36Pembedahan\APIController@getTotalData');
			Route::get('rl-36-pembedahan/get-data', 'Pasien\LaporanV2\Page\RL36Pembedahan\APIController@getData');
			Route::get('rl-37-radiologi/get-total-data', 'Pasien\LaporanV2\Page\RL37Radiologi\APIController@getTotalData');
			Route::get('rl-37-radiologi/get-data', 'Pasien\LaporanV2\Page\RL37Radiologi\APIController@getData');
			Route::get('rl-38-laboratorium/get-total-data', 'Pasien\LaporanV2\Page\RL38Laboratorium\APIController@getTotalData');
			Route::get('rl-38-laboratorium/get-data', 'Pasien\LaporanV2\Page\RL38Laboratorium\APIController@getData');
			Route::get('rl-35-perinatologi/get-total-data', 'Pasien\LaporanV2\Page\RL35Perinatologi\APIController@getTotalData');
			Route::get('rl-35-perinatologi/get-data', 'Pasien\LaporanV2\Page\RL35Perinatologi\APIController@getData');
			Route::get('rl-33-gigi-mulut/get-total-data', 'Pasien\LaporanV2\Page\RL33GigiMulut\APIController@getTotalData');
			Route::get('rl-33-gigi-mulut/get-data', 'Pasien\LaporanV2\Page\RL33GigiMulut\APIController@getData');
			Route::get('rl-39-rehab-medik/get-total-data', 'Pasien\LaporanV2\Page\RL39RehabMedik\APIController@getTotalData');
			Route::get('rl-39-rehab-medik/get-data', 'Pasien\LaporanV2\Page\RL39RehabMedik\APIController@getData');
			Route::get('rl-310-pelayanan-khusus/get-total-data', 'Pasien\LaporanV2\Page\RL310PelayananKhusus\APIController@getTotalData');
			Route::get('rl-310-pelayanan-khusus/get-data', 'Pasien\LaporanV2\Page\RL310PelayananKhusus\APIController@getData');
			Route::get('rl-311-kesehatan-jiwa/get-total-data', 'Pasien\LaporanV2\Page\RL311KesehatanJiwa\APIController@getTotalData');
			Route::get('rl-311-kesehatan-jiwa/get-data', 'Pasien\LaporanV2\Page\RL311KesehatanJiwa\APIController@getData');
			Route::get('rl-313a-obat-pengadaan/get-total-data', 'Pasien\LaporanV2\Page\RL313aObatPengadaan\APIController@getTotalData');
			Route::get('rl-313a-obat-pengadaan/get-data', 'Pasien\LaporanV2\Page\RL313aObatPengadaan\APIController@getData');
			Route::get('rl-313b-obat-pelayanan-resep/get-total-data', 'Pasien\LaporanV2\Page\RL313bObatPelayananResep\APIController@getTotalData');
			Route::get('rl-313b-obat-pelayanan-resep/get-data', 'Pasien\LaporanV2\Page\RL313bObatPelayananResep\APIController@getData');
			Route::get('rl-51-pengunjung/get-total-data', 'Pasien\LaporanV2\Page\RL51Pengunjung\APIController@getTotalData');
			Route::get('rl-51-pengunjung/get-data', 'Pasien\LaporanV2\Page\RL51Pengunjung\APIController@getData');
			Route::get('rl-53-10-besar-penyakit-ranap/get-total-data', 'Pasien\LaporanV2\Page\RL5310BesarPenyakitRanap\APIController@getTotalData');
			Route::get('rl-53-10-besar-penyakit-ranap/get-data', 'Pasien\LaporanV2\Page\RL5310BesarPenyakitRanap\APIController@getData');
			Route::get('rl-54-10-besar-penyakit-rajal/get-total-data', 'Pasien\LaporanV2\Page\RL5410BesarPenyakitRajal\APIController@getTotalData');
			Route::get('rl-54-10-besar-penyakit-rajal/get-data', 'Pasien\LaporanV2\Page\RL5410BesarPenyakitRajal\APIController@getData');
			Route::get('rl-314-rujukan/get-total-data', 'Pasien\LaporanV2\Page\RL314Rujukan\APIController@getTotalData');
			Route::get('rl-314-rujukan/get-data', 'Pasien\LaporanV2\Page\RL314Rujukan\APIController@getData');
			Route::get('rl-315-cara-bayar/get-total-data', 'Pasien\LaporanV2\Page\RL315CaraBayar\APIController@getTotalData');
			Route::get('rl-315-cara-bayar/get-data', 'Pasien\LaporanV2\Page\RL315CaraBayar\APIController@getData');
			Route::get('rl-4-penyakit-rawat-jalan/get-total-data', 'Pasien\LaporanV2\Page\RL4PenyakitRawatJalan\APIController@getTotalData');
			Route::get('rl-4-penyakit-rawat-jalan/get-data', 'Pasien\LaporanV2\Page\RL4PenyakitRawatJalan\APIController@getData');
			Route::get('rl-4-penyakit-rawat-inap/get-total-data', 'Pasien\LaporanV2\Page\RL4PenyakitRawatInap\APIController@getTotalData');
			Route::get('rl-4-penyakit-rawat-inap/get-data', 'Pasien\LaporanV2\Page\RL4PenyakitRawatInap\APIController@getData');
			Route::get('rl-3-1-rawat-inap/get-total-data', 'Pasien\LaporanV2\Page\RL31RawatInap\APIController@getTotalData');
			Route::get('rl-3-1-rawat-inap/get-data', 'Pasien\LaporanV2\Page\RL31RawatInap\APIController@getData');
			Route::get('rl-3-2-rawat-darurat/get-total-data', 'Pasien\LaporanV2\Page\RL32RawatDarurat\APIController@getTotalData');
			Route::get('rl-3-2-rawat-darurat/get-data', 'Pasien\LaporanV2\Page\RL32RawatDarurat\APIController@getData');
			Route::get('rl-52-kunjungan-rawat-jalan/get-total-data', 'Pasien\LaporanV2\Page\RL52KunjunganRawatJalan\APIController@getTotalData');
			Route::get('rl-52-kunjungan-rawat-jalan/get-data', 'Pasien\LaporanV2\Page\RL52KunjunganRawatJalan\APIController@getData');
			Route::get('rl-521-kunjungan-rawat-inap/get-total-data', 'Pasien\LaporanV2\Page\RL521KunjunganRawatInap\APIController@getTotalData');
			Route::get('rl-521-kunjungan-rawat-inap/get-data', 'Pasien\LaporanV2\Page\RL521KunjunganRawatInap\APIController@getData');
			Route::get('rl-522-kunjungan-gangguan-jiwa/get-total-data', 'Pasien\LaporanV2\Page\RL522KunjunganGangguanJiwa\APIController@getTotalData');
			Route::get('rl-522-kunjungan-gangguan-jiwa/get-data', 'Pasien\LaporanV2\Page\RL522KunjunganGangguanJiwa\APIController@getData');
			Route::get('dkk-4-laporan-mingguan-w2-rs/get-total-data', 'Pasien\LaporanV2\Page\DKK4LaporanMingguanW2RS\APIController@getTotalData');
			Route::get('dkk-4-laporan-mingguan-w2-rs/get-data', 'Pasien\LaporanV2\Page\DKK4LaporanMingguanW2RS\APIController@getData');
			Route::get('dkk-34-laporan-bulanan-diare/get-total-data', 'Pasien\LaporanV2\Page\DKK34LaporanBulananDiare\APIController@getTotalData');
			Route::get('dkk-34-laporan-bulanan-diare/get-data', 'Pasien\LaporanV2\Page\DKK34LaporanBulananDiare\APIController@getData');
			Route::get('dkk-7-laporan-bulanan-katarak/get-total-data', 'Pasien\LaporanV2\Page\DKK7LaporanBulananKatarak\APIController@getTotalData');
			Route::get('dkk-7-laporan-bulanan-katarak/get-data', 'Pasien\LaporanV2\Page\DKK7LaporanBulananKatarak\APIController@getData');
			Route::get('dkk-33-laporan-bulanan-ispa/get-total-data', 'Pasien\LaporanV2\Page\DKK33LaporanBulananIspa\APIController@getTotalData');
			Route::get('dkk-33-laporan-bulanan-ispa/get-data', 'Pasien\LaporanV2\Page\DKK33LaporanBulananIspa\APIController@getData');
			Route::get('dkk-19-laporan-bulanan-kematian-rs/get-total-data', 'Pasien\LaporanV2\Page\DKK19LaporanBulananKematianRs\APIController@getTotalData');
			Route::get('dkk-19-laporan-bulanan-kematian-rs/get-data', 'Pasien\LaporanV2\Page\DKK19LaporanBulananKematianRs\APIController@getData');
			Route::get('dkk-22-laporan-bulanan-stp-rawat-jalan/get-total-data', 'Pasien\LaporanV2\Page\DKK22LaporanBulananSTPRawatJalan\APIController@getTotalData');
			Route::get('dkk-22-laporan-bulanan-stp-rawat-jalan/get-data', 'Pasien\LaporanV2\Page\DKK22LaporanBulananSTPRawatJalan\APIController@getData');
			Route::get('dkk-23-laporan-bulanan-stp-rawat-inap/get-total-data', 'Pasien\LaporanV2\Page\DKK23LaporanBulananSTPRawatInap\APIController@getTotalData');
			Route::get('dkk-23-laporan-bulanan-stp-rawat-inap/get-data', 'Pasien\LaporanV2\Page\DKK23LaporanBulananSTPRawatInap\APIController@getData');
			Route::get('dkk-18-laporan-bulanan-pelayanan-geriatri/get-total-data', 'Pasien\LaporanV2\Page\DKK18LaporanBulananPelayananGeriatri\APIController@getTotalData');
			Route::get('dkk-18-laporan-bulanan-pelayanan-geriatri/get-data', 'Pasien\LaporanV2\Page\DKK18LaporanBulananPelayananGeriatri\APIController@getData');
			Route::get('dkk-5-laporan-bulanan-kunjungan-rawat-jalan-penderita-baru-lama-p2ptm-keswa/get-total-data', 'Pasien\LaporanV2\Page\DKK5LaporanKunjunganRawatJalanPenderitaBaruLamaP2ptmKeswa\APIController@getTotalData');
			Route::get('dkk-5-laporan-bulanan-kunjungan-rawat-jalan-penderita-baru-lama-p2ptm-keswa/get-data', 'Pasien\LaporanV2\Page\DKK5LaporanKunjunganRawatJalanPenderitaBaruLamaP2ptmKeswa\APIController@getData');
			Route::get('dkk-11-laporan-bulanan-persalinan/get-total-data', 'Pasien\LaporanV2\Page\DKK11LaporanBulananPersalinan\APIController@getTotalData');
			Route::get('dkk-11-laporan-bulanan-persalinan/get-data', 'Pasien\LaporanV2\Page\DKK11LaporanBulananPersalinan\APIController@getData');
			Route::get('dkk-15-laporan-bulanan-lahir-mati/get-total-data', 'Pasien\LaporanV2\Page\DKK15LaporanBulananLahirMati\APIController@getTotalData');
			Route::get('dkk-15-laporan-bulanan-lahir-mati/get-data', 'Pasien\LaporanV2\Page\DKK15LaporanBulananLahirMati\APIController@getData');
			Route::get('dkk-10-laporan-bulanan-kematian-ibu/get-total-data', 'Pasien\LaporanV2\Page\DKK10LaporanBulananKematianIbu\APIController@getTotalData');
			Route::get('dkk-10-laporan-bulanan-kematian-ibu/get-data', 'Pasien\LaporanV2\Page\DKK10LaporanBulananKematianIbu\APIController@getData');
			Route::get('laporan-asal-rujukan-rajal-ranap-igd/get-total-data', 'Pasien\LaporanV2\Page\LaporanAsalRujukanRajal\APIController@getTotalData');
			Route::get('laporan-asal-rujukan-rajal-ranap-igd/get-data', 'Pasien\LaporanV2\Page\LaporanAsalRujukanRajal\APIController@getData');
			Route::get('laporan-rekap-perdokter/get-total-data', 'Pasien\LaporanV2\Page\LaporanRekapPerdokter\APIController@getTotalData');
			Route::get('laporan-rekap-perdokter/get-data', 'Pasien\LaporanV2\Page\LaporanRekapPerdokter\APIController@getData');
			Route::get('laporan-perdokter/get-total-data', 'Pasien\LaporanV2\Page\LaporanPerdokter\APIController@getTotalData');
			Route::get('laporan-perdokter/get-data', 'Pasien\LaporanV2\Page\LaporanPerdokter\APIController@getData');
			Route::get('laporan-kunjungan-unit-tindakan/get-total-data', 'Pasien\LaporanV2\Page\LaporanKunjunganUnitTindakan\APIController@getTotalData');
			Route::get('laporan-kunjungan-unit-tindakan/get-data', 'Pasien\LaporanV2\Page\LaporanKunjunganUnitTindakan\APIController@getData');
		});
	});
});
