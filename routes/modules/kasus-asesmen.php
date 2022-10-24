<?php

Route::get("/asesmen/laporan-psikogram-pemeriksaan-psikologi/", "Kasus\Asesmen\LaporanPsikogramPemeriksaanPsikologi\ViewController@index");
Route::post("/asesmen/laporan-psikogram-pemeriksaan-psikologi/save", "Kasus\Asesmen\LaporanPsikogramPemeriksaanPsikologi\PostController@save");
Route::post("/asesmen/laporan-psikogram-pemeriksaan-psikologi/delete", "Kasus\Asesmen\LaporanPsikogramPemeriksaanPsikologi\PostController@delete");
Route::get("/asesmen/laporan-psikogram-pemeriksaan-psikologi/print/{id}", "Kasus\Asesmen\LaporanPsikogramPemeriksaanPsikologi\ViewController@print");



Route::get("/asesmen/laporan-deskripsi-pemeriksaan-psikologi/", "Kasus\Asesmen\LaporanDeskripsiPemeriksaanPsikologi\ViewController@index");
Route::post("/asesmen/laporan-deskripsi-pemeriksaan-psikologi/save", "Kasus\Asesmen\LaporanDeskripsiPemeriksaanPsikologi\PostController@save");
Route::post("/asesmen/laporan-deskripsi-pemeriksaan-psikologi/delete", "Kasus\Asesmen\LaporanDeskripsiPemeriksaanPsikologi\PostController@delete");
Route::get("/asesmen/laporan-deskripsi-pemeriksaan-psikologi/print/{id}", "Kasus\Asesmen\LaporanDeskripsiPemeriksaanPsikologi\ViewController@print");



Route::get("/asesmen/form-transfer-internal-rumah-sakit/", "Kasus\Asesmen\FormTransferInternalRumahSakit\ViewController@index");
Route::post("/asesmen/form-transfer-internal-rumah-sakit/save", "Kasus\Asesmen\FormTransferInternalRumahSakit\PostController@save");
Route::post("/asesmen/form-transfer-internal-rumah-sakit/delete", "Kasus\Asesmen\FormTransferInternalRumahSakit\PostController@delete");
Route::get("/asesmen/form-transfer-internal-rumah-sakit/print/{id}", "Kasus\Asesmen\FormTransferInternalRumahSakit\ViewController@print");



Route::get("/asesmen/ringkasan-pasien-masuk-dan-keluar/", "Kasus\Asesmen\RingkasanPasienMasukDanKeluar\ViewController@index");
Route::post("/asesmen/ringkasan-pasien-masuk-dan-keluar/save", "Kasus\Asesmen\RingkasanPasienMasukDanKeluar\PostController@save");
Route::post("/asesmen/ringkasan-pasien-masuk-dan-keluar/delete", "Kasus\Asesmen\RingkasanPasienMasukDanKeluar\PostController@delete");
Route::get("/asesmen/ringkasan-pasien-masuk-dan-keluar/print", "Kasus\Asesmen\RingkasanPasienMasukDanKeluar\ViewController@print");



Route::get("/asesmen/resume-medis/", "Kasus\Asesmen\ResumeMedis\ViewController@index");
Route::post("/asesmen/resume-medis/save", "Kasus\Asesmen\ResumeMedis\PostController@save");
Route::post("/asesmen/resume-medis/delete", "Kasus\Asesmen\ResumeMedis\PostController@delete");
Route::get("/asesmen/resume-medis/print/{id}", "Kasus\Asesmen\ResumeMedis\ViewController@print");



Route::get("/asesmen/resume-gawat-darurat/", "Kasus\Asesmen\ResumeGawatDarurat\ViewController@index");
Route::post("/asesmen/resume-gawat-darurat/save", "Kasus\Asesmen\ResumeGawatDarurat\PostController@save");
Route::post("/asesmen/resume-gawat-darurat/delete", "Kasus\Asesmen\ResumeGawatDarurat\PostController@delete");
Route::get("/asesmen/resume-gawat-darurat/print/{id}", "Kasus\Asesmen\ResumeGawatDarurat\ViewController@print");



Route::get("/asesmen/abcabc/", "Kasus\Asesmen\Abcabc\ViewController@index");
Route::post("/asesmen/abcabc/save", "Kasus\Asesmen\Abcabc\PostController@save");
Route::post("/asesmen/abcabc/delete", "Kasus\Asesmen\Abcabc\PostController@delete");
Route::get("/asesmen/abcabc/print/{id}", "Kasus\Asesmen\Abcabc\ViewController@print");



Route::get("/asesmen/rencana-pemulangan-pasien/", "Kasus\Asesmen\RencanaPemulanganPasien\ViewController@index");
Route::post("/asesmen/rencana-pemulangan-pasien/save", "Kasus\Asesmen\RencanaPemulanganPasien\PostController@save");
Route::post("/asesmen/rencana-pemulangan-pasien/delete", "Kasus\Asesmen\RencanaPemulanganPasien\PostController@delete");
Route::get("/asesmen/rencana-pemulangan-pasien/print/{id}", "Kasus\Asesmen\RencanaPemulanganPasien\ViewController@print");



Route::get("/asesmen/resume-non-jiwa/", "Kasus\Asesmen\ResumeNonJiwa\ViewController@index");
Route::post("/asesmen/resume-non-jiwa/save", "Kasus\Asesmen\ResumeNonJiwa\PostController@save");
Route::post("/asesmen/resume-non-jiwa/delete", "Kasus\Asesmen\ResumeNonJiwa\PostController@delete");
Route::get("/asesmen/resume-non-jiwa/print/{id}", "Kasus\Asesmen\ResumeNonJiwa\ViewController@print");



Route::get("/asesmen/ringkasan-pasien-pulang/", "Kasus\Asesmen\RingkasanPasienPulang\ViewController@index");
Route::post("/asesmen/ringkasan-pasien-pulang/save", "Kasus\Asesmen\RingkasanPasienPulang\PostController@save");
Route::post("/asesmen/ringkasan-pasien-pulang/delete", "Kasus\Asesmen\RingkasanPasienPulang\PostController@delete");
Route::get("/asesmen/ringkasan-pasien-pulang/print/{id}", "Kasus\Asesmen\RingkasanPasienPulang\ViewController@print");



Route::get("/asesmen/skoring-derajat-gejala-psikotik/", "Kasus\Asesmen\SkoringDerajatGejalaPsikotik\ViewController@index");
Route::post("/asesmen/skoring-derajat-gejala-psikotik/save", "Kasus\Asesmen\SkoringDerajatGejalaPsikotik\PostController@save");
Route::post("/asesmen/skoring-derajat-gejala-psikotik/delete", "Kasus\Asesmen\SkoringDerajatGejalaPsikotik\PostController@delete");
Route::get("/asesmen/skoring-derajat-gejala-psikotik/print", "Kasus\Asesmen\SkoringDerajatGejalaPsikotik\ViewController@print");

Route::get("/asesmen/pasien-covid/", "Kasus\AlatBantu\PasienCovid\View2Controller@index");
Route::post("/asesmen/pasien-covid/save", "Kasus\AlatBantu\PasienCovid\PostController@save");
Route::post("/asesmen/pasien-covid/save2", "Kasus\AlatBantu\PasienCovid\Post2Controller@save");
Route::post("/asesmen/pasien-covid/delete", "Kasus\AlatBantu\PasienCovid\PostController@delete");
Route::get("/asesmen/pasien-covid/print/{id}", "Kasus\AlatBantu\PasienCovid\ViewController@print");


Route::get("/asesmen/lembar-observasi/", "Kasus\Asesmen\LembarObservasi\ViewController@index");
Route::post("/asesmen/lembar-observasi/save", "Kasus\Asesmen\LembarObservasi\PostController@save");
Route::post("/asesmen/lembar-observasi/delete", "Kasus\Asesmen\LembarObservasi\PostController@delete");
Route::get("/asesmen/lembar-observasi/print", "Kasus\Asesmen\LembarObservasi\ViewController@print");


Route::get("/asesmen/surat-nasehat-pulang/", "Kasus\Asesmen\SuratNasehatPulang\ViewController@index");
Route::post("/asesmen/surat-nasehat-pulang/save", "Kasus\Asesmen\SuratNasehatPulang\PostController@save");
Route::post("/asesmen/surat-nasehat-pulang/delete", "Kasus\Asesmen\SuratNasehatPulang\PostController@delete");
Route::get("/asesmen/surat-nasehat-pulang/print/{id}", "Kasus\Asesmen\SuratNasehatPulang\ViewController@print");



Route::get("/asesmen/lembar-komunikasi-informasi-dan-edukasi-pasien-dan-keluarga/", "Kasus\Asesmen\LembarKomunikasiInformasiDanEdukasiPasienDanKeluarga\ViewController@index");
Route::post("/asesmen/lembar-komunikasi-informasi-dan-edukasi-pasien-dan-keluarga/save", "Kasus\Asesmen\LembarKomunikasiInformasiDanEdukasiPasienDanKeluarga\PostController@save");
Route::post("/asesmen/lembar-komunikasi-informasi-dan-edukasi-pasien-dan-keluarga/delete", "Kasus\Asesmen\LembarKomunikasiInformasiDanEdukasiPasienDanKeluarga\PostController@delete");
Route::get("/asesmen/lembar-komunikasi-informasi-dan-edukasi-pasien-dan-keluarga/print", "Kasus\Asesmen\LembarKomunikasiInformasiDanEdukasiPasienDanKeluarga\ViewController@print");


Route::get("/asesmen/asesmen-pendidikan-pasien-dan-keluarga/", "Kasus\Asesmen\AsesmenPendidikanPasienDanKeluarga\ViewController@index");
Route::post("/asesmen/asesmen-pendidikan-pasien-dan-keluarga/save", "Kasus\Asesmen\AsesmenPendidikanPasienDanKeluarga\PostController@save");
Route::post("/asesmen/asesmen-pendidikan-pasien-dan-keluarga/lembar/save", "Kasus\Asesmen\AsesmenPendidikanPasienDanKeluarga\PostController@lembarSave");
Route::post("/asesmen/asesmen-pendidikan-pasien-dan-keluarga/delete", "Kasus\Asesmen\AsesmenPendidikanPasienDanKeluarga\PostController@delete");
Route::post("/asesmen/asesmen-pendidikan-pasien-dan-keluarga/lembar/delete", "Kasus\Asesmen\AsesmenPendidikanPasienDanKeluarga\PostController@lembarDelete");
Route::get("/asesmen/asesmen-pendidikan-pasien-dan-keluarga/print/{id}", "Kasus\Asesmen\AsesmenPendidikanPasienDanKeluarga\ViewController@print");


Route::get("/asesmen/pengantar-pengiriman-pasien/", "Kasus\Asesmen\PengantarPengirimanPasien\ViewController@index");
Route::post("/asesmen/pengantar-pengiriman-pasien/save", "Kasus\Asesmen\PengantarPengirimanPasien\PostController@save");
Route::post("/asesmen/pengantar-pengiriman-pasien/delete", "Kasus\Asesmen\PengantarPengirimanPasien\PostController@delete");
Route::get("/asesmen/pengantar-pengiriman-pasien/print/{id}", "Kasus\Asesmen\PengantarPengirimanPasien\ViewController@print");



Route::get("/asesmen/asesmen-perencanaan-pemulangan-pasien/", "Kasus\Asesmen\AsesmenPerencanaanPemulanganPasien\ViewController@index");
Route::post("/asesmen/asesmen-perencanaan-pemulangan-pasien/save", "Kasus\Asesmen\AsesmenPerencanaanPemulanganPasien\PostController@save");
Route::post("/asesmen/asesmen-perencanaan-pemulangan-pasien/delete", "Kasus\Asesmen\AsesmenPerencanaanPemulanganPasien\PostController@delete");



Route::get("/asesmen/evaluasi-perencanaan-pemulangan-pasien/", "Kasus\Asesmen\EvaluasiPerencanaanPemulanganPasien\ViewController@index");
Route::post("/asesmen/evaluasi-perencanaan-pemulangan-pasien/save", "Kasus\Asesmen\EvaluasiPerencanaanPemulanganPasien\PostController@save");
Route::post("/asesmen/evaluasi-perencanaan-pemulangan-pasien/delete", "Kasus\Asesmen\EvaluasiPerencanaanPemulanganPasien\PostController@delete");



Route::get("/asesmen/pengkajian-penggunaan-antibiotik-profilaksis/", "Kasus\Asesmen\PengkajianPenggunaanAntibiotikProfilaksis\ViewController@index");
Route::post("/asesmen/pengkajian-penggunaan-antibiotik-profilaksis/save", "Kasus\Asesmen\PengkajianPenggunaanAntibiotikProfilaksis\PostController@save");
Route::post("/asesmen/pengkajian-penggunaan-antibiotik-profilaksis/delete", "Kasus\Asesmen\PengkajianPenggunaanAntibiotikProfilaksis\PostController@delete");



Route::get("/asesmen/transfer-pasien/", "Kasus\TransferPasien\ViewController@index");
Route::post("/asesmen/transfer-pasien/save", "Kasus\TransferPasien\PostController@save");
Route::post("/asesmen/transfer-pasien/delete", "Kasus\TransferPasien\PostController@delete");



Route::get("/asesmen/discharge-planning-lanjutan/", "Kasus\Asesmen\DischargePlanningLanjutan\ViewController@index");
Route::post("/asesmen/discharge-planning-lanjutan/save", "Kasus\Asesmen\DischargePlanningLanjutan\PostController@save");
Route::post("/asesmen/discharge-planning-lanjutan/delete", "Kasus\Asesmen\DischargePlanningLanjutan\PostController@delete");



Route::get("/asesmen/pengkajian-pra-induksi-anestesi-dan-sedasi/", "Kasus\Asesmen\PengkajianPraInduksiAnestesiDanSedasi\ViewController@index");
Route::post("/asesmen/pengkajian-pra-induksi-anestesi-dan-sedasi/save", "Kasus\Asesmen\PengkajianPraInduksiAnestesiDanSedasi\PostController@save");
Route::post("/asesmen/pengkajian-pra-induksi-anestesi-dan-sedasi/delete", "Kasus\Asesmen\PengkajianPraInduksiAnestesiDanSedasi\PostController@delete");



Route::get("/asesmen/pengkajian-awal-anestesi-dan-sedasi/", "Kasus\Asesmen\PengkajianAwalAnestesiDanSedasi\ViewController@index");
Route::post("/asesmen/pengkajian-awal-anestesi-dan-sedasi/save", "Kasus\Asesmen\PengkajianAwalAnestesiDanSedasi\PostController@save");
Route::post("/asesmen/pengkajian-awal-anestesi-dan-sedasi/delete", "Kasus\Asesmen\PengkajianAwalAnestesiDanSedasi\PostController@delete");



Route::get("/asesmen/monitoring-transfusi-darah/", "Kasus\Asesmen\MonitoringTransfusiDarah\ViewController@index");
Route::post("/asesmen/monitoring-transfusi-darah/save", "Kasus\Asesmen\MonitoringTransfusiDarah\PostController@save");
Route::post("/asesmen/monitoring-transfusi-darah/delete", "Kasus\Asesmen\MonitoringTransfusiDarah\PostController@delete");



Route::get("/asesmen/penandaan-area-operasi/", "Kasus\Asesmen\PenandaanAreaOperasi\ViewController@index");
Route::get("/asesmen/penandaan-area-operasi/form/{id?}", "Kasus\Asesmen\PenandaanAreaOperasi\ViewController@form");
Route::get("/asesmen/penandaan-area-operasi/view/{id}", "Kasus\Asesmen\PenandaanAreaOperasi\ViewController@view");
Route::post("/asesmen/penandaan-area-operasi/form/{id?}", "Kasus\Asesmen\PenandaanAreaOperasi\PostController@save");
Route::post("/asesmen/penandaan-area-operasi/delete", "Kasus\Asesmen\PenandaanAreaOperasi\PostController@delete");



Route::get("/asesmen/pengkajian-ulang-pasien-terminal/", "Kasus\Asesmen\PengkajianUlangPasienTerminal\ViewController@index");
Route::post("/asesmen/pengkajian-ulang-pasien-terminal/save", "Kasus\Asesmen\PengkajianUlangPasienTerminal\PostController@save");
Route::post("/asesmen/pengkajian-ulang-pasien-terminal/delete", "Kasus\Asesmen\PengkajianUlangPasienTerminal\PostController@delete");



Route::get("/asesmen/pengkajian-awal-pasien-terminal/", "Kasus\Asesmen\PengkajianAwalPasienTerminal\ViewController@index");
Route::post("/asesmen/pengkajian-awal-pasien-terminal/save", "Kasus\Asesmen\PengkajianAwalPasienTerminal\PostController@save");
Route::post("/asesmen/pengkajian-awal-pasien-terminal/delete", "Kasus\Asesmen\PengkajianAwalPasienTerminal\PostController@delete");

Route::get("/asesmen/pasien-covid/", "Kasus\AlatBantu\PasienCovid\ViewController@index");
Route::post("/asesmen/pasien-covid/save", "Kasus\AlatBantu\PasienCovid\PostController@save");
Route::post("/asesmen/pasien-covid/delete", "Kasus\AlatBantu\PasienCovid\PostController@delete");
Route::get("/asesmen/pasien-covid/print/{id}", "Kasus\AlatBantu\PasienCovid\ViewController@print");

?>