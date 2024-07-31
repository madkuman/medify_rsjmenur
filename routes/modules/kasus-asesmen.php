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

Route::get("/asesmen/skoring-panss-ec/", "Kasus\Asesmen\SkoringPanssEc\ViewController@index");
Route::post("/asesmen/skoring-panss-ec/save", "Kasus\Asesmen\SkoringPanssEc\PostController@save");
Route::post("/asesmen/skoring-panss-ec/delete", "Kasus\Asesmen\SkoringPanssEc\PostController@delete");
Route::get("/asesmen/skoring-panss-ec/print", "Kasus\Asesmen\SkoringPanssEc\ViewController@print");

Route::get("/asesmen/panss-remisi/", "Kasus\Asesmen\PanssRemisi\ViewController@index");
Route::post("/asesmen/panss-remisi/create", "Kasus\Asesmen\PanssRemisi\PostController@create");
Route::post("/asesmen/panss-remisi/delete", "Kasus\Asesmen\PanssRemisi\PostController@delete");
Route::get("/asesmen/panss-remisi/print/{id}", "Kasus\Asesmen\PanssRemisi\ViewController@print");
Route::get("/asesmen/panss-remisi/print", "Kasus\Asesmen\PanssRemisi\ViewController@printRekap");

Route::get("/asesmen/observasi-tindakan-ect/", "Kasus\Asesmen\ObservasiTindakanEct\ViewController@index");
Route::post("/asesmen/observasi-tindakan-ect/create", "Kasus\Asesmen\ObservasiTindakanEct\PostController@create");
Route::post("/asesmen/observasi-tindakan-ect/delete", "Kasus\Asesmen\ObservasiTindakanEct\PostController@delete");
Route::get("/asesmen/observasi-tindakan-ect/print", "Kasus\Asesmen\ObservasiTindakanEct\ViewController@print");

Route::get("/asesmen/observasi-transfusi-darah", "Kasus\Asesmen\ObservasiTransfusiDarah\ViewController@index");
Route::get("/asesmen/observasi-transfusi-darah/print/{id}", "Kasus\Asesmen\ObservasiTransfusiDarah\ViewController@print");
Route::post("/asesmen/observasi-transfusi-darah/create", "Kasus\Asesmen\ObservasiTransfusiDarah\PostController@create");
Route::post("/asesmen/observasi-transfusi-darah/delete", "Kasus\Asesmen\ObservasiTransfusiDarah\PostController@delete");


Route::get("/asesmen/checklist-keselamatan-pasien-dipoli-gigi-dan-mulut", "Kasus\Asesmen\ChecklistKeselamatanPasienDipoliGigiDanMulut\ViewController@index");
Route::get("/asesmen/checklist-keselamatan-pasien-dipoli-gigi-dan-mulut/view/{id}", "Kasus\Asesmen\ChecklistKeselamatanPasienDipoliGigiDanMulut\ViewController@single");
Route::get("/asesmen/checklist-keselamatan-pasien-dipoli-gigi-dan-mulut/create", "Kasus\Asesmen\ChecklistKeselamatanPasienDipoliGigiDanMulut\ViewController@create");
Route::get("/asesmen/checklist-keselamatan-pasien-dipoli-gigi-dan-mulut/edit/{id}", "Kasus\Asesmen\ChecklistKeselamatanPasienDipoliGigiDanMulut\ViewController@edit");
Route::post("/asesmen/checklist-keselamatan-pasien-dipoli-gigi-dan-mulut/submit-form", "Kasus\Asesmen\ChecklistKeselamatanPasienDipoliGigiDanMulut\PostController@submitForm");
Route::post("/asesmen/checklist-keselamatan-pasien-dipoli-gigi-dan-mulut/delete", "Kasus\Asesmen\ChecklistKeselamatanPasienDipoliGigiDanMulut\PostController@delete");
Route::get("/asesmen/checklist-keselamatan-pasien-dipoli-gigi-dan-mulut/print/{id}", "Kasus\Asesmen\ChecklistKeselamatanPasienDipoliGigiDanMulut\ViewController@print");
Route::get("/asesmen/checklist-keselamatan-pasien-dipoli-gigi-dan-mulut/search-user", "Kasus\Asesmen\ChecklistKeselamatanPasienDipoliGigiDanMulut\PostController@searchUser");

Route::get("/asesmen/asesmen-wajib-lapor-dan-rehabilitasi-medis-ipwl", "Kasus\Asesmen\AsesmenWajibLaporDanRehabilitasiMedisIpwl\ViewController@index");
Route::get("/asesmen/asesmen-wajib-lapor-dan-rehabilitasi-medis-ipwl/view/{id}", "Kasus\Asesmen\AsesmenWajibLaporDanRehabilitasiMedisIpwl\ViewController@single");
Route::get("/asesmen/asesmen-wajib-lapor-dan-rehabilitasi-medis-ipwl/create", "Kasus\Asesmen\AsesmenWajibLaporDanRehabilitasiMedisIpwl\ViewController@create");
Route::get("/asesmen/asesmen-wajib-lapor-dan-rehabilitasi-medis-ipwl/edit/{id}", "Kasus\Asesmen\AsesmenWajibLaporDanRehabilitasiMedisIpwl\ViewController@edit");
Route::post("/asesmen/asesmen-wajib-lapor-dan-rehabilitasi-medis-ipwl/submit-form", "Kasus\Asesmen\AsesmenWajibLaporDanRehabilitasiMedisIpwl\PostController@submitForm");
Route::post("/asesmen/asesmen-wajib-lapor-dan-rehabilitasi-medis-ipwl/delete", "Kasus\Asesmen\AsesmenWajibLaporDanRehabilitasiMedisIpwl\PostController@delete");
Route::get("/asesmen/asesmen-wajib-lapor-dan-rehabilitasi-medis-ipwl/print/{id}", "Kasus\Asesmen\AsesmenWajibLaporDanRehabilitasiMedisIpwl\ViewController@print");
Route::get("/asesmen/asesmen-wajib-lapor-dan-rehabilitasi-medis-ipwl/search-user", "Kasus\Asesmen\AsesmenWajibLaporDanRehabilitasiMedisIpwl\PostController@searchUser");
Route::post("/asesmen/asesmen-wajib-lapor-dan-rehabilitasi-medis-ipwl/add-ttd", "Kasus\Asesmen\AsesmenWajibLaporDanRehabilitasiMedisIpwl\PostController@addTTD");


Route::get("/asesmen/form-skrining-manajer-pelayanan-pasien/", "Kasus\Asesmen\FormSkriningManajerPelayananPasien\ViewController@index");
Route::post("/asesmen/form-skrining-manajer-pelayanan-pasien/save", "Kasus\Asesmen\FormSkriningManajerPelayananPasien\PostController@save");
Route::post("/asesmen/form-skrining-manajer-pelayanan-pasien/delete", "Kasus\Asesmen\FormSkriningManajerPelayananPasien\PostController@delete");
Route::get("/asesmen/form-skrining-manajer-pelayanan-pasien/print/{id}", "Kasus\Asesmen\FormSkriningManajerPelayananPasien\ViewController@print");

Route::get("/asesmen/implementasi-manajer-pelayanan-pasien/", "Kasus\Asesmen\ImplementasiManajerPelayananPasien\ViewController@index");
Route::post("/asesmen/implementasi-manajer-pelayanan-pasien/save", "Kasus\Asesmen\ImplementasiManajerPelayananPasien\PostController@save");
Route::post("/asesmen/implementasi-manajer-pelayanan-pasien/delete", "Kasus\Asesmen\ImplementasiManajerPelayananPasien\PostController@delete");
Route::get("/asesmen/implementasi-manajer-pelayanan-pasien/print/{id}", "Kasus\Asesmen\ImplementasiManajerPelayananPasien\ViewController@print");
Route::get("/asesmen/evaluasi-awal-manajer-pelayanan-pasien/", "Kasus\Asesmen\EvaluasiAwalManajerPelayananPasien\ViewController@index");
Route::post("/asesmen/evaluasi-awal-manajer-pelayanan-pasien/save", "Kasus\Asesmen\EvaluasiAwalManajerPelayananPasien\PostController@save");
Route::post("/asesmen/evaluasi-awal-manajer-pelayanan-pasien/delete", "Kasus\Asesmen\EvaluasiAwalManajerPelayananPasien\PostController@delete");
Route::get("/asesmen/evaluasi-awal-manajer-pelayanan-pasien/print/{id}", "Kasus\Asesmen\EvaluasiAwalManajerPelayananPasien\ViewController@print");

Route::get("/asesmen/resiko-melarikan-diri/", "Kasus\Asesmen\ResikoMelarikanDiri\ViewController@index");
Route::post("/asesmen/resiko-melarikan-diri/save", "Kasus\Asesmen\ResikoMelarikanDiri\PostController@save");
Route::post("/asesmen/resiko-melarikan-diri/delete", "Kasus\Asesmen\ResikoMelarikanDiri\PostController@delete");
Route::get("/asesmen/resiko-melarikan-diri/print/{id}", "Kasus\Asesmen\ResikoMelarikanDiri\ViewController@print");

Route::get("/asesmen/resiko-bunuh-diri/", "Kasus\Asesmen\ResikoBunuhDiri\ViewController@index");
Route::post("/asesmen/resiko-bunuh-diri/save", "Kasus\Asesmen\ResikoBunuhDiri\PostController@save");
Route::post("/asesmen/resiko-bunuh-diri/delete", "Kasus\Asesmen\ResikoBunuhDiri\PostController@delete");
Route::get("/asesmen/resiko-bunuh-diri/print/{id}", "Kasus\Asesmen\ResikoBunuhDiri\ViewController@print");
Route::get("/asesmen/resiko-kekerasan-fisik/", "Kasus\Asesmen\ResikoKekerasanFisik\ViewController@index");
Route::post("/asesmen/resiko-kekerasan-fisik/save", "Kasus\Asesmen\ResikoKekerasanFisik\PostController@save");
Route::post("/asesmen/resiko-kekerasan-fisik/delete", "Kasus\Asesmen\ResikoKekerasanFisik\PostController@delete");
Route::get("/asesmen/resiko-kekerasan-fisik/print/{id}", "Kasus\Asesmen\ResikoKekerasanFisik\ViewController@print");

Route::get("/asesmen/asesmen-permohonan-dan-jawaban-konsultasi", "Kasus\Asesmen\AsesmenPermohonanDanJawabanKonsultasi\ViewController@index");
Route::get("/asesmen/asesmen-permohonan-dan-jawaban-konsultasi/form/{alat_bantu_id}", "Kasus\Asesmen\AsesmenPermohonanDanJawabanKonsultasi\ViewController@single");
Route::get("/asesmen/asesmen-permohonan-dan-jawaban-konsultasi/form", "Kasus\Asesmen\AsesmenPermohonanDanJawabanKonsultasi\ViewController@create");
Route::get("/asesmen/asesmen-permohonan-dan-jawaban-konsultasi/form/{alat_bantu_id}/edit", "Kasus\Asesmen\AsesmenPermohonanDanJawabanKonsultasi\ViewController@edit");
Route::get("/asesmen/asesmen-permohonan-dan-jawaban-konsultasi/print/{alat_bantu_id}", "Kasus\Asesmen\AsesmenPermohonanDanJawabanKonsultasi\ViewController@print");
Route::post("/asesmen/asesmen-permohonan-dan-jawaban-konsultasi/form/create", "Kasus\Asesmen\AsesmenPermohonanDanJawabanKonsultasi\CreateController@create");
Route::put("/asesmen/asesmen-permohonan-dan-jawaban-konsultasi/form/{alat_bantu_id}/edit", "Kasus\Asesmen\AsesmenPermohonanDanJawabanKonsultasi\EditController@edit");
Route::post("/asesmen/asesmen-permohonan-dan-jawaban-konsultasi/delete", "Kasus\Asesmen\AsesmenPermohonanDanJawabanKonsultasi\DeleteController@delete");
Route::get("/asesmen/asesmen-permohonan-dan-jawaban-konsultasi/searchICD10", "Kasus\Asesmen\AsesmenPermohonanDanJawabanKonsultasi\PostController@searchICD10");

Route::get("/asesmen/formulir-permintaan-ect", "Kasus\Asesmen\FormulirPermintaanEct\ViewController@index");
Route::get("/asesmen/formulir-permintaan-ect/view/{id}", "Kasus\Asesmen\FormulirPermintaanEct\ViewController@single");
Route::get("/asesmen/formulir-permintaan-ect/create", "Kasus\Asesmen\FormulirPermintaanEct\ViewController@create");
Route::get("/asesmen/formulir-permintaan-ect/edit/{id}", "Kasus\Asesmen\FormulirPermintaanEct\ViewController@edit");
Route::post("/asesmen/formulir-permintaan-ect/submit-form", "Kasus\Asesmen\FormulirPermintaanEct\PostController@submitForm");
Route::post("/asesmen/formulir-permintaan-ect/delete", "Kasus\Asesmen\FormulirPermintaanEct\PostController@delete");
Route::get("/asesmen/formulir-permintaan-ect/print/{id}", "Kasus\Asesmen\FormulirPermintaanEct\ViewController@print");
Route::get("/asesmen/formulir-permintaan-ect/search-user", "Kasus\Asesmen\FormulirPermintaanEct\PostController@searchUser");
Route::post("/asesmen/formulir-permintaan-ect/add-ttd", "Kasus\Asesmen\FormulirPermintaanEct\PostController@addTTD");

Route::get("/asesmen/general-consent", "Kasus\Asesmen\GeneralConsent\ViewController@index");
Route::get("/asesmen/general-consent/single", "Kasus\Asesmen\GeneralConsent\ViewController@single");
Route::get("/asesmen/general-consent/form", "Kasus\Asesmen\GeneralConsent\ViewController@create");
Route::get("/asesmen/general-consent/form/edit", "Kasus\Asesmen\GeneralConsent\ViewController@edit");
Route::get("/asesmen/general-consent/print", "Kasus\Asesmen\GeneralConsent\ViewController@print");
Route::post("/asesmen/general-consent/form/create", "Kasus\Asesmen\GeneralConsent\CreateController@create");
Route::put("/asesmen/general-consent/form/edit", "Kasus\Asesmen\GeneralConsent\EditController@edit");
Route::post("/asesmen/general-consent/delete", "Kasus\Asesmen\GeneralConsent\DeleteController@delete");
Route::post('/asesmen/general-consent/add-ttd', 'Kasus\Asesmen\GeneralConsent\PostController@addTTD');

Route::get("/asesmen/surat-pernyataan-kesanggupan-pembiayaan/", "Kasus\Asesmen\SuratPernyataanKesanggupanPembiayaan\ViewController@index");
Route::post("/asesmen/surat-pernyataan-kesanggupan-pembiayaan/create", "Kasus\Asesmen\SuratPernyataanKesanggupanPembiayaan\PostController@create");
Route::post("/asesmen/surat-pernyataan-kesanggupan-pembiayaan/delete", "Kasus\Asesmen\SuratPernyataanKesanggupanPembiayaan\PostController@delete");
Route::get("/asesmen/surat-pernyataan-kesanggupan-pembiayaan/print", "Kasus\Asesmen\SuratPernyataanKesanggupanPembiayaan\ViewController@print");
Route::post("/asesmen/surat-pernyataan-kesanggupan-pembiayaan/add-ttd", "Kasus\Asesmen\SuratPernyataanKesanggupanPembiayaan\PostController@APIAddTTD");
// START : Form Triage
Route::get("/form-triage", "Kasus\Asesmen\FormTriage\ViewController@index");
Route::post("/form-triage/save", "Kasus\Asesmen\FormTriage\PostController@save");
Route::post("/form-triage/delete", "Kasus\Asesmen\FormTriage\PostController@delete");
Route::get("/form-triage/print/{id}", "Kasus\Asesmen\FormTriage\ViewController@print");
// START : Asesmen Awal Dokter Non Jiwa
Route::get("/asesmen/asesmen-awal-dokter-non-jiwa/", "Kasus\Asesmen\AsesmenAwalDokterNonJiwa\ViewController@index");
Route::post("/asesmen/asesmen-awal-dokter-non-jiwa/save", "Kasus\Asesmen\AsesmenAwalDokterNonJiwa\PostController@save");
Route::post("/asesmen/asesmen-awal-dokter-non-jiwa/delete", "Kasus\Asesmen\AsesmenAwalDokterNonJiwa\PostController@delete");
Route::get("/asesmen/asesmen-awal-dokter-non-jiwa/print/{id}/{type}", "Kasus\Asesmen\AsesmenAwalDokterNonJiwa\ViewController@print");
// END : Asesmen Awal Dokter Non Jiwa

Route::get("/asesmen/asesmen-kesehatan-gigi-dan-mulut", "Kasus\Asesmen\AsesmenKesehatanGigiDanMulut\ViewController@index");
Route::get("/asesmen/asesmen-kesehatan-gigi-dan-mulut/view/{id}", "Kasus\Asesmen\AsesmenKesehatanGigiDanMulut\ViewController@single");
Route::get("/asesmen/asesmen-kesehatan-gigi-dan-mulut/create", "Kasus\Asesmen\AsesmenKesehatanGigiDanMulut\ViewController@create");
Route::get("/asesmen/asesmen-kesehatan-gigi-dan-mulut/edit/{id}", "Kasus\Asesmen\AsesmenKesehatanGigiDanMulut\ViewController@edit");
Route::post("/asesmen/asesmen-kesehatan-gigi-dan-mulut/submit-form", "Kasus\Asesmen\AsesmenKesehatanGigiDanMulut\PostController@submitForm");
Route::post("/asesmen/asesmen-kesehatan-gigi-dan-mulut/delete", "Kasus\Asesmen\AsesmenKesehatanGigiDanMulut\PostController@delete");
Route::get("/asesmen/asesmen-kesehatan-gigi-dan-mulut/print/{id}", "Kasus\Asesmen\AsesmenKesehatanGigiDanMulut\ViewController@print");


#asesmen awal keperawatan medis neonatologi
Route::get("/asesmen/asesmen-awal-keperawatan-medis-neonatologi", "Kasus\Asesmen\AsesmenAwalKeperawatanMedisNeonatologi\ViewController@index");
Route::get("/asesmen/asesmen-awal-keperawatan-medis-neonatologi/view/{id}", "Kasus\Asesmen\AsesmenAwalKeperawatanMedisNeonatologi\ViewController@single");
Route::get("/asesmen/asesmen-awal-keperawatan-medis-neonatologi/create", "Kasus\Asesmen\AsesmenAwalKeperawatanMedisNeonatologi\ViewController@create");
Route::get("/asesmen/asesmen-awal-keperawatan-medis-neonatologi/edit/{id}", "Kasus\Asesmen\AsesmenAwalKeperawatanMedisNeonatologi\ViewController@edit");
Route::post("/asesmen/asesmen-awal-keperawatan-medis-neonatologi/submit-form", "Kasus\Asesmen\AsesmenAwalKeperawatanMedisNeonatologi\PostController@submitForm");
Route::post("/asesmen/asesmen-awal-keperawatan-medis-neonatologi/delete", "Kasus\Asesmen\AsesmenAwalKeperawatanMedisNeonatologi\PostController@delete");
Route::get("/asesmen/asesmen-awal-keperawatan-medis-neonatologi/print/{id}", "Kasus\Asesmen\AsesmenAwalKeperawatanMedisNeonatologi\ViewController@print");
Route::get("/asesmen/asesmen-awal-keperawatan-medis-neonatologi/search-user", "Kasus\Asesmen\AsesmenAwalKeperawatanMedisNeonatologi\PostController@searchUser");
Route::post("/asesmen/asesmen-awal-keperawatan-medis-neonatologi/add-ttd", "Kasus\Asesmen\AsesmenAwalKeperawatanMedisNeonatologi\PostController@addTTD");

#asesmen awal medis neonatologi
Route::get("/asesmen/asesmen-awal-medis-neonatologi", "Kasus\Asesmen\AsesmenAwalMedisNeonatologi\ViewController@index");
Route::get("/asesmen/asesmen-awal-medis-neonatologi/view/{id}", "Kasus\Asesmen\AsesmenAwalMedisNeonatologi\ViewController@single");
Route::get("/asesmen/asesmen-awal-medis-neonatologi/create", "Kasus\Asesmen\AsesmenAwalMedisNeonatologi\ViewController@create");
Route::get("/asesmen/asesmen-awal-medis-neonatologi/edit/{id}", "Kasus\Asesmen\AsesmenAwalMedisNeonatologi\ViewController@edit");
Route::post("/asesmen/asesmen-awal-medis-neonatologi/submit-form", "Kasus\Asesmen\AsesmenAwalMedisNeonatologi\PostController@submitForm");
Route::post("/asesmen/asesmen-awal-medis-neonatologi/delete", "Kasus\Asesmen\AsesmenAwalMedisNeonatologi\PostController@delete");
Route::get("/asesmen/asesmen-awal-medis-neonatologi/print/{id}", "Kasus\Asesmen\AsesmenAwalMedisNeonatologi\ViewController@print");
Route::get("/asesmen/asesmen-awal-medis-neonatologi/search-user", "Kasus\Asesmen\AsesmenAwalMedisNeonatologi\PostController@searchUser");
Route::post("/asesmen/asesmen-awal-medis-neonatologi/add-ttd", "Kasus\Asesmen\AsesmenAwalMedisNeonatologi\PostController@addTTD");

#asesmen inform consent cabut gigi
Route::get("/asesmen/asesmen-inform-consent-cabut-gigi", "Kasus\Asesmen\AsesmenInformConsentCabutGigi\ViewController@index");
Route::get("/asesmen/asesmen-inform-consent-cabut-gigi/view/{id}", "Kasus\Asesmen\AsesmenInformConsentCabutGigi\ViewController@single");
Route::get("/asesmen/asesmen-inform-consent-cabut-gigi/create", "Kasus\Asesmen\AsesmenInformConsentCabutGigi\ViewController@create");
Route::get("/asesmen/asesmen-inform-consent-cabut-gigi/edit/{id}", "Kasus\Asesmen\AsesmenInformConsentCabutGigi\ViewController@edit");
Route::post("/asesmen/asesmen-inform-consent-cabut-gigi/submit-form", "Kasus\Asesmen\AsesmenInformConsentCabutGigi\PostController@submitForm");
Route::post("/asesmen/asesmen-inform-consent-cabut-gigi/delete", "Kasus\Asesmen\AsesmenInformConsentCabutGigi\PostController@delete");
Route::get("/asesmen/asesmen-inform-consent-cabut-gigi/print/{id}", "Kasus\Asesmen\AsesmenInformConsentCabutGigi\ViewController@print");
Route::get("/asesmen/asesmen-inform-consent-cabut-gigi/search-user", "Kasus\Asesmen\AsesmenInformConsentCabutGigi\PostController@searchUser");
Route::post("/asesmen/asesmen-inform-consent-cabut-gigi/add-ttd", "Kasus\Asesmen\AsesmenInformConsentCabutGigi\PostController@addTTD");

Route::get('/asesmen/asesmen-identitikasi-bayi', 'Kasus\Asesmen\IdentifikasiBayi\ViewController@index');
Route::post('/asesmen/asesmen-identitikasi-bayi/save', 'Kasus\Asesmen\IdentifikasiBayi\PostController@save');
Route::post('/asesmen/asesmen-identitikasi-bayi/delete', 'Kasus\Asesmen\IdentifikasiBayi\PostController@delete');
Route::get('/asesmen/asesmen-identitikasi-bayi/print/{id}', 'Kasus\Asesmen\IdentifikasiBayi\ViewController@print');