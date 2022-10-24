<?php
Route::group(['middleware' => ['check-module']], function(){
	Route::group(['prefix' => 'mutu'], function() {
		Route::get('/', 'Mutu\Audit\ViewController@index');

		Route::get('/audit', 'Mutu\Audit\ViewController@index');
		Route::get('/laporan', 'Mutu\Laporan\ViewController@index');

		Route::group(['prefix' => 'audit'], function() {
			Route::get('/', 'Mutu\Audit\ViewController@index');
			Route::get('/hh', 'Mutu\Audit\ViewController@hh');
			Route::post('/hh/create', 'Mutu\Audit\PostController@hh');
			Route::post('/hh/edit/{id}', 'Mutu\Audit\PostController@hhEdit');
			Route::post('/hh/delete', 'Mutu\Audit\PostController@hhDelete');

			Route::get('/dekubitus', 'Mutu\Audit\ViewController@dekubitus');
			Route::post('/dekubitus/create', 'Mutu\Audit\PostController@dekubitus');
			Route::post('/dekubitus/edit/{id}', 'Mutu\Audit\PostController@dekubitusEdit');
			Route::post('/dekubitus/delete', 'Mutu\Audit\PostController@dekubitusDelete');

			Route::get('/minmed', 'Mutu\Audit\ViewController@minmed');
			Route::post('/minmed/create', 'Mutu\Audit\PostController@minmed');
			Route::post('/minmed/edit/{id}', 'Mutu\Audit\PostController@minmedEdit');
			Route::post('/minmed/delete', 'Mutu\Audit\PostController@dekubitusDelete');

			Route::get('/identifikasi-resiko', 'Mutu\Audit\ViewController@identifikasiResiko');
			Route::post('/identifikasi-resiko/create', 'Mutu\Audit\PostController@identifikasiResiko');
			Route::post('/identifikasi-resiko/delete', 'Mutu\Audit\PostController@identifikasiResikoDelete');

			Route::get('/kegiatan-pengendalian', 'Mutu\Audit\ViewController@kegiatanPengendalian');
			Route::post('/kegiatan-pengendalian/create', 'Mutu\Audit\PostController@kegiatanPengendalian');
			Route::post('/kegiatan-pengendalian/delete', 'Mutu\Audit\PostController@kegiatanPengendalianDelete');

			Route::get('/evaluasi-kegiatan-pengendalian', 'Mutu\Audit\ViewController@evaluasiKegiatanPengendalian');
			Route::post('/evaluasi-kegiatan-pengendalian/create', 'Mutu\Audit\PostController@evaluasiKegiatanPengendalian');
			Route::post('/evaluasi-kegiatan-pengendalian/delete', 'Mutu\Audit\PostController@evaluasiKegiatanPengendalianDelete');

		});

		Route::group(['prefix' => 'laporan'], function() {

			Route::get('/', 'Mutu\Laporan\ViewController@index');
			Route::get('/{unit}', 'Mutu\Laporan\ViewController@unit');

			Route::group(['prefix' => 'ppi'], function() {
				Route::get('/iad', 'Mutu\Laporan\PostController@iad');
				Route::get('/isk', 'Mutu\Laporan\PostController@isk');
				Route::get('/ido', 'Mutu\Laporan\PostController@ido');
				Route::get('/vap', 'Mutu\Laporan\PostController@vap');
				Route::get('/iad-surveilans', 'Mutu\Laporan\PostController@iadSurveilans');
				Route::get('/isk-surveilans', 'Mutu\Laporan\PostController@iskSurveilans');
				Route::get('/ido-surveilans', 'Mutu\Laporan\PostController@idoSurveilans');
				Route::get('/vap-surveilans', 'Mutu\Laporan\PostController@vapSurveilans');
				Route::get('/cuci-tangan', 'Mutu\Laporan\PostController@cuciTangan');
				Route::get('/kejadian-dekubitus', 'Mutu\Laporan\PostController@kejadianDekubitus');
				Route::get('/kejadian-hap', 'Mutu\Laporan\PostController@kejadianHap');
				Route::get('/kejadian-plebitis', 'Mutu\Laporan\PostController@kejadianPlebitis');
				Route::get('/kepatuhan-sepsis', 'Mutu\Laporan\PostController@kepatuhanSepsis');
			});

			Route::group(['prefix' => 'rawat-jalan'], function() {
				Route::get('/waktu-tunggu', 'Mutu\Laporan\PostController@waktuTunggu');
				Route::get('/jam-buka', 'Mutu\Laporan\PostController@jamBuka');
			});
			
			Route::group(['prefix' => 'rawat-inap'], function() {
				Route::get('/kepatuhan-identifikasi', 'Mutu\Laporan\PostController@kepatuhanIdentifikasi');
				Route::get('/kejadian-jatuh', 'Mutu\Laporan\PostController@kejadianJatuh');
				Route::get('/kepatuhan-visite', 'Mutu\Laporan\PostController@kepatuhanVisite');
				Route::get('/penilaian-cppt-kehadiran-dpjp', 'Mutu\Laporan\PostController@penilaianCPPTKehadiranDPJP');
			});

			Route::group(['prefix' => 'gigi-mulut'], function() {
				Route::get('/gilut-ketepatan', 'Mutu\Laporan\PostController@gilutKetepatan');
			});
			
			Route::group(['prefix' => 'tht'], function() {
				Route::get('/tht-cwd', 'Mutu\Laporan\PostController@thtCWD');
				Route::get('/tht-laring', 'Mutu\Laporan\PostController@thtLaring');
				Route::get('/tht-septoplasti', 'Mutu\Laporan\PostController@thtSeptoplasti');
				Route::get('/tht-sinusitis', 'Mutu\Laporan\PostController@thtSinusitis');
			});
			
			Route::group(['prefix' => 'mata'], function() {
				Route::get('/audit-mata', 'Mutu\Laporan\PostController@mata');
			});
			
			Route::group(['prefix' => 'bedah'], function() {
				Route::get('/kesesuaian-bedah', 'Mutu\Laporan\PostController@kesesuaianBedah');
				Route::get('/kesesuaian-asesmen-pra-bedah', 'Mutu\Laporan\PostController@kesesuaianAsesmenPraBedah');
			});
			
			Route::group(['prefix' => 'lab-pa'], function() {
				Route::get('/labpa', 'Mutu\Laporan\PostController@labpa');
			});
			
			Route::group(['prefix' => 'lab-pk-ppra'], function() {
				Route::get('/labpk-goldar', 'Mutu\Laporan\PostController@labpkGoldar');
				Route::get('/labpk-bakteri', 'Mutu\Laporan\PostController@labpkBakteri');
			});
			
			Route::group(['prefix' => 'radiologi'], function() {
				Route::get('/radiologi-film', 'Mutu\Laporan\PostController@radiologiFilm');
				Route::get('/radiologi-ketepatan-usg', 'Mutu\Laporan\PostController@radiologiKetepatanUSG');
				Route::get('/radiologi-ketepatan-konvensional', 'Mutu\Laporan\PostController@radiologiKetepatanKonvensional');
			});
			
			Route::group(['prefix' => 'satma-humas'], function() {
				Route::get('/k3', 'Mutu\Laporan\PostController@k3');
				Route::get('/kuisioner-penilaian', 'Mutu\Laporan\PostController@kuisionerPenilaian');
				Route::get('/humas-komplain', 'Mutu\Laporan\PostController@humasKomplain');
				Route::get('/harmat/listrik-mati', 'Mutu\Laporan\PostController@listrikMati');
				Route::get('/harmat/perbaikan-alat', 'Mutu\Laporan\PostController@perbaikanAlat');
			});
			
			Route::group(['prefix' => 'igd'], function() {
				Route::get('/audit-igd', 'Mutu\Laporan\PostController@igd');
				Route::get('/kematian-pasien-48', 'Mutu\Laporan\PostController@kematianPasien48');
				Route::get('/kematian-24-jam', 'Mutu\Laporan\PostController@kematianPasienIgd24');
			});
			
			Route::group(['prefix' => 'it'], function() {
				Route::get('/laporan-it', 'Mutu\Laporan\PostController@it');
			});

            Route::group(['prefix' => 'keselamatan-kerja'], function() {
                Route::get('/laporan-identifikasi-resiko', 'Mutu\Laporan\PostController@keselamatanKerja');
				Route::get('/insiden-k3', 'Mutu\Laporan\PostController@insidenK3');
            });

			Route::group(['prefix' => 'spm-penunjang'], function() {
                Route::get('/radiologi', 'Mutu\Laporan\PostController@radiologiSPM');
				Route::get('/lab-pk', 'Mutu\Laporan\PostController@labPKSPM');
            });

			Route::group(['prefix' => 'audit'], function () {
				Route::get('/identifikasi-resiko', 'Mutu\Laporan\PostController@identifikasiResiko');
				Route::get('/kegiatan-pengendalian', 'Mutu\Laporan\PostController@kegiatanPengendalian');
				Route::get('/evaluasi-kegiatan-pengendalian', 'Mutu\Laporan\PostController@evaluasiKegiatanPengendalian');
			});

			Route::get('/pengumpulan-data-review', 'Mutu\Laporan\ViewController@pengumpulanDataReview');
			Route::get('/checklist-edukasi-stroke', 'Mutu\Laporan\ViewController@checklistEdukasiStroke');
			
			Route::get('/pengaturan/mata', 'Mutu\Pengaturan\ViewController@mata');
			Route::post('/pengaturan/mata', 'Mutu\Pengaturan\PostController@mata');
			Route::get('/pengaturan/labpa', 'Mutu\Pengaturan\ViewController@labPA');
			Route::post('/pengaturan/labpa/{slug}', 'Mutu\Pengaturan\PostController@labPA');
			Route::get('/pengaturan/radiologi-ketepatan-usg', 'Mutu\Pengaturan\ViewController@radiologiKetepatanUSG');
			Route::post('/pengaturan/radiologi-ketepatan-usg', 'Mutu\Pengaturan\PostController@radiologiKetepatanUSG');
			Route::get('/pengaturan/radiologi-ketepatan-konvensional', 'Mutu\Pengaturan\ViewController@radiologiKetepatanKonvensional');
			Route::post('/pengaturan/radiologi-ketepatan-konvensional', 'Mutu\Pengaturan\PostController@radiologiKetepatanKonvensional');
			
			Route::get('/gizi', 'Mutu\Laporan\PostController@gizi');
			Route::get('/rehabmed', 'Mutu\Laporan\PostController@rehabmed');
			Route::get('/pd-jantung', 'Mutu\Laporan\PostController@jantungPD');
			Route::get('/steroid', 'Mutu\Laporan\PostController@steroid');
			Route::get('/couter', 'Mutu\Laporan\PostController@couter');
			Route::get('/dermatits', 'Mutu\Laporan\PostController@dermatits');
		});

	});
	Route::group(['prefix' => 'api/mutu'], function() {
		Route::get('/audit/hh/{id}', 'Mutu\Audit\ReadController@get');
		Route::get('/audit/identifikasi-resiko/get-data', 'Mutu\Audit\ViewController@identifikasiResikoGetData');
		Route::get('/audit/kegiatan-pengendalian/get-data', 'Mutu\Audit\ViewController@kegiatanPengendalianGetData');
		Route::get('/audit/evaluasi-kegiatan-pengendalian/get-data', 'Mutu\Audit\ViewController@evaluasiKegiatanPengendalianGetData');
	});

});
