<?php

Route::get("/alat-bantu/mini-mental-state-examination/", "Kasus\AlatBantu\MiniMentalStateExamination\ViewController@index");
Route::post("/alat-bantu/mini-mental-state-examination/save", "Kasus\AlatBantu\MiniMentalStateExamination\PostController@save");
Route::post("/alat-bantu/mini-mental-state-examination/delete", "Kasus\AlatBantu\MiniMentalStateExamination\PostController@delete");
Route::get("/alat-bantu/mini-mental-state-examination/print", "Kasus\AlatBantu\MiniMentalStateExamination\ViewController@print");

Route::get("/alat-bantu/instrumen-activity-daily-living/", "Kasus\AlatBantu\InstrumenActivityDailyLiving\ViewController@index");
Route::post("/alat-bantu/instrumen-activity-daily-living/save", "Kasus\AlatBantu\InstrumenActivityDailyLiving\PostController@save");
Route::post("/alat-bantu/instrumen-activity-daily-living/delete", "Kasus\AlatBantu\InstrumenActivityDailyLiving\PostController@delete");
Route::get("/alat-bantu/instrumen-activity-daily-living/print", "Kasus\AlatBantu\InstrumenActivityDailyLiving\ViewController@print");

Route::get("/alat-bantu/asesmen-napza-rawat-jalan-non-ipwl/", "Kasus\AlatBantu\AsesmenNapzaRawatJalanNonIPWL\ViewController@index");
Route::post("/alat-bantu/asesmen-napza-rawat-jalan-non-ipwl/save", "Kasus\AlatBantu\AsesmenNapzaRawatJalanNonIPWL\PostController@save");
Route::post("/alat-bantu/asesmen-napza-rawat-jalan-non-ipwl/delete", "Kasus\AlatBantu\AsesmenNapzaRawatJalanNonIPWL\PostController@delete");
Route::get("/alat-bantu/asesmen-napza-rawat-jalan-non-ipwl/print/{id}", "Kasus\AlatBantu\AsesmenNapzaRawatJalanNonIPWL\ViewController@print");

Route::get("/alat-bantu/asesmen-napza/", "Kasus\AlatBantu\AsesmenNapza\ViewController@index");
Route::post("/alat-bantu/asesmen-napza/save", "Kasus\AlatBantu\AsesmenNapza\PostController@save");
Route::post("/alat-bantu/asesmen-napza/delete", "Kasus\AlatBantu\AsesmenNapza\PostController@delete");
Route::get("/alat-bantu/asesmen-napza/print/{id}", "Kasus\AlatBantu\AsesmenNapza\ViewController@print");

Route::get("/alat-bantu/whodas/", "Kasus\AlatBantu\Whodas\ViewController@index");
Route::post("/alat-bantu/whodas/save", "Kasus\AlatBantu\Whodas\PostController@save");
Route::post("/alat-bantu/whodas/delete", "Kasus\AlatBantu\Whodas\PostController@delete");
Route::get("/alat-bantu/whodas/print/{id}", "Kasus\AlatBantu\Whodas\ViewController@print");

Route::get("/alat-bantu/skrinning-ulang-gizi/", "Kasus\AlatBantu\SkrinningUlangGizi\ViewController@index");
Route::post("/alat-bantu/skrinning-ulang-gizi/save", "Kasus\AlatBantu\SkrinningUlangGizi\PostController@save");
Route::post("/alat-bantu/skrinning-ulang-gizi/delete", "Kasus\AlatBantu\SkrinningUlangGizi\PostController@delete");
Route::get("/alat-bantu/skrinning-ulang-gizi/print", "Kasus\AlatBantu\SkrinningUlangGizi\ViewController@print");

Route::get("/alat-bantu/surat-keterangan-dalam-perawatan/", "Kasus\AlatBantu\SuratKeteranganDalamPerawatan\ViewController@index");
Route::post("/alat-bantu/surat-keterangan-dalam-perawatan/save", "Kasus\AlatBantu\SuratKeteranganDalamPerawatan\PostController@save");
Route::post("/alat-bantu/surat-keterangan-dalam-perawatan/delete", "Kasus\AlatBantu\SuratKeteranganDalamPerawatan\PostController@delete");
Route::get("/alat-bantu/surat-keterangan-dalam-perawatan/print/{id}", "Kasus\AlatBantu\SuratKeteranganDalamPerawatan\ViewController@print");

Route::get("/alat-bantu/pemeriksaan-psikologi-visum/", "Kasus\AlatBantu\PemeriksaanPsikologiVisum\ViewController@index");
Route::post("/alat-bantu/pemeriksaan-psikologi-visum/save", "Kasus\AlatBantu\PemeriksaanPsikologiVisum\PostController@save");
Route::post("/alat-bantu/pemeriksaan-psikologi-visum/delete", "Kasus\AlatBantu\PemeriksaanPsikologiVisum\PostController@delete");
Route::get("/alat-bantu/pemeriksaan-psikologi-visum/print/{id}", "Kasus\AlatBantu\PemeriksaanPsikologiVisum\ViewController@print");

Route::get("/alat-bantu/tes-iq-keswara/", "Kasus\AlatBantu\TesIQKeswara\ViewController@index");
Route::post("/alat-bantu/tes-iq-keswara/save", "Kasus\AlatBantu\TesIQKeswara\PostController@save");
Route::post("/alat-bantu/tes-iq-keswara/delete", "Kasus\AlatBantu\TesIQKeswara\PostController@delete");
Route::get("/alat-bantu/tes-iq-keswara/print/{id}", "Kasus\AlatBantu\TesIQKeswara\ViewController@print");

Route::get("/alat-bantu/tes-iq/", "Kasus\AlatBantu\TesIQ\ViewController@index");
Route::post("/alat-bantu/tes-iq/save", "Kasus\AlatBantu\TesIQ\PostController@save");
Route::post("/alat-bantu/tes-iq/delete", "Kasus\AlatBantu\TesIQ\PostController@delete");
Route::get("/alat-bantu/tes-iq/print/{id}", "Kasus\AlatBantu\TesIQ\ViewController@print");

Route::get("/alat-bantu/psikogram-visum/", "Kasus\AlatBantu\PsikogramVisum\ViewController@index");
Route::post("/alat-bantu/psikogram-visum/save", "Kasus\AlatBantu\PsikogramVisum\PostController@save");
Route::post("/alat-bantu/psikogram-visum/delete", "Kasus\AlatBantu\PsikogramVisum\PostController@delete");
Route::get("/alat-bantu/psikogram-visum/print/{id}", "Kasus\AlatBantu\PsikogramVisum\ViewController@print");

Route::get("/alat-bantu/surat-sehat-rohani/", "Kasus\AlatBantu\SuratSehatRohani\ViewController@index");
Route::post("/alat-bantu/surat-sehat-rohani/save", "Kasus\AlatBantu\SuratSehatRohani\PostController@save");
Route::post("/alat-bantu/surat-sehat-rohani/delete", "Kasus\AlatBantu\SuratSehatRohani\PostController@delete");
Route::get("/alat-bantu/surat-sehat-rohani/print/{id}", "Kasus\AlatBantu\SuratSehatRohani\ViewController@print");

Route::get("/alat-bantu/penilaian-kualitas-hidup-lansia/", "Kasus\AlatBantu\PenilaianKualitasHidupLansia\ViewController@index");
Route::post("/alat-bantu/penilaian-kualitas-hidup-lansia/save", "Kasus\AlatBantu\PenilaianKualitasHidupLansia\PostController@save");
Route::post("/alat-bantu/penilaian-kualitas-hidup-lansia/delete", "Kasus\AlatBantu\PenilaianKualitasHidupLansia\PostController@delete");
Route::get("/alat-bantu/penilaian-kualitas-hidup-lansia/print", "Kasus\AlatBantu\PenilaianKualitasHidupLansia\ViewController@print");

Route::get("/alat-bantu/surat-pasien-pulang-rumah-sakit/", "Kasus\AlatBantu\SuratPasienPulangRumahSakit\ViewController@index");
Route::post("/alat-bantu/surat-pasien-pulang-rumah-sakit/save", "Kasus\AlatBantu\SuratPasienPulangRumahSakit\PostController@save");
Route::post("/alat-bantu/surat-pasien-pulang-rumah-sakit/delete", "Kasus\AlatBantu\SuratPasienPulangRumahSakit\PostController@delete");
Route::get("/alat-bantu/surat-pasien-pulang-rumah-sakit/print/{id}", "Kasus\AlatBantu\SuratPasienPulangRumahSakit\ViewController@print");

Route::get("/alat-bantu/surat-persetujuan-dirawat/", "Kasus\AlatBantu\SuratPersetujuanDirawat\ViewController@index");
Route::post("/alat-bantu/surat-persetujuan-dirawat/save", "Kasus\AlatBantu\SuratPersetujuanDirawat\PostController@save");
Route::post("/alat-bantu/surat-persetujuan-dirawat/delete", "Kasus\AlatBantu\SuratPersetujuanDirawat\PostController@delete");
Route::get("/alat-bantu/surat-persetujuan-dirawat/print/{id}", "Kasus\AlatBantu\SuratPersetujuanDirawat\ViewController@print");

Route::get("/alat-bantu/surat-permintaan-masuk-rumah-sakit/", "Kasus\AlatBantu\SuratPermintaanMasukRumahSakit\ViewController@index");
Route::post("/alat-bantu/surat-permintaan-masuk-rumah-sakit/save", "Kasus\AlatBantu\SuratPermintaanMasukRumahSakit\PostController@save");
Route::post("/alat-bantu/surat-permintaan-masuk-rumah-sakit/delete", "Kasus\AlatBantu\SuratPermintaanMasukRumahSakit\PostController@delete");
Route::get("/alat-bantu/surat-permintaan-masuk-rumah-sakit/print/{id}", "Kasus\AlatBantu\SuratPermintaanMasukRumahSakit\ViewController@print");

Route::get("/alat-bantu/asesmen-bebas-narkoba/", "Kasus\AlatBantu\AsesmenBebasNarkoba\ViewController@index");
Route::post("/alat-bantu/asesmen-bebas-narkoba/save", "Kasus\AlatBantu\AsesmenBebasNarkoba\PostController@save");
Route::post("/alat-bantu/asesmen-bebas-narkoba/delete", "Kasus\AlatBantu\AsesmenBebasNarkoba\PostController@delete");
Route::get("/alat-bantu/asesmen-bebas-narkoba/print/{id}", "Kasus\AlatBantu\AsesmenBebasNarkoba\ViewController@print");

Route::get("/alat-bantu/geriatric-depression-scale/", "Kasus\AlatBantu\GeriatricDepressionScale\ViewController@index");
Route::post("/alat-bantu/geriatric-depression-scale/save", "Kasus\AlatBantu\GeriatricDepressionScale\PostController@save");
Route::post("/alat-bantu/geriatric-depression-scale/delete", "Kasus\AlatBantu\GeriatricDepressionScale\PostController@delete");
Route::get("/alat-bantu/geriatric-depression-scale/print/{id}", "Kasus\AlatBantu\GeriatricDepressionScale\ViewController@print");

Route::get("/alat-bantu/surat-keterangan-pemeriksaan-kematian/", "Kasus\AlatBantu\SuratKeteranganPemeriksaanKematian\ViewController@index");
Route::post("/alat-bantu/surat-keterangan-pemeriksaan-kematian/save", "Kasus\AlatBantu\SuratKeteranganPemeriksaanKematian\PostController@save");
Route::post("/alat-bantu/surat-keterangan-pemeriksaan-kematian/delete", "Kasus\AlatBantu\SuratKeteranganPemeriksaanKematian\PostController@delete");
Route::get("/alat-bantu/surat-keterangan-pemeriksaan-kematian/print/{id}", "Kasus\AlatBantu\SuratKeteranganPemeriksaanKematian\ViewController@print");

Route::get("/alat-bantu/asesmen-risiko-jatuh-psikiatri/", "Kasus\AlatBantu\AsesmenRisikoJatuhPsikiatri\ViewController@index");
Route::post("/alat-bantu/asesmen-risiko-jatuh-psikiatri/save", "Kasus\AlatBantu\AsesmenRisikoJatuhPsikiatri\PostController@save");
Route::post("/alat-bantu/asesmen-risiko-jatuh-psikiatri/delete", "Kasus\AlatBantu\AsesmenRisikoJatuhPsikiatri\PostController@delete");
Route::get("/alat-bantu/asesmen-risiko-jatuh-psikiatri/print", "Kasus\AlatBantu\AsesmenRisikoJatuhPsikiatri\ViewController@print");


Route::get("/alat-bantu/managemen-dan-asesmen-ulang-nyeri/", "Kasus\AlatBantu\ManagemenDanAsesmenUlangNyeri\ViewController@index");
Route::post("/alat-bantu/managemen-dan-asesmen-ulang-nyeri/save", "Kasus\AlatBantu\ManagemenDanAsesmenUlangNyeri\PostController@save");
Route::post("/alat-bantu/managemen-dan-asesmen-ulang-nyeri/delete", "Kasus\AlatBantu\ManagemenDanAsesmenUlangNyeri\PostController@delete");
Route::get('/alat-bantu/managemen-dan-asesmen-ulang-nyeri/print', 'Kasus\AlatBantu\ManagemenDanAsesmenUlangNyeri\ViewController@print');

Route::get("/alat-bantu/testing-form-asesmen/", "Kasus\AlatBantu\TestingFormAsesmen\ViewController@index");
Route::post("/alat-bantu/testing-form-asesmen/save", "Kasus\AlatBantu\TestingFormAsesmen\PostController@save");
Route::post("/alat-bantu/testing-form-asesmen/delete", "Kasus\AlatBantu\TestingFormAsesmen\PostController@delete");

Route::get('/alat-bantu', 'Kasus\AlatBantu\ViewController@index');
Route::get('/alat-bantu/mews', 'Kasus\AlatBantu\MEWS\ViewController@index');
Route::post('/alat-bantu/mews/create', 'Kasus\AlatBantu\MEWS\PostController@create');
Route::post('/alat-bantu/mews/delete', 'Kasus\AlatBantu\MEWS\PostController@delete');

Route::get('/alat-bantu/norton', 'Kasus\AlatBantu\Norton\ViewController@index');
Route::post('/alat-bantu/norton/create', 'Kasus\AlatBantu\Norton\PostController@create');
Route::post('/alat-bantu/norton/delete', 'Kasus\AlatBantu\Norton\PostController@delete');
Route::post('/alat-bantu/norton/create-surveilans', 'Kasus\AlatBantu\Norton\PostController@createSurveilans');
Route::post('/alat-bantu/norton/edit-surveilans', 'Kasus\AlatBantu\Norton\PostController@editSurveilans');
Route::post('/alat-bantu/norton/delete-surveilans', 'Kasus\AlatBantu\Norton\PostController@deleteSurveilans');

Route::get('/alat-bantu/morse', 'Kasus\AlatBantu\Morse\ViewController@index');
Route::post('/alat-bantu/morse/tatalaksana', 'Kasus\AlatBantu\Morse\PostController@tatalaksana');
Route::post('/alat-bantu/morse/create', 'Kasus\AlatBantu\Morse\PostController@create');
Route::post('/alat-bantu/morse/delete', 'Kasus\AlatBantu\Morse\PostController@delete');

Route::get('/alat-bantu/aldrete', 'Kasus\AlatBantu\Aldrete\ViewController@index');
Route::post('/alat-bantu/aldrete/create', 'Kasus\AlatBantu\Aldrete\PostController@create');
Route::post('/alat-bantu/aldrete/delete', 'Kasus\AlatBantu\DeleteController@delete');

Route::get('/alat-bantu/ews-hamil', 'Kasus\AlatBantu\EwsHamil\ViewController@index');
Route::post('/alat-bantu/ews-hamil/create', 'Kasus\AlatBantu\EwsHamil\PostController@create');
Route::post('/alat-bantu/ews-hamil/delete', 'Kasus\AlatBantu\DeleteController@delete');

Route::get('/alat-bantu/gastro', 'Kasus\AlatBantu\Gastro\ViewController@index');
Route::post('/alat-bantu/gastro/create', 'Kasus\AlatBantu\Gastro\PostController@create');
Route::post('/alat-bantu/gastro/delete', 'Kasus\AlatBantu\Gastro\PostController@delete');

Route::get('/alat-bantu/defekasi', 'Kasus\AlatBantu\Defekasi\ViewController@index');
Route::post('/alat-bantu/defekasi/create', 'Kasus\AlatBantu\Defekasi\PostController@create');
Route::post('/alat-bantu/defekasi/delete', 'Kasus\AlatBantu\Defekasi\PostController@delete');

Route::get('/alat-bantu/miksi', 'Kasus\AlatBantu\Miksi\ViewController@index');
Route::post('/alat-bantu/miksi/create', 'Kasus\AlatBantu\Miksi\PostController@create');
Route::post('/alat-bantu/miksi/delete', 'Kasus\AlatBantu\Miksi\PostController@delete');

Route::get('/alat-bantu/gcs', 'Kasus\AlatBantu\GCS\ViewController@index');
Route::post('/alat-bantu/gcs/create', 'Kasus\AlatBantu\GCS\PostController@create');
Route::post('/alat-bantu/gcs/delete', 'Kasus\AlatBantu\GCS\PostController@delete');

Route::get('/alat-bantu/jatuh', 'Kasus\AlatBantu\Jatuh\ViewController@index');
Route::post('/alat-bantu/jatuh/create', 'Kasus\AlatBantu\Jatuh\PostController@create');
// Route::post('/alat-bantu/jatuh/delete', 'Kasus\AlatBantu\Jatuh\PostController@delete');
Route::post('/alat-bantu/jatuh/tatalaksana', 'Kasus\AlatBantu\Jatuh\PostController@addTataLaksana');

Route::get('/alat-bantu/humpty-dumpty', 'Kasus\AlatBantu\HumptyDumpty\ViewController@index');
Route::post('/alat-bantu/humpty-dumpty/create', 'Kasus\AlatBantu\HumptyDumpty\PostController@create');
Route::post('/alat-bantu/humpty-dumpty/delete', 'Kasus\AlatBantu\HumptyDumpty\PostController@delete');
Route::post('/alat-bantu/humpty-dumpty/tatalaksana', 'Kasus\AlatBantu\HumptyDumpty\PostController@addTataLaksana');

Route::get('/alat-bantu/edukasi-pasien', 'Kasus\AlatBantu\EdukasiPasien\ViewController@index');
Route::post('/alat-bantu/edukasi-pasien/create', 'Kasus\AlatBantu\EdukasiPasien\PostController@create');
Route::post('/alat-bantu/edukasi-pasien/delete', 'Kasus\AlatBantu\EdukasiPasien\PostController@delete');

Route::get('/alat-bantu/triage', 'Kasus\AlatBantu\Triage\ViewController@index');
Route::post('/alat-bantu/triage/create', 'Kasus\AlatBantu\Triage\PostController@create');
Route::post('/alat-bantu/triage/create-from-exist', 'Kasus\AlatBantu\Triage\PostController@addFromExist');
Route::post('/alat-bantu/triage/delete', 'Kasus\AlatBantu\Triage\PostController@delete');

Route::get('/alat-bantu/apgar', 'Kasus\AlatBantu\APGAR\ViewController@index');
Route::post('/alat-bantu/apgar/create', 'Kasus\AlatBantu\APGAR\PostController@create');
Route::post('/alat-bantu/apgar/delete', 'Kasus\AlatBantu\APGAR\PostController@delete');

Route::get('/alat-bantu/poedji', 'Kasus\AlatBantu\Poedji\ViewController@index');
Route::post('/alat-bantu/poedji/create', 'Kasus\AlatBantu\Poedji\PostController@create');
Route::post('/alat-bantu/poedji/edit', 'Kasus\AlatBantu\Poedji\PostController@edit');
Route::post('/alat-bantu/poedji/delete', 'Kasus\AlatBantu\Poedji\PostController@delete');

Route::get('/alat-bantu/edukasi', 'Kasus\AlatBantu\Edukasi\ViewController@index');
Route::post('/alat-bantu/edukasi/create', 'Kasus\AlatBantu\Edukasi\PostController@create');
Route::post('/alat-bantu/edukasi/edit', 'Kasus\AlatBantu\Edukasi\PostController@edit');
Route::post('/alat-bantu/edukasi/delete', 'Kasus\AlatBantu\Edukasi\PostController@delete');

Route::get('/alat-bantu/pulang', 'Kasus\AlatBantu\Pulang\ViewController@index');
Route::post('/alat-bantu/pulang/create', 'Kasus\AlatBantu\Pulang\PostController@create');
Route::post('/alat-bantu/pulang/edit', 'Kasus\AlatBantu\Pulang\PostController@edit');
Route::post('/alat-bantu/pulang/delete', 'Kasus\AlatBantu\Pulang\PostController@delete');

Route::get('/alat-bantu/nyeri', 'Kasus\AlatBantu\Nyeri\ViewController@index');
Route::post('/alat-bantu/nyeri/create', 'Kasus\AlatBantu\Nyeri\PostController@create');
Route::post('/alat-bantu/nyeri/edit', 'Kasus\AlatBantu\Nyeri\PostController@edit');
Route::post('/alat-bantu/nyeri/delete', 'Kasus\AlatBantu\Nyeri\PostController@delete');

Route::get('/alat-bantu/pews', 'Kasus\AlatBantu\PEWS\ViewController@index');
Route::post('/alat-bantu/pews/create', 'Kasus\AlatBantu\PEWS\PostController@create');
Route::post('/alat-bantu/pews/edit', 'Kasus\AlatBantu\PEWS\PostController@edit');
Route::post('/alat-bantu/pews/delete', 'Kasus\AlatBantu\PEWS\PostController@delete');

Route::get('/alat-bantu/gizi', 'Kasus\AlatBantu\Gizi\ViewController@index');
Route::post('/alat-bantu/gizi/create', 'Kasus\AlatBantu\Gizi\PostController@create');
Route::post('/alat-bantu/gizi/edit', 'Kasus\AlatBantu\Gizi\PostController@edit');
Route::post('/alat-bantu/gizi/delete', 'Kasus\AlatBantu\Gizi\PostController@delete');

Route::post('gizi/asesmen-awal/create', 'Kasus\AlatBantu\Gizi\PostController@create');
Route::post('gizi/asesmen-awal/edit', 'Kasus\AlatBantu\Gizi\PostController@edit');
Route::post('gizi/asesmen-awal/delete', 'Kasus\AlatBantu\Gizi\PostController@delete');

Route::get('/alat-bantu/asa', 'Kasus\AlatBantu\ASA\ViewController@index');
Route::post('/alat-bantu/asa/create', 'Kasus\AlatBantu\ASA\PostController@create');
Route::post('/alat-bantu/asa/delete', 'Kasus\AlatBantu\ASA\PostController@delete');

Route::get('/alat-bantu/killip', 'Kasus\AlatBantu\Killip\ViewController@index');
Route::post('/alat-bantu/killip/create', 'Kasus\AlatBantu\Killip\PostController@create');
Route::post('/alat-bantu/killip/delete', 'Kasus\AlatBantu\Killip\PostController@delete');

Route::get('/alat-bantu/triss', 'Kasus\AlatBantu\Triss\ViewController@index');
Route::post('/alat-bantu/triss/create', 'Kasus\AlatBantu\Triss\PostController@create');
Route::post('/alat-bantu/triss/delete', 'Kasus\AlatBantu\Triss\PostController@delete');

Route::get('/alat-bantu/down-score', 'Kasus\AlatBantu\DownScore\ViewController@index');
Route::post('/alat-bantu/down-score/create', 'Kasus\AlatBantu\DownScore\PostController@create');
Route::post('/alat-bantu/down-score/delete', 'Kasus\AlatBantu\DownScore\PostController@delete');

Route::get('/alat-bantu/flacc', 'Kasus\AlatBantu\Flacc\ViewController@index');
Route::post('/alat-bantu/flacc/create', 'Kasus\AlatBantu\Flacc\PostController@create');
Route::post('/alat-bantu/flacc/delete', 'Kasus\AlatBantu\Flacc\PostController@delete');

Route::get('/alat-bantu/timi-stemi', 'Kasus\AlatBantu\TimiStemi\ViewController@index');
Route::post('/alat-bantu/timi-stemi/create', 'Kasus\AlatBantu\TimiStemi\PostController@create');
Route::post('/alat-bantu/timi-stemi/delete', 'Kasus\AlatBantu\TimiStemi\PostController@delete');

Route::get('/alat-bantu/psi', 'Kasus\AlatBantu\PSI\ViewController@index');
Route::post('/alat-bantu/psi/create', 'Kasus\AlatBantu\PSI\PostController@create');
Route::post('/alat-bantu/psi/delete', 'Kasus\AlatBantu\PSI\PostController@delete');

Route::get('/alat-bantu/sofa', 'Kasus\AlatBantu\SOFA\ViewController@index');
Route::post('/alat-bantu/sofa/create', 'Kasus\AlatBantu\SOFA\PostController@create');
Route::post('/alat-bantu/sofa/delete', 'Kasus\AlatBantu\SOFA\PostController@delete');

Route::get('/alat-bantu/ket-kelahiran', 'Kasus\AlatBantu\KeteranganKelahiran\ViewController@index');
Route::post('/alat-bantu/ket-kelahiran/create', 'Kasus\AlatBantu\KeteranganKelahiran\PostController@create');
Route::post('/alat-bantu/ket-kelahiran/delete', 'Kasus\AlatBantu\KeteranganKelahiran\PostController@delete');
Route::get('/alat-bantu/ket-kelahiran/print/{id}', 'Kasus\AlatBantu\KeteranganKelahiran\ViewController@print');

Route::get('/alat-bantu/persalinan', 'Kasus\AlatBantu\Persalinan\ViewController@index');
Route::post('/alat-bantu/persalinan/create', 'Kasus\AlatBantu\Persalinan\PostController@create');
Route::post('/alat-bantu/persalinan/delete', 'Kasus\AlatBantu\Persalinan\PostController@delete');
Route::post('/alat-bantu/persalinan/create-bayi', 'Kasus\AlatBantu\Persalinan\PostController@createBayi');

Route::get('/alat-bantu/perinatal', 'Kasus\AlatBantu\Perinatal\ViewController@index');
Route::post('/alat-bantu/perinatal/create', 'Kasus\AlatBantu\Perinatal\PostController@create');
Route::post('/alat-bantu/perinatal/edit', 'Kasus\AlatBantu\Perinatal\PostController@edit');
Route::post('/alat-bantu/perinatal/delete', 'Kasus\AlatBantu\DeleteController@delete');

Route::get('/alat-bantu/patograf', 'Kasus\AlatBantu\Patograf\ViewController@index');
Route::post('/alat-bantu/patograf/create', 'Kasus\AlatBantu\Patograf\PostController@create');
Route::post('/alat-bantu/patograf/delete', 'Kasus\AlatBantu\Patograf\PostController@delete');

Route::get('/alat-bantu/riwayat-kehamilan', 'Kasus\AlatBantu\RiwayatKehamilan\ViewController@index');
Route::post('/alat-bantu/riwayat-kehamilan/create', 'Kasus\AlatBantu\RiwayatKehamilan\PostController@create');
Route::post('/alat-bantu/riwayat-kehamilan/delete', 'Kasus\AlatBantu\RiwayatKehamilan\PostController@delete');

Route::get('/alat-bantu/pengkajian-awal-kebidanan', 'Kasus\AlatBantu\PengkajianAwalKebidanan\ViewController@index');
Route::post('/alat-bantu/pengkajian-awal-kebidanan/create', 'Kasus\AlatBantu\PengkajianAwalKebidanan\PostController@create');

Route::get('/alat-bantu/apache-ii', 'Kasus\AlatBantu\ApacheII\ViewController@index');
Route::post('/alat-bantu/apache-ii/create', 'Kasus\AlatBantu\ApacheII\PostController@create');
Route::post('/alat-bantu/apache-ii/delete', 'Kasus\AlatBantu\ApacheII\PostController@delete');

Route::get('/alat-bantu/nyeri-post-ops', 'Kasus\AlatBantu\NyeriPostOps\ViewController@index');
Route::post('/alat-bantu/nyeri-post-ops/create', 'Kasus\AlatBantu\NyeriPostOps\PostController@create');
Route::post('/alat-bantu/nyeri-post-ops/delete', 'Kasus\AlatBantu\NyeriPostOps\PostController@delete');

Route::get('/alat-bantu/pengkajian-igd', 'Kasus\AlatBantu\PengkajianIGD\ViewController@index');
Route::post('/alat-bantu/pengkajian-igd/create', 'Kasus\AlatBantu\PengkajianIGD\PostController@create');
Route::post('/alat-bantu/pengkajian-igd/delete', 'Kasus\AlatBantu\DeleteController@delete');

Route::get('/alat-bantu/pengkajian-ranap-neonatus', 'Kasus\AlatBantu\PengkajianRanapNeonatus\ViewController@index');
Route::post('/alat-bantu/pengkajian-ranap-neonatus/create', 'Kasus\AlatBantu\PengkajianRanapNeonatus\PostController@create');
Route::post('/alat-bantu/pengkajian-ranap-neonatus/delete', 'Kasus\AlatBantu\PengkajianRanapNeonatus\PostController@delete');

Route::get('/alat-bantu/pengkajian-ranap-medikal', 'Kasus\AlatBantu\PengkajianRanapMedikal\ViewController@index');
Route::post('/alat-bantu/pengkajian-ranap-medikal/create', 'Kasus\AlatBantu\PengkajianRanapMedikal\PostController@create');
Route::post('/alat-bantu/pengkajian-ranap-medikal/delete', 'Kasus\AlatBantu\DeleteController@delete');

Route::group(['middleware' => 'check-if-ipcn'], function () {
	Route::get('/alat-bantu/isk', 'Kasus\AlatBantu\ISK\ViewController@index');
	Route::get('/alat-bantu/bsi', 'Kasus\AlatBantu\BSI\ViewController@index');
	Route::get('/alat-bantu/monitoring-ventilator', 'Kasus\AlatBantu\MonitoringVentilator\ViewController@index');
	Route::get('/alat-bantu/surveilans', 'Kasus\AlatBantu\Surveilans\ViewController@index');
});

Route::post('/alat-bantu/isk/create', 'Kasus\AlatBantu\ISK\PostController@create');
Route::post('/alat-bantu/isk/create-audit', 'Kasus\AlatBantu\ISK\PostController@createAudit');
Route::post('/alat-bantu/isk/edit-master', 'Kasus\AlatBantu\ISK\PostController@editMaster');
Route::post('/alat-bantu/isk/delete', 'Kasus\AlatBantu\ISK\DeleteController@delete');

Route::post('/alat-bantu/bsi/create', 'Kasus\AlatBantu\BSI\PostController@create');
Route::post('/alat-bantu/bsi/create-audit', 'Kasus\AlatBantu\BSI\PostController@createAudit');
Route::post('/alat-bantu/bsi/edit-master', 'Kasus\AlatBantu\BSI\PostController@editMaster');
Route::post('/alat-bantu/bsi/delete', 'Kasus\AlatBantu\BSI\PostController@delete');

Route::post('/alat-bantu/monitoring-ventilator/create', 'Kasus\AlatBantu\MonitoringVentilator\PostController@create');
Route::post('/alat-bantu/monitoring-ventilator/create-audit', 'Kasus\AlatBantu\MonitoringVentilator\PostController@createAudit');
Route::post('/alat-bantu/monitoring-ventilator/edit-master', 'Kasus\AlatBantu\MonitoringVentilator\PostController@editMaster');
Route::post('/alat-bantu/monitoring-ventilator/delete', 'Kasus\AlatBantu\DeleteController@delete');

Route::post('/alat-bantu/surveilans/create', 'Kasus\AlatBantu\Surveilans\PostController@create');
Route::post('/alat-bantu/surveilans/create-audit', 'Kasus\AlatBantu\Surveilans\PostController@createAudit');
Route::post('/alat-bantu/surveilans/edit', 'Kasus\AlatBantu\Surveilans\PostController@edit');
Route::post('/alat-bantu/surveilans/delete', 'Kasus\AlatBantu\DeleteController@delete');

Route::get('/alat-bantu/hap', 'Kasus\AlatBantu\HAP\ViewController@index');
Route::post('/alat-bantu/hap/create', 'Kasus\AlatBantu\HAP\PostController@create');
Route::post('/alat-bantu/hap/delete', 'Kasus\AlatBantu\DeleteController@delete');

Route::get('/alat-bantu/identifikasi-pasien', 'Kasus\AlatBantu\IdentifikasiPasien\ViewController@index');
Route::post('/alat-bantu/identifikasi-pasien/create', 'Kasus\AlatBantu\IdentifikasiPasien\PostController@create');
Route::post('/alat-bantu/identifikasi-pasien/delete', 'Kasus\AlatBantu\DeleteController@delete');

Route::get('/alat-bantu/plebitis', 'Kasus\AlatBantu\Plebitis\ViewController@index');
Route::post('/alat-bantu/plebitis/create', 'Kasus\AlatBantu\Plebitis\PostController@create');
Route::post('/alat-bantu/plebitis/delete', 'Kasus\AlatBantu\Plebitis\PostController@delete');
Route::post('/alat-bantu/plebitis/edit-master', 'Kasus\AlatBantu\Plebitis\PostController@editMaster');

Route::get('/alat-bantu/fungsional', 'Kasus\AlatBantu\Fungsional\ViewController@index');
Route::post('/alat-bantu/fungsional/create', 'Kasus\AlatBantu\Fungsional\PostController@create');
Route::post('/alat-bantu/fungsional/delete', 'Kasus\AlatBantu\DeleteController@delete');

Route::get('/alat-bantu/asuhan-gizi', 'Kasus\AlatBantu\AsuhanGizi\ViewController@index');
Route::post('/alat-bantu/asuhan-gizi/create', 'Kasus\AlatBantu\AsuhanGizi\PostController@create');
Route::post('/alat-bantu/asuhan-gizi/delete', 'Kasus\AlatBantu\AsuhanGizi\PostController@delete');
Route::post('/alat-bantu/asuhan-gizi/verifikasi', 'Kasus\AlatBantu\AsuhanGizi\PostController@verifikasi');

Route::get('/alat-bantu/kemoterapi', 'Kasus\AlatBantu\Kemoterapi\ViewController@index');
Route::post('/alat-bantu/kemoterapi/create', 'Kasus\AlatBantu\Kemoterapi\PostController@create');
Route::post('/alat-bantu/kemoterapi/delete', 'Kasus\AlatBantu\DeleteController@delete');

Route::get('/alat-bantu/pengkajian-kemoterapi', 'Kasus\AlatBantu\PengkajianKemoterapi\ViewController@index');
Route::post('/alat-bantu/pengkajian-kemoterapi/create', 'Kasus\AlatBantu\PengkajianKemoterapi\PostController@create');
Route::post('/alat-bantu/pengkajian-kemoterapi/delete', 'Kasus\AlatBantu\DeleteController@delete');

Route::get('/alat-bantu/observasi', 'Kasus\AlatBantu\Observasi\ViewController@index');
Route::post('/alat-bantu/observasi/create', 'Kasus\AlatBantu\Observasi\PostController@create');
Route::post('/alat-bantu/observasi/delete', 'Kasus\AlatBantu\DeleteController@delete');

Route::get('/alat-bantu/pengobatan-pasien', 'Kasus\AlatBantu\PengobatanPasien\ViewController@index');
Route::post('/alat-bantu/pengobatan-pasien/create', 'Kasus\AlatBantu\PengobatanPasien\PostController@create');
Route::post('/alat-bantu/pengobatan-pasien/pemberian', 'Kasus\AlatBantu\PengobatanPasien\PostController@pemberian');
Route::get('/alat-bantu/pengobatan-pasien/selesai/{id}', 'Kasus\AlatBantu\PengobatanPasien\PostController@selesai');
Route::post('/alat-bantu/pengobatan-pasien/delete', 'Kasus\AlatBantu\DeleteController@delete');

Route::get('/alat-bantu/resume-pulang', 'Kasus\AlatBantu\ResumePulang\ViewController@index');
Route::post('/alat-bantu/resume-pulang/create', 'Kasus\AlatBantu\ResumePulang\PostController@create');
Route::post('/alat-bantu/resume-pulang/delete', 'Kasus\AlatBantu\ResumePulang\PostController@delete');
Route::get('/alat-bantu/resume-pulang/print', 'Kasus\AlatBantu\ResumePulang\ViewController@print');

Route::get('/alat-bantu/keperawatan-jiwa', 'Kasus\AlatBantu\KeperawatanJiwa\ViewController@index');
Route::post('/alat-bantu/keperawatan-jiwa/create', 'Kasus\AlatBantu\KeperawatanJiwa\PostController@create');
Route::post('/alat-bantu/keperawatan-jiwa/delete', 'Kasus\AlatBantu\KeperawatanJiwa\PostController@delete');

Route::get('/alat-bantu/sk-dirawat', 'Kasus\AlatBantu\SKDirawat\ViewController@print');
Route::get('/alat-bantu/sk-terbang', 'Kasus\AlatBantu\SKTerbang\ViewController@print');

Route::get('/alat-bantu/awal', 'Kasus\AlatBantu\Awal\ViewController@index');
Route::post('/alat-bantu/awal/create', 'Kasus\AlatBantu\Awal\PostController@create');
Route::post('/alat-bantu/awal/delete', 'Kasus\AlatBantu\Awal\PostController@delete');

Route::get('/alat-bantu/hemodialisa', 'Kasus\AlatBantu\Hemodialisa\ViewController@index');
Route::post('/alat-bantu/hemodialisa/create', 'Kasus\AlatBantu\Hemodialisa\PostController@submit');
Route::post('/alat-bantu/hemodialisa/delete', 'Kasus\AlatBantu\Hemodialisa\PostController@delete');

Route::get('/alat-bantu/klinik-rehab-medik', 'Kasus\AlatBantu\RehabMedik\ViewController@index');
Route::post('/alat-bantu/klinik-rehab-medik/create', 'Kasus\AlatBantu\RehabMedik\PostController@submit');
Route::post('/alat-bantu/klinik-rehab-medik/delete', 'Kasus\AlatBantu\RehabMedik\PostController@delete');

Route::get('/alat-bantu/kejadian-jatuh', 'Kasus\AlatBantu\KejadianJatuh\ViewController@index');
Route::post('/alat-bantu/kejadian-jatuh/create', 'Kasus\AlatBantu\KejadianJatuh\PostController@create');
Route::post('/alat-bantu/kejadian-jatuh/delete', 'Kasus\AlatBantu\KejadianJatuh\PostController@delete');

Route::get('/alat-bantu/tanda-sepsis', 'Kasus\AlatBantu\TandaSepsis\ViewController@index');
Route::post('/alat-bantu/tanda-sepsis/create', 'Kasus\AlatBantu\TandaSepsis\PostController@create');
Route::post('/alat-bantu/tanda-sepsis/delete', 'Kasus\AlatBantu\TandaSepsis\PostController@delete');

Route::get('/alat-bantu/ceklis-pembedahan', 'Kasus\AlatBantu\CeklisPembedahan\ViewController@index');
Route::post('/alat-bantu/ceklis-pembedahan/create', 'Kasus\AlatBantu\CeklisPembedahan\PostController@submit');
Route::post('/alat-bantu/ceklis-pembedahan/delete', 'Kasus\AlatBantu\CeklisPembedahan\PostController@delete');

Route::get('/alat-bantu/perioperatif', 'Kasus\AlatBantu\Perioperatif\ViewController@index');
Route::post('/alat-bantu/perioperatif/create', 'Kasus\AlatBantu\Perioperatif\PostController@submit');
Route::post('/alat-bantu/perioperatif/delete', 'Kasus\AlatBantu\Perioperatif\PostController@delete');

Route::get('/alat-bantu/pra-bedah', 'Kasus\AlatBantu\PraBedah\ViewController@index');
Route::post('/alat-bantu/pra-bedah/create', 'Kasus\AlatBantu\PraBedah\PostController@submit');
Route::post('/alat-bantu/pra-bedah/delete', 'Kasus\AlatBantu\PraBedah\PostController@delete');

Route::get('/alat-bantu/pengkajian-anestesi', 'Kasus\AlatBantu\PengkajianAnestesi\ViewController@index');
Route::post('/alat-bantu/pengkajian-anestesi/create', 'Kasus\AlatBantu\PengkajianAnestesi\PostController@submit');
Route::post('/alat-bantu/pengkajian-anestesi/delete', 'Kasus\AlatBantu\PengkajianAnestesi\PostController@delete');

Route::get('/alat-bantu/mata', 'Kasus\AlatBantu\Mata\ViewController@index');
Route::post('/alat-bantu/mata/create', 'Kasus\AlatBantu\Mata\PostController@submit');
Route::post('/alat-bantu/mata/delete', 'Kasus\AlatBantu\Mata\PostController@delete');

Route::get('/alat-bantu/surat-keterangan', 'Kasus\AlatBantu\SuratKeterangan\ViewController@index');
Route::post('/alat-bantu/surat-keterangan/save', 'Kasus\AlatBantu\SuratKeterangan\PostController@submit');
Route::post('/alat-bantu/surat-keterangan/delete', 'Kasus\AlatBantu\SuratKeterangan\PostController@delete');
Route::get('/alat-bantu/surat-keterangan/print/{id}', 'Kasus\AlatBantu\SuratKeterangan\ViewController@print');

Route::get('/alat-bantu/permintaan-ultrasonografi', 'Kasus\AlatBantu\PermintaanUSG\ViewController@index');
Route::post('/alat-bantu/permintaan-ultrasonografi/create', 'Kasus\AlatBantu\PermintaanUSG\PostController@create');
Route::get('/alat-bantu/permintaan-ultrasonografi/print/{id}', 'Kasus\AlatBantu\PermintaanUSG\ViewController@print');
Route::post('/alat-bantu/permintaan-ultrasonografi/edit/{id}', 'Kasus\AlatBantu\PermintaanUSG\PostController@edit');
Route::post('/alat-bantu/permintaan-ultrasonografi/delete/{id}', 'Kasus\AlatBantu\PermintaanUSG\PostController@delete');

Route::get('/alat-bantu/form-transfer-antar-ruangan', 'Kasus\AlatBantu\FormTransferAntarRuangan\ViewController@index');
Route::post('/alat-bantu/form-transfer-antar-ruangan/submit', 'Kasus\AlatBantu\FormTransferAntarRuangan\PostController@submit');
Route::post('/alat-bantu/form-transfer-antar-ruangan/update', 'Kasus\AlatBantu\FormTransferAntarRuangan\PostController@update');
Route::post('/alat-bantu/form-transfer-antar-ruangan/delete', 'Kasus\AlatBantu\FormTransferAntarRuangan\PostController@delete');
Route::get('/alat-bantu/form-transfer-antar-ruangan/print/{id}', 'Kasus\AlatBantu\FormTransferAntarRuangan\ViewController@print');

Route::get('/alat-bantu/surat-keterangan-fisik', 'Kasus\AlatBantu\SuratKeteranganFisik\ViewController@index');
Route::post('/alat-bantu/surat-keterangan-fisik/submit', 'Kasus\AlatBantu\SuratKeteranganFisik\PostController@submit');
Route::post('/alat-bantu/surat-keterangan-fisik/update', 'Kasus\AlatBantu\SuratKeteranganFisik\PostController@update');
Route::post('/alat-bantu/surat-keterangan-fisik/delete', 'Kasus\AlatBantu\SuratKeteranganFisik\PostController@delete');
Route::get('/alat-bantu/surat-keterangan-fisik/print/{id}', 'Kasus\AlatBantu\SuratKeteranganFisik\ViewController@print');

Route::get('/alat-bantu/surat-keterangan-jiwa', 'Kasus\AlatBantu\SuratKeteranganJiwa\ViewController@index');
Route::post('/alat-bantu/surat-keterangan-jiwa/submit', 'Kasus\AlatBantu\SuratKeteranganJiwa\PostController@submit');
Route::post('/alat-bantu/surat-keterangan-jiwa/update', 'Kasus\AlatBantu\SuratKeteranganJiwa\PostController@update');
Route::post('/alat-bantu/surat-keterangan-jiwa/delete', 'Kasus\AlatBantu\SuratKeteranganJiwa\PostController@delete');
Route::get('/alat-bantu/surat-keterangan-jiwa/print/{id}', 'Kasus\AlatBantu\SuratKeteranganJiwa\ViewController@print');

Route::get('/alat-bantu/surat-keterangan-napza', 'Kasus\AlatBantu\SuratKeteranganNapza\ViewController@index');
Route::post('/alat-bantu/surat-keterangan-napza/submit', 'Kasus\AlatBantu\SuratKeteranganNapza\PostController@submit');
Route::post('/alat-bantu/surat-keterangan-napza/update', 'Kasus\AlatBantu\SuratKeteranganNapza\PostController@update');
Route::post('/alat-bantu/surat-keterangan-napza/delete', 'Kasus\AlatBantu\SuratKeteranganNapza\PostController@delete');
Route::get('/alat-bantu/surat-keterangan-napza/print/{id}', 'Kasus\AlatBantu\SuratKeteranganNapza\ViewController@print');

Route::get('/alat-bantu/surat-keterangan-hiv', 'Kasus\AlatBantu\SuratKeteranganHiv\ViewController@index');
Route::post('/alat-bantu/surat-keterangan-hiv/submit', 'Kasus\AlatBantu\SuratKeteranganHiv\PostController@submit');
Route::post('/alat-bantu/surat-keterangan-hiv/update', 'Kasus\AlatBantu\SuratKeteranganHiv\PostController@update');
Route::post('/alat-bantu/surat-keterangan-hiv/delete', 'Kasus\AlatBantu\SuratKeteranganHiv\PostController@delete');
Route::get('/alat-bantu/surat-keterangan-hiv/print/{id}', 'Kasus\AlatBantu\SuratKeteranganHiv\ViewController@print');

Route::get('/alat-bantu/surat-keterangan-pemeriksaan-ekg', 'Kasus\AlatBantu\SuratKeteranganPemeriksaanEkg\ViewController@index');
Route::post('/alat-bantu/surat-keterangan-pemeriksaan-ekg/submit', 'Kasus\AlatBantu\SuratKeteranganPemeriksaanEkg\PostController@submit');
Route::post('/alat-bantu/surat-keterangan-pemeriksaan-ekg/update', 'Kasus\AlatBantu\SuratKeteranganPemeriksaanEkg\PostController@update');
Route::post('/alat-bantu/surat-keterangan-pemeriksaan-ekg/delete', 'Kasus\AlatBantu\SuratKeteranganPemeriksaanEkg\PostController@delete');
Route::get('/alat-bantu/surat-keterangan-pemeriksaan-ekg/print/{id}', 'Kasus\AlatBantu\SuratKeteranganPemeriksaanEkg\ViewController@print');
