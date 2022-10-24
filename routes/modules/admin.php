<?php
Route::group(['prefix' => 'api/admin'], function(){
	Route::get('/user-control/deaktif/{id}','Admin\UserControl\EditController@deaktifAjax');
	Route::get('/user-control/aktif/{id}','Admin\UserControl\EditController@aktifAjax');
	Route::get('/user-control/reset/{id}','Admin\UserControl\EditController@resetAjax');
	Route::get('/user-control/load-table','Admin\UserControl\ReadController@loadTable');
	Route::get('/tni-satker/aktif-print/{id}/{flag}','Admin\TNISatker\EditController@aktifPrintAjax');
});

Route::group(['middleware' => ['check-module']], function(){
	Route::group(['prefix' => 'admin'], function () {

		Route::get('form-builder/create', 'Admin\FormBuilder\ViewController@create');
		Route::post('form-builder/create', 'Admin\FormBuilder\PostController@create');

		Route::get('/','Admin\Hospital\ViewController@index');
		Route::get('/kasus/form-builder/create', 'Admin\Kasus\FormBuilder\ViewController@create');
		Route::post('/kasus/form-builder/create', 'Admin\Kasus\FormBuilder\PostController@create');


		Route::get('/hospital','Admin\Hospital\ViewController@index');
		Route::post('/hospital/edit','Admin\Hospital\PostController@edit');

        Route::get('/administrasi','Admin\Administrasi\ViewController@index');
        Route::post('/administrasi/edit','Admin\Administrasi\PostController@edit');

		Route::get('/agama','Admin\Agama\ViewController@index');
		Route::get('/agama/baru','Admin\Agama\ViewController@create');
		Route::post('/agama/simpan','Admin\Agama\PostController@create');
		Route::get('/agama/edit/{id}','Admin\Agama\ViewController@edit');
		Route::get('/agama/delete/{id}','Admin\Agama\PostController@delete');

		Route::get('kasus/informed-consent','Admin\Kasus\InformedConsent\ViewController@index');
		Route::get('kasus/informed-consent/baru','Admin\Kasus\InformedConsent\ViewController@create');
		Route::post('kasus/informed-consent/simpan','Admin\Kasus\InformedConsent\PostController@create');
		Route::get('kasus/informed-consent/edit/{id}','Admin\Kasus\InformedConsent\ViewController@edit');
		Route::get('kasus/informed-consent/delete/{id}','Admin\Kasus\InformedConsent\PostController@delete');

		Route::get('/lokasi','Admin\Lokasi\ViewController@index');
		Route::get('/lokasi/baru','Admin\Lokasi\ViewController@create');
		Route::post('/lokasi/simpan','Admin\Lokasi\PostController@create');
		Route::get('/lokasi/edit/{id}','Admin\Lokasi\ViewController@edit');
		Route::get('/lokasi/delete/{id}','Admin\Lokasi\PostController@delete');

		Route::get('/lokasi-zona-ppi','Admin\LokasiZonaPPI\ViewController@index');
		Route::get('/lokasi-zona-ppi/baru','Admin\LokasiZonaPPI\ViewController@create');
		Route::post('/lokasi-zona-ppi/simpan','Admin\LokasiZonaPPI\PostController@create');
		Route::get('/lokasi-zona-ppi/edit/{id}','Admin\LokasiZonaPPI\ViewController@edit');
		Route::get('/lokasi-zona-ppi/delete/{id}','Admin\LokasiZonaPPI\PostController@delete');

		Route::get('/kelas','Admin\Kelas\ViewController@index');
		Route::get('/kelas/baru','Admin\Kelas\ViewController@create');
		Route::post('/kelas/simpan','Admin\Kelas\PostController@create');
		Route::get('/kelas/edit/{id}','Admin\Kelas\ViewController@edit');
		Route::get('/kelas/delete/{id}','Admin\Kelas\PostController@delete');

		Route::get('/pernikahan','Admin\Pernikahan\ViewController@index');
		Route::get('/pernikahan/baru','Admin\Pernikahan\ViewController@create');
		Route::post('/pernikahan/simpan','Admin\Pernikahan\PostController@create');
		Route::get('/pernikahan/edit/{id}','Admin\Pernikahan\ViewController@edit');
		Route::get('/pernikahan/delete/{id}','Admin\Pernikahan\PostController@delete');

		Route::get('/pekerjaan','Admin\Pekerjaan\ViewController@index');
		Route::get('/pekerjaan/baru','Admin\Pekerjaan\ViewController@create');
		Route::post('/pekerjaan/simpan','Admin\Pekerjaan\PostController@create');
		Route::get('/pekerjaan/edit/{id}','Admin\Pekerjaan\ViewController@edit');
		Route::get('/pekerjaan/delete/{id}','Admin\Pekerjaan\PostController@delete');

		Route::get('/pembayaran','Admin\Pembayaran\ViewController@index');
		Route::get('/pembayaran/baru','Admin\Pembayaran\ViewController@create');
		Route::post('/pembayaran/simpan','Admin\Pembayaran\PostController@create');
		Route::get('/pembayaran/edit/{id}','Admin\Pembayaran\ViewController@edit');
		Route::get('/pembayaran/delete/{id}','Admin\Pembayaran\PostController@delete');

		Route::get('/identitas','Admin\Identitas\ViewController@index');
		Route::get('/identitas/baru','Admin\Identitas\ViewController@create');
		Route::post('/identitas/simpan','Admin\Identitas\PostController@create');
		Route::get('/identitas/edit/{id}','Admin\Identitas\ViewController@edit');
		Route::get('/identitas/delete/{id}','Admin\Identitas\PostController@delete');

		Route::get('/keluarga','Admin\Keluarga\ViewController@index');
		Route::get('/keluarga/baru','Admin\Keluarga\ViewController@create');
		Route::post('/keluarga/simpan','Admin\Keluarga\PostController@create');
		Route::get('/keluarga/edit/{id}','Admin\Keluarga\ViewController@edit');
		Route::get('/keluarga/delete/{id}','Admin\Keluarga\PostController@delete');

		Route::get('/pembayaran-perusahaan','Admin\PembayaranPerusahaan\ViewController@index');
		Route::get('/pembayaran-perusahaan/data','Admin\PembayaranPerusahaan\ViewController@getData');
		Route::get('/pembayaran-perusahaan/baru','Admin\PembayaranPerusahaan\ViewController@create');
		Route::post('/pembayaran-perusahaan/simpan','Admin\PembayaranPerusahaan\PostController@create');
		Route::get('/pembayaran-perusahaan/edit/{id}','Admin\PembayaranPerusahaan\ViewController@edit');
		Route::get('/pembayaran-perusahaan/delete/{id}','Admin\PembayaranPerusahaan\PostController@delete');

		Route::get('/pembayaran-perusahaan-type','Admin\PembayaranPerusahaanType\ViewController@index');
		Route::get('/pembayaran-perusahaan-type/data','Admin\PembayaranPerusahaanType\ViewController@getData');
		Route::get('/pembayaran-perusahaan-type/baru','Admin\PembayaranPerusahaanType\ViewController@create');
		Route::post('/pembayaran-perusahaan-type/simpan','Admin\PembayaranPerusahaanType\PostController@create');
		Route::get('/pembayaran-perusahaan-type/edit/{id}','Admin\PembayaranPerusahaanType\ViewController@edit');
		Route::get('/pembayaran-perusahaan-type/delete/{id}','Admin\PembayaranPerusahaanType\PostController@delete');

		Route::get('/tni-keanggotaan','Admin\TNIKeanggotaan\ViewController@index');
		Route::get('/tni-keanggotaan/redesign','Admin\TNIKeanggotaan\ViewController@redesign');
		Route::get('/tni-keanggotaan/data','Admin\TNIKeanggotaan\ViewController@getData');
		Route::get('/tni-keanggotaan/baru','Admin\TNIKeanggotaan\ViewController@create');
		Route::post('/tni-keanggotaan/simpan','Admin\TNIKeanggotaan\PostController@create');
		Route::get('/tni-keanggotaan/edit/{id}','Admin\TNIKeanggotaan\ViewController@edit');
		Route::get('/tni-keanggotaan/delete/{id}','Admin\TNIKeanggotaan\PostController@delete');
		Route::post('/tni-keanggotaan/mass-edit','Admin\TNIKeanggotaan\PostController@massEdit');
		Route::post('/tni-keanggotaan/mass-simpan','Admin\TNIKeanggotaan\PostController@massCreate');

		Route::get('/tni-pangkat','Admin\TNIPangkat\ViewController@index');
		Route::get('/tni-pangkat/data','Admin\TNIPangkat\ViewController@getData');
		Route::get('/tni-pangkat/baru','Admin\TNIPangkat\ViewController@create');
		Route::post('/tni-pangkat/simpan','Admin\TNIPangkat\PostController@create');
		Route::get('/tni-pangkat/edit/{id}','Admin\TNIPangkat\ViewController@edit');
		Route::get('/tni-pangkat/delete/{id}','Admin\TNIPangkat\PostController@delete');

		Route::get('/tni-pangkat-jenjang','Admin\TNIPangkatJenjang\ViewController@index');
		Route::get('/tni-pangkat-jenjang/data','Admin\TNIPangkatJenjang\ViewController@getData');
		Route::get('/tni-pangkat-jenjang/baru','Admin\TNIPangkatJenjang\ViewController@create');
		Route::post('/tni-pangkat-jenjang/simpan','Admin\TNIPangkatJenjang\PostController@create');
		Route::get('/tni-pangkat-jenjang/edit/{id}','Admin\TNIPangkatJenjang\ViewController@edit');
		Route::get('/tni-pangkat-jenjang/delete/{id}','Admin\TNIPangkatJenjang\PostController@delete');

		Route::get('/tni-korps','Admin\TNIKorps\ViewController@index');
		Route::get('/tni-korps/data','Admin\TNIKorps\ViewController@getData');
		Route::get('/tni-korps/baru','Admin\TNIKorps\ViewController@create');
		Route::post('/tni-korps/simpan','Admin\TNIKorps\PostController@create');
		Route::get('/tni-korps/edit/{id}','Admin\TNIKorps\ViewController@edit');
		Route::get('/tni-korps/delete/{id}','Admin\TNIKorps\PostController@delete');

		Route::get('/tni-kotama','Admin\TNIKotama\ViewController@index');
		Route::get('/tni-kotama/redesign','Admin\TNIKotama\ViewController@redesign');
		Route::get('/tni-kotama/data','Admin\TNIKotama\ViewController@getData');
		Route::get('/tni-kotama/baru','Admin\TNIKotama\ViewController@create');
		Route::post('/tni-kotama/simpan','Admin\TNIKotama\PostController@create');
		Route::get('/tni-kotama/edit/{id}','Admin\TNIKotama\ViewController@edit');
		Route::get('/tni-kotama/delete/{id}','Admin\TNIKotama\PostController@delete');
		Route::post('/tni-kotama/mass-edit','Admin\TNIKotama\PostController@massEdit');
		Route::post('/tni-kotama/mass-simpan','Admin\TNIKotama\PostController@massCreate');

		Route::get('/tni-satker','Admin\TNISatker\ViewController@indexKotama');
		Route::get('/tni-satker/kotama/{kotama_id}','Admin\TNISatker\ViewController@indexKotama');
		Route::get('/tni-satker/redesign','Admin\TNISatker\ViewController@redesign');
		Route::get('/tni-satker/data','Admin\TNISatker\ViewController@getData');
		Route::get('/tni-satker/baru','Admin\TNISatker\ViewController@create');
		Route::post('/tni-satker/simpan','Admin\TNISatker\PostController@create');
		Route::get('/tni-satker/edit/{id}','Admin\TNISatker\ViewController@edit');
		Route::get('/tni-satker/delete/{id}','Admin\TNISatker\PostController@delete');
		Route::post('/tni-satker/mass-simpan','Admin\TNISatker\PostController@massCreate');

		Route::get('/kasus/form-builder/{id}', 'Admin\Kasus\FormBuilder\ViewController@single');
		Route::get('/kasus/form-builder/{id}/edit', 'Admin\Kasus\FormBuilder\ViewController@edit');
		Route::post('/kasus/form-builder/{id}/edit', 'Admin\Kasus\FormBuilder\PostController@edit');

		Route::get('/user-control','Admin\UserControl\ViewController@index');
		Route::get('/user-control/{id}/edit','Admin\UserControl\ViewController@edit');
		Route::post('/user-control/{id}/edit', 'Admin\UserControl\EditController@edit');
		Route::get('/user-control/deaktif/{id}','Admin\UserControl\EditController@deaktif');
		Route::get('/user-control/aktif/{id}','Admin\UserControl\EditController@aktif');
		Route::get('/user-control/admin/{id}','Admin\UserControl\EditController@admin');
		Route::get('/user-control/remove-admin/{id}','Admin\UserControl\EditController@removeAdmin');
		Route::get('/user-control/reset/{id}','Admin\UserControl\EditController@reset');


		Route::get('/tarif', 'Admin\Tarif\ViewController@index');
		Route::get('/tarif/baru', 'Admin\Tarif\ViewController@create');
		Route::get('/tarif/{id}', 'Admin\Tarif\ViewController@single');
		Route::get('/tarif/{id}/edit-inacbg/{tarif_id}', 'Admin\Tarif\ViewController@editINACBG');
		Route::post('/tarif/{id}/edit-inacbg/{tarif_id}', 'Admin\Tarif\PostController@editINACBG');
		Route::post('/tarif/baru', 'Admin\Tarif\PostController@create');
		Route::post('/tarif/baru/create', 'Admin\Tarif\CreateController@create');
		Route::get('/tarif/edit/{id}', 'Admin\Tarif\ViewController@edit');
		Route::post('/tarif/edit/{id}', 'Admin\Tarif\PostController@edit');
		Route::post('/tarif/delete', 'Admin\Tarif\PostController@delete');


		Route::get('/tarif-tipe', 'Admin\TarifTipe\ViewController@index');
		Route::get('/tarif-tipe/baru', 'Admin\TarifTipe\ViewController@create');
		Route::get('/tarif-tipe/{id}', 'Admin\TarifTipe\ViewController@single');
		Route::get('/tarif-tipe/edit/{id}', 'Admin\TarifTipe\ViewController@edit');
		Route::post('/tarif-tipe/edit/{id}', 'Admin\TarifTipe\PostController@edit');
		Route::post('/tarif-tipe/delete', 'Admin\TarifTipe\PostController@delete');
		Route::post('/tarif-tipe/baru', 'Admin\TarifTipe\PostController@create');
		Route::post('/tarif-tipe/baru/create', 'Admin\TarifTipe\CreateController@create');


		Route::get('/tarif-kategori', 'Admin\TarifKategori\ViewController@index');
		Route::get('/tarif-kategori/baru', 'Admin\TarifKategori\ViewController@create');
		Route::get('/tarif-kategori/{id}', 'Admin\TarifKategori\ViewController@single');
		Route::get('/tarif-kategori/edit/{id}', 'Admin\TarifKategori\ViewController@edit');
		Route::post('/tarif-kategori/edit/{id}', 'Admin\TarifKategori\PostController@edit');
		Route::post('/tarif-kategori/delete', 'Admin\TarifKategori\PostController@delete');
		Route::post('/tarif-kategori/baru', 'Admin\TarifKategori\PostController@create');
		Route::post('/tarif-kategori/baru/create', 'Admin\TarifKategori\CreateController@create');


		Route::get('/tarif-kategori-inacbg', 'Admin\TarifKategoriINACBG\ViewController@index');
		Route::post('/tarif-kategori-inacbg/delete', 'Admin\TarifKategoriINACBG\PostController@delete');
		Route::post('/tarif-kategori-inacbg/simpan', 'Admin\TarifKategoriINACBG\PostController@add');


		Route::get('/obat', 'Admin\ObatMaster\ViewController@index');
		Route::get('/obat/baru', 'Admin\ObatMaster\ViewController@create');
		Route::get('/obat/{id}', 'Admin\ObatMaster\ViewController@single');
		Route::get('/obat/edit/{id}', 'Admin\ObatMaster\ViewController@edit');
		Route::post('/obat/edit/{id}', 'Admin\ObatMaster\PostController@edit');
		Route::post('/obat/delete', 'Admin\ObatMaster\PostController@delete');
		Route::post('/obat/baru', 'Admin\ObatMaster\PostController@create');
		Route::post('/obat/baru/create', 'Admin\ObatMaster\CreateController@create');


		Route::get('/obat-tipe', 'Admin\ObatTipe\ViewController@index');
		Route::get('/obat-tipe/baru', 'Admin\ObatTipe\ViewController@create');
		Route::get('/obat-tipe/{id}', 'Admin\ObatTipe\ViewController@single');
		Route::get('/obat-tipe/edit/{id}', 'Admin\ObatTipe\ViewController@edit');
		Route::post('/obat-tipe/edit/{id}', 'Admin\ObatTipe\PostController@edit');
		Route::post('/obat-tipe/delete', 'Admin\ObatTipe\PostController@delete');
		Route::post('/obat-tipe/baru', 'Admin\ObatTipe\PostController@create');
		Route::post('/obat-tipe/baru/create', 'Admin\ObatTipe\CreateController@create');


		Route::get('/obat-aturan', 'Admin\ObatAturan\ViewController@index');
		Route::get('/obat-aturan/baru', 'Admin\ObatAturan\ViewController@create');
		Route::get('/obat-aturan/{id}', 'Admin\ObatAturan\ViewController@single');
		Route::get('/obat-aturan/edit/{id}', 'Admin\ObatAturan\ViewController@edit');
		Route::post('/obat-aturan/edit/{id}', 'Admin\ObatAturan\PostController@edit');
		Route::post('/obat-aturan/delete', 'Admin\ObatAturan\PostController@delete');
		Route::post('/obat-aturan/baru', 'Admin\ObatAturan\PostController@create');
		Route::post('/obat-aturan/baru/create', 'Admin\ObatAturan\CreateController@create');
		
		Route::get('/dokter', 'Admin\Dokter\ViewController@index');
		Route::get('/dokter/baru', 'Admin\Dokter\ViewController@create');
		Route::get('/dokter/{id}', 'Admin\Dokter\ViewController@single');
		Route::get('/dokter/edit/{id}', 'Admin\Dokter\ViewController@edit');
		Route::post('/dokter/edit/{id}', 'Admin\Dokter\PostController@edit');
		Route::post('/dokter/delete', 'Admin\Dokter\PostController@delete');
		Route::post('/dokter/baru', 'Admin\Dokter\PostController@create');
		Route::post('/dokter/baru/create', 'Admin\Dokter\CreateController@create');

		Route::get('/data-import', 'Admin\DataImport\ViewController@index');
		Route::get('/data-import/create', 'Admin\DataImport\ViewController@create');
		Route::post('/data-import/create', 'Admin\DataImport\PostController@create');

		Route::get('/data-export/pasien/{start?}/{end?}', 'Admin\DataExport\ViewController@pasien');
		Route::get('/data-export/tarif-kategori/{start?}/{end?}', 'Admin\DataExport\ViewController@tarifKategori');
		Route::get('/data-export/tarif/{start?}/{end?}', 'Admin\DataExport\ViewController@tarif');
		Route::get('/data-export/dokter-poliklinik/{start?}/{end?}', 'Admin\DataExport\ViewController@dokterPoliklinik');
		Route::get('/data-export/farmasi-obat/{start?}/{end?}', 'Admin\DataExport\ViewController@farmasiObat');

		Route::get('/tempat-tidur-jenis','Admin\TempatTidurJenis\ViewController@index');
		Route::get('/tempat-tidur-jenis/baru','Admin\TempatTidurJenis\ViewController@create');
		Route::post('/tempat-tidur-jenis/simpan','Admin\TempatTidurJenis\PostController@create');
		Route::get('/tempat-tidur-jenis/edit/{id}','Admin\TempatTidurJenis\ViewController@edit');
		Route::get('/tempat-tidur-jenis/delete/{id}','Admin\TempatTidurJenis\PostController@delete');

		Route::get('/tempat-tidur-kelas','Admin\TempatTidurKelas\ViewController@index');
		Route::get('/tempat-tidur-kelas/baru','Admin\TempatTidurKelas\ViewController@create');
		Route::post('/tempat-tidur-kelas/simpan','Admin\TempatTidurKelas\PostController@create');
		Route::get('/tempat-tidur-kelas/edit/{id}','Admin\TempatTidurKelas\ViewController@edit');
		Route::get('/tempat-tidur-kelas/delete/{id}','Admin\TempatTidurKelas\PostController@delete');

		Route::get('/sirs-spesialisasi-bedah','Admin\SirsSpesialisasiBedah\ViewController@index');
		Route::get('/sirs-spesialisasi-bedah/baru','Admin\SirsSpesialisasiBedah\ViewController@create');
		Route::post('/sirs-spesialisasi-bedah/simpan','Admin\SirsSpesialisasiBedah\PostController@create');
		Route::get('/sirs-spesialisasi-bedah/edit/{id}','Admin\SirsSpesialisasiBedah\ViewController@edit');
		Route::get('/sirs-spesialisasi-bedah/delete/{id}','Admin\SirsSpesialisasiBedah\PostController@delete');

		Route::get('/sirs-kegiatan-radiologi','Admin\SirsKegiatanRadiologi\ViewController@index');
		Route::get('/sirs-kegiatan-radiologi/baru','Admin\SirsKegiatanRadiologi\ViewController@create');
		Route::post('/sirs-kegiatan-radiologi/simpan','Admin\SirsKegiatanRadiologi\PostController@create');
		Route::get('/sirs-kegiatan-radiologi/edit/{id}','Admin\SirsKegiatanRadiologi\ViewController@edit');
		Route::get('/sirs-kegiatan-radiologi/delete/{id}','Admin\SirsKegiatanRadiologi\PostController@delete');

		Route::get('/sirs-kegiatan-perinatologi','Admin\SirsKegiatanPerinatologi\ViewController@index');
		Route::get('/sirs-kegiatan-perinatologi/baru','Admin\SirsKegiatanPerinatologi\ViewController@create');
		Route::post('/sirs-kegiatan-perinatologi/simpan','Admin\SirsKegiatanPerinatologi\PostController@create');
		Route::get('/sirs-kegiatan-perinatologi/edit/{id}','Admin\SirsKegiatanPerinatologi\ViewController@edit');
		Route::get('/sirs-kegiatan-perinatologi/delete/{id}','Admin\SirsKegiatanPerinatologi\PostController@delete');

		Route::get('/sirs-kegiatan-lab','Admin\SirsKegiatanLab\ViewController@index');
		Route::get('/sirs-kegiatan-lab/baru','Admin\SirsKegiatanLab\ViewController@create');
		Route::post('/sirs-kegiatan-lab/simpan','Admin\SirsKegiatanLab\PostController@create');
		Route::get('/sirs-kegiatan-lab/edit/{id}','Admin\SirsKegiatanLab\ViewController@edit');
		Route::get('/sirs-kegiatan-lab/delete/{id}','Admin\SirsKegiatanLab\PostController@delete');

		Route::get('/sirs-kegiatan-gigi-mulut','Admin\SirsKegiatanGigiMulut\ViewController@index');
		Route::get('/sirs-kegiatan-gigi-mulut/baru','Admin\SirsKegiatanGigiMulut\ViewController@create');
		Route::post('/sirs-kegiatan-gigi-mulut/simpan','Admin\SirsKegiatanGigiMulut\PostController@create');
		Route::get('/sirs-kegiatan-gigi-mulut/edit/{id}','Admin\SirsKegiatanGigiMulut\ViewController@edit');
		Route::get('/sirs-kegiatan-gigi-mulut/delete/{id}','Admin\SirsKegiatanGigiMulut\PostController@delete');

		Route::get('/sirs-kegiatan-rehab-medik','Admin\SirsKegiatanRehabMedik\ViewController@index');
		Route::get('/sirs-kegiatan-rehab-medik/baru','Admin\SirsKegiatanRehabMedik\ViewController@create');
		Route::post('/sirs-kegiatan-rehab-medik/simpan','Admin\SirsKegiatanRehabMedik\PostController@create');
		Route::get('/sirs-kegiatan-rehab-medik/edit/{id}','Admin\SirsKegiatanRehabMedik\ViewController@edit');
		Route::get('/sirs-kegiatan-rehab-medik/delete/{id}','Admin\SirsKegiatanRehabMedik\PostController@delete');

		Route::get('/sirs-kegiatan-pelayanan-khusus','Admin\SirsKegiatanPelayananKhusus\ViewController@index');
		Route::get('/sirs-kegiatan-pelayanan-khusus/baru','Admin\SirsKegiatanPelayananKhusus\ViewController@create');
		Route::post('/sirs-kegiatan-pelayanan-khusus/simpan','Admin\SirsKegiatanPelayananKhusus\PostController@create');
		Route::get('/sirs-kegiatan-pelayanan-khusus/edit/{id}','Admin\SirsKegiatanPelayananKhusus\ViewController@edit');
		Route::get('/sirs-kegiatan-pelayanan-khusus/delete/{id}','Admin\SirsKegiatanPelayananKhusus\PostController@delete');

		Route::get('/sirs-kegiatan-kesehatan-jiwa','Admin\SirsKegiatanKesehatanJiwa\ViewController@index');
		Route::get('/sirs-kegiatan-kesehatan-jiwa/baru','Admin\SirsKegiatanKesehatanJiwa\ViewController@create');
		Route::post('/sirs-kegiatan-kesehatan-jiwa/simpan','Admin\SirsKegiatanKesehatanJiwa\PostController@create');
		Route::get('/sirs-kegiatan-kesehatan-jiwa/edit/{id}','Admin\SirsKegiatanKesehatanJiwa\ViewController@edit');
		Route::get('/sirs-kegiatan-kesehatan-jiwa/delete/{id}','Admin\SirsKegiatanKesehatanJiwa\PostController@delete');

		Route::get('/sirs-cara-bayar','Admin\SirsCaraBayar\ViewController@index');
		Route::get('/sirs-cara-bayar/baru','Admin\SirsCaraBayar\ViewController@create');
		Route::post('/sirs-cara-bayar/simpan','Admin\SirsCaraBayar\PostController@create');
		Route::get('/sirs-cara-bayar/edit/{id}','Admin\SirsCaraBayar\ViewController@edit');
		Route::get('/sirs-cara-bayar/delete/{id}','Admin\SirsCaraBayar\PostController@delete');

		Route::get('/sirs-kunjungan-kegiatan','Admin\SirsKunjunganKegiatan\ViewController@index');
		Route::get('/sirs-kunjungan-kegiatan/baru','Admin\SirsKunjunganKegiatan\ViewController@create');
		Route::post('/sirs-kunjungan-kegiatan/simpan','Admin\SirsKunjunganKegiatan\PostController@create');
		Route::get('/sirs-kunjungan-kegiatan/edit/{id}','Admin\SirsKunjunganKegiatan\ViewController@edit');
		Route::get('/sirs-kunjungan-kegiatan/delete/{id}','Admin\SirsKunjunganKegiatan\PostController@delete');

		Route::get('/sirs-spesialisasi-rujukan','Admin\SirsSpesialisasiRujukan\ViewController@index');
		Route::get('/sirs-spesialisasi-rujukan/baru','Admin\SirsSpesialisasiRujukan\ViewController@create');
		Route::post('/sirs-spesialisasi-rujukan/simpan','Admin\SirsSpesialisasiRujukan\PostController@create');
		Route::get('/sirs-spesialisasi-rujukan/edit/{id}','Admin\SirsSpesialisasiRujukan\ViewController@edit');
		Route::get('/sirs-spesialisasi-rujukan/delete/{id}','Admin\SirsSpesialisasiRujukan\PostController@delete');
		Route::get('/sirs-spesialisasi-rujukan/delete-icd10/{id}','Admin\SirsSpesialisasiRujukan\PostController@deleteICD10');

		Route::get('/sirs-kegiatan-kebidanan','Admin\SirsKegiatanKebidanan\ViewController@index');
		Route::get('/sirs-kegiatan-kebidanan/baru','Admin\SirsKegiatanKebidanan\ViewController@create');
		Route::post('/sirs-kegiatan-kebidanan/simpan','Admin\SirsKegiatanKebidanan\PostController@create');
		Route::get('/sirs-kegiatan-kebidanan/edit/{id}','Admin\SirsKegiatanKebidanan\ViewController@edit');
		Route::get('/sirs-kegiatan-kebidanan/delete/{id}','Admin\SirsKegiatanKebidanan\PostController@delete');		
		Route::get('/sirs-kegiatan-kebidanan/delete-icd9/{id}','Admin\SirsKegiatanKebidanan\PostController@deleteICD9');
		Route::get('/sirs-kegiatan-kebidanan/delete-icd10/{id}','Admin\SirsKegiatanKebidanan\PostController@deleteICD10');

		Route::get('/cara-pulang', 'Admin\CaraPulang\ViewController@index');
		Route::get('/cara-pulang/baru', 'Admin\CaraPulang\ViewController@create');
		Route::post('/cara-pulang/baru', 'Admin\CaraPulang\PostController@create');
		Route::get('/cara-pulang/edit/{id}', 'Admin\CaraPulang\ViewController@edit');
		Route::post('/cara-pulang/edit/{id}', 'Admin\CaraPulang\PostController@edit');
		Route::post('/cara-pulang/delete', 'Admin\CaraPulang\PostController@delete');

		Route::get('/cara-pulang-inacbg', 'Admin\CaraPulangINACBG\ViewController@index');
		Route::post('/cara-pulang-inacbg/delete', 'Admin\CaraPulangINACBG\PostController@delete');
		Route::post('/cara-pulang-inacbg/simpan', 'Admin\CaraPulangINACBG\PostController@add');

        Route::get('/status-pulang', 'Admin\StatusPulang\ViewController@index');
        Route::get('/status-pulang/baru', 'Admin\StatusPulang\ViewController@create');
        Route::post('/status-pulang/baru', 'Admin\StatusPulang\PostController@create');
        Route::get('/status-pulang/edit/{id}', 'Admin\StatusPulang\ViewController@edit');
        Route::post('/status-pulang/edit/{id}', 'Admin\StatusPulang\PostController@edit');
        Route::post('/status-pulang/delete', 'Admin\StatusPulang\PostController@delete');
		
		##config-feature
		Route::get('/pengaturan-fitur/{modul}','Admin\PengaturanFitur\ViewController@index');
		Route::post('/pengaturan-fitur/{modul}','Admin\PengaturanFitur\PostController@save');

		Route::get('/select2/farmasi/item-template','Farmasi\ItemTemplate\ReadController@select2Search');
		
		//hak akses
		Route::get('/hak-akses', 'Admin\HakAkses\ViewController@index');
		Route::get('/hak-akses/data', 'Admin\HakAkses\ReadController@hakAksesData');
		Route::post('/hak-akses/add', 'Admin\HakAkses\PostController@add');
		Route::get('/hak-akses/hapus/{user_id}', 'Admin\HakAkses\PostController@delete');

        Route::group(['prefix' => 'pendaftaran-online'], function () {
            Route::get('/tarif-kembali', 'Admin\PendaftaranOnline\TarifKembali\ViewController@index');
            Route::get('/tarif-kembali/hapus/{id}', 'Admin\PendaftaranOnline\TarifKembali\PostController@delete');
            Route::post('/tarif-kembali/add', 'Admin\PendaftaranOnline\TarifKembali\PostController@add');
        });

        Route::group(['prefix' => 'third-party'], function () {
            Route::group(['prefix' => 'sirs-v3', 'middleware' => ['sirs-v3-auth']], function () {
                Route::get('/pekerjaan', 'Admin\ThirdParty\SIRS\ViewController@pekerjaan');
                Route::post('/pekerjaan/save', 'Admin\ThirdParty\SIRS\PostController@savePekerjaan');
                Route::get('/status-keluar', 'Admin\ThirdParty\SIRS\ViewController@statusKeluar');
                Route::post('/status-keluar/save', 'Admin\ThirdParty\SIRS\PostController@saveStatusKeluar');
                Route::get('/sync-master-data', 'Admin\ThirdParty\SIRS\ViewController@syncMasterData');
                Route::post('/sync-master-data/sync', 'Admin\ThirdParty\SIRS\PostController@runSyncMasterData');
            });
        });

		#pengaturan fitur
		Route::get('/pengaturan-fitur/{modul}','Admin\PengaturanFitur\ViewController@index');
		Route::post('/pengaturan-fitur/{modul}','Admin\PengaturanFitur\PostController@save');
	});


});
?>