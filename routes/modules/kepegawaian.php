<?php
Route::group(['prefix' => 'api/kepegawaian'], function(){
    Route::get('/user-control/load-table', 'Kepegawaian\ReadController@loadTable');
    Route::get('/kuisioner/get/{id}', 'Kepegawaian\MasterKuisioner\ReadController@getKuisionerAjax');
    Route::get('/pertanyaan/get/{id}', 'Kepegawaian\MasterKuisioner\ReadController@getPertanyaanAjax');

    Route::get('/pangkat/get/{id}', 'Kepegawaian\MasterPangkat\ReadController@getPangkatAjax');

    // Pelatihan
    Route::get('/pelatihan/get/{id}', 'Kepegawaian\MasterPelatihan\ReadController@getDataAjax');
    // Gelar
    Route::get('/gelar-pendidikan/get/{id}', 'Kepegawaian\MasterGelarPendidikan\ReadController@getDataAjax');
    // Strata
    Route::get('/strata-pendidikan/get/{id}', 'Kepegawaian\MasterStrataPendidikan\ReadController@getDataAjax');
    // Jenis Pendidikan
    Route::get('/jenis-pendidikan/get/{id}', 'Kepegawaian\MasterJenisPendidikan\ReadController@getDataAjax');
    // Institusi Pendidikan
    Route::get('/institusi-pendidikan/get/{id}', 'Kepegawaian\MasterInstitusiPendidikan\ReadController@getDataAjax');
    // Penghargaan
    Route::get('/penghargaan/get/{id}', 'Kepegawaian\MasterPenghargaan\ReadController@getDataAjax');

    Route::group(['prefix'=>'master'], function(){
        //Kategori Pegawai
        Route::get('/kategori-pegawai/getDataTable', 'Kepegawaian\MasterKategoriPegawai\ReadController@getDataTable');
        Route::get('/kategori-pegawai/single', 'Kepegawaian\MasterKategoriPegawai\ReadController@single');
        //Masa Kerja
        Route::get('/masa-kerja/getDataTable', 'Kepegawaian\MasterMasaKerja\ReadController@getDataTable');
        Route::get('/masa-kerja/single', 'Kepegawaian\MasterMasaKerja\ReadController@single');

        //Golongan Pegawai
        Route::get('/golongan/getDataTable', 'Kepegawaian\MasterGolongan\ReadController@getDataTable');
        Route::get('/golongan/single', 'Kepegawaian\MasterGolongan\ReadController@single');
        //Tim Pembagi Jasa
        Route::get('/tim-pembagi-jasa/getDataTable', 'Kepegawaian\MasterTimPembagiJasa\ReadController@getDataTable');
        Route::get('/tim-pembagi-jasa/single', 'Kepegawaian\MasterTimPembagiJasa\ReadController@single');
    });
    Route::get('/{id}', 'Kepegawaian\ReadController@single');

});

Route::group(['prefix' => 'kepegawaian', 'namespace' => 'Kepegawaian'], function() {
    Route::group(['middleware' => 'check-module'], function(){
        Route::get('/', ['as' => 'employees', 'uses' => 'Dashboard\ViewController@index']);
        Route::get('/user-control', ['as' => 'user-control', 'uses' => 'ViewController@userControl']);
        Route::get('/user-control/{id}/edit', ['uses' => 'ViewController@edit']);

        Route::get('/hasil-kuisioner', ['as' => 'hasil-kuisioner', 'uses' => 'ViewController@hasilKuisioner']);
        Route::post('/hasil-kuisioner', ['as' => 'hasil-kuisioner', 'uses' => 'ViewController@hasilKuisioner']);
        Route::post('/print-kuisioner/belum', 'MasterKuisioner\PostController@printKuisionerBelum');

        Route::group(['prefix' => 'pegawai'], function() {
            Route::get('/', ['as' => 'pegawai', 'uses' => 'Dashboard\ViewController@index']);
            Route::get('/list', ['as' => 'pegawai-list', 'uses' => 'Dashboard\ViewController@initDataPegawai']);
            Route::get('/search', ['as' => 'pegawai-search', 'uses' => 'Dashboard\ViewController@search']);
            Route::get('/search/kecamatan', ['as' => 'list-kecamatan', 'uses' => 'Pegawai\ViewController@searchKecamatan']);
            Route::get('/search/kelurahan', ['as' => 'list-kelurahan', 'uses' => 'Pegawai\ViewController@searchKelurahan']);
            Route::get('/baru', ['as' => 'pegawai-baru', 'uses' => 'Pegawai\ViewController@baru']);
            Route::post('/baru', ['as' => 'pegawai-baru-post', 'uses' => 'Pegawai\PostController@baru']);
            Route::get('/edit/{id}', ['as' => 'pegawai-edit', 'uses' => 'Pegawai\ViewController@edit']);
            Route::post('/edit/{id}', ['as' => 'pegawai-edit-post', 'uses' => 'Pegawai\PostController@edit']);
            Route::delete('/delete/{id}', ['as' => 'pegawai-delete', 'uses' => 'Pegawai\PostController@delete']);
            Route::post('/import', ['as' => 'pegawai-import', 'uses' => 'Pegawai\PostController@import']);
            Route::get('/download-contoh-file', ['as' => 'download-contoh-file', 'uses' => 'Dashboard\ViewController@download']);
            Route::get('/export-data-pegawai', ['as' => 'export-file', 'uses' => 'Dashboard\ViewController@export']);
            // PROFILE
            Route::get('/profile/{id}', ['as' => 'profile', 'uses' => 'Pegawai\ViewController@profile']);
            Route::get('/profile/print/{id}', ['as' => 'profile-print', 'uses' => 'Pegawai\ViewController@printProfile']);


            // PELATIHAN
            Route::group(['prefix' => 'pelatihan'], function() {
                Route::get('/sertifikat/{id}', ['as' => 'file-master-pelatihan', 'uses' => 'MasterPelatihan\ReadController@getFileMaster']);
                Route::get('/{emp}/sertifikat/{id}', ['as' => 'file-pelatihan', 'uses' => 'MasterPelatihan\ReadController@getFile']);
                Route::get('/{id}', ['as' => 'trainings', 'uses' => 'Pegawai\ViewController@pelatihan']);
                Route::post('/{id}', 'MasterPelatihan\PostController@pegawaiAdd');
                Route::post('/{id}/verifikasi', 'MasterPelatihan\PostController@verification');
                Route::post('/{id}/edit', 'MasterPelatihan\PostController@pegawaiEdit');
                Route::get('/delete/{id}', 'MasterPelatihan\PostController@pegawaiDelete');
                Route::post('/{id}/get_data','MasterPelatihan\ReadController@getData');
            });

            // PENDIDIKAN
            Route::group(['prefix' => 'pendidikan'], function() {
                Route::get('/{emp}/sertifikat/{id}', ['as' => 'education-file', 'uses' => 'MasterPendidikan\ReadController@getFile']);

                // New
                Route::get('/{id}', ['as' => 'educations', 'uses' => 'Pegawai\ViewController@pendidikan']);
                Route::post('/{id}', 'MasterPendidikan\PostController@pegawaiSave');
                Route::post('/{id}/verifikasi', 'MasterPendidikan\PostController@pegawaiVerifikasi');
                Route::post('/{id}/edit', 'MasterPendidikan\PostController@pegawaiUpdate');
                Route::get('/delete/{id}', 'MasterPendidikan\PostController@pegawaiDelete');
            });

            // PANGKAT

            Route::group(['prefix' => 'pangkat'], function() {
                Route::get('/{id}', ['as' => 'positions', 'uses' => 'Pegawai\ViewController@pangkat']);
                Route::post('/{id}', 'MasterPangkat\PostController@pegawaiSave');
                Route::get('/delete/{id}', 'MasterPangkat\PostController@pegawaiDelete');
            });


            // JABATAN
            Route::group(['prefix' => 'jabatan'], function() {
                Route::get('/{id}', ['as' => 'departments', 'uses' => 'Pegawai\ViewController@jabatan']);
                Route::post('/{id}', 'MasterJabatan\PostController@pegawaiSave');
                Route::get('/delete/{id}', 'MasterJabatan\PostController@pegawaiDelete');
            });

            // PENGHARGAAN
            Route::group(['prefix' => 'penghargaan'], function() {
                Route::get('/{id}', ['as' => 'appretiations', 'uses' => 'Pegawai\ViewController@penghargaan']);

                Route::get('/sertifikat/{id}', ['as' => 'file-master-penghargaan', 'uses' => 'MasterPenghargaan\ReadController@getFileMaster']);
                Route::get('{emp}/sertifikat/{id}', ['as' => 'file-penghargaan', 'uses' => 'MasterPenghargaan\ReadController@getFile']);
                Route::post('/{id}', 'MasterPenghargaan\PostController@pegawaiSave');
                Route::post('{id}/verifikasi', 'MasterPenghargaan\PostController@pegawaiVerifikasi');
                Route::post('{id}/edit', 'MasterPenghargaan\PostController@pegawaiUpdate');
                Route::get('/delete/{id}', 'MasterPenghargaan\PostController@pegawaiDelete');
                Route::post('/{id}/get_data','MasterPenghargaan\ReadController@getData');
            });

            //SURAT PERINGATAN
            Route::group(['prefix' => 'surat-peringatan'], function() {
                Route::get('/{id}', ['as' => 'surat_peringatan', 'uses' => 'Pegawai\SuratPeringatan\ViewController@index']);
                Route::post('/add/{id}', ['as' => 'tambah-surat_peringatan', 'uses' => 'Pegawai\SuratPeringatan\PostController@tambah']);
                Route::post('/edit/{id}', ['as' => 'edit-surat_peringatan', 'uses' => 'Pegawai\SuratPeringatan\PostController@edit']);
                Route::get('/edit/{id}', ['as' => 'get-surat_peringatan', 'uses' => 'Pegawai\SuratPeringatan\ViewController@edit']);
                Route::delete('/delete/{id}', ['as' => 'delete-surat_peringatan', 'uses' => 'Pegawai\SuratPeringatan\PostController@delete']);
                Route::get('/download/{id}', ['as' => 'download-file', 'uses' => 'Pegawai\SuratPeringatan\ViewController@download']);
                Route::get('/print-pdf/{id}', ['as' => 'print-pdf', 'uses' => 'Pegawai\SuratPeringatan\ViewController@print']);
            });

            // KELUARGA
            Route::group(['prefix' => 'keluarga'], function() {
                Route::get('/{id}', ['as' => 'families', 'uses' => 'Pegawai\ViewController@keluarga']);
                Route::post('/{id}', ['as' => 'families', 'uses' => 'Pegawai\Keluarga\CreateController@create']);
                Route::post('/edit/{id}', ['as' => 'edit-family', 'uses' => 'Pegawai\Keluarga\EditController@update']);
                Route::post('/delete/{id}', ['as' => 'delete-family', 'uses' => 'Pegawai\Keluarga\DeleteController@delete']);
            });

            // Legalitas
            Route::group(['prefix' => 'legalitas'], function() {
                Route::get('/{id}', ['as' => 'legalitas', 'uses' => 'Pegawai\ViewController@legalitas']);
                Route::post('/create/{id}', ['as' => 'legalitas-create', 'uses' => 'Pegawai\Legalitas\CreateController@create']);

                Route::post('/delete/{id}', ['as' => 'delete-legalitas', 'uses' => 'Pegawai\Legalitas\DeleteController@delete']);

                Route::get('/{emp}/sip/{id}', ['as' => 'legalitas-file-sip', 'uses' => 'Pegawai\Legalitas\ReadController@getFile']);
                Route::get('/{emp}/str/{id}', ['as' => 'legalitas-file-str', 'uses' => 'Pegawai\Legalitas\ReadController@getFile']);
                Route::get('/{emp}/skk/{id}', ['as' => 'legalitas-file-skk', 'uses' => 'Pegawai\Legalitas\ReadController@getFile']);
                Route::get('/{emp}/kredensial/{id}', ['as' => 'legalitas-file-kredensial', 'uses' => 'Pegawai\Legalitas\ReadController@getFile']);
                Route::get('/{emp}/evkin/{id}', ['as' => 'legalitas-file-evkin', 'uses' => 'Pegawai\Legalitas\ReadController@getFile']);
            });
        });

        Route::group(['prefix' => 'cuti'], function() {
            Route::get('/', 'CutiPengajuan\ViewController@index');
            Route::get('/pengajuan', 'CutiPengajuan\ViewController@index');
            Route::get('/pengajuan/form/{id}', 'CutiPengajuan\ViewController@formSingle');
            Route::post('/pengajuan/form/{id}/response', 'CutiPengajuan\PostController@formResponse');


            Route::get('/kuota', 'CutiKuota\ViewController@index');
            Route::get('/kuota/{user_id}', 'CutiKuota\ViewController@single');
            Route::post('/kuota/{user_id}/form', 'CutiKuota\PostController@formSubmit');
            Route::post('/kuota/{user_id}/delete', 'CutiKuota\PostController@formDelete');
        });

        Route::group(['prefix' => 'master', 'namespace' => 'Master'], function(){
            Route::get('/', ['as' => 'master-kepegawaian', 'uses' => 'MasterController@index']);

            // Pelatihan
            Route::group(['prefix' => 'pelatihan'], function(){
                Route::get('/', ['as' => 'master-trainings', 'uses' => 'TrainingController@index']);
                Route::post('/add', ['as' => 'add-mtraining', 'uses' => 'TrainingController@store']);
                Route::post('/edit/{id}', ['as' => 'edit-mtraining', 'uses' => 'TrainingController@edit']);
                Route::post('/delete/{id}', ['as' => 'delete-mtraining', 'uses' => 'TrainingController@destroy']);
            });

            // Tanda Jasa / Penghargaan
            Route::group(['prefix' => 'tanda-jasa'], function(){
                Route::get('/', ['as' => 'master-appretiations', 'uses' => 'AppretiationController@index']);
                Route::post('/add', ['as' => 'add-mappretiation', 'uses' => 'AppretiationController@store']);
                Route::post('/edit/{id}', ['as' => 'edit-mappretiation', 'uses' => 'AppretiationController@edit']);
                Route::post('/delete/{id}', ['as' => 'delete-mappretiation', 'uses' => 'AppretiationController@destroy']);
            });
        });

        Route::group(['prefix' => 'master'], function() {
            Route::get('kepegawaian/get/satker','AjaxController@getSatker');
            Route::post('kepegawaian/get/nilai','Garjas\ReadController@garjasMiliter');
            Route::post('kepegawaian/get/nilaiPNS','Garjas\ReadController@garjasPNS');
            Route::post('kepegawaian/get/nilaiPostur','Garjas\ReadController@garjasMiliterPostur');
            Route::post('kepegawaian/get/nilaiRenang','Garjas\ReadController@garjasMiliterRenang');
            Route::group(['prefix' => 'kualifikasi'], function(){
                Route::get('/','MasterKualifikasi\ViewController@index');
                Route::get('/baru','MasterKualifikasi\ViewController@baru');
                Route::post('/baru','MasterKualifikasi\PostController@baru');
                Route::get('/edit/{id}','MasterKualifikasi\ViewController@edit');
                Route::put('/edit/{id}','MasterKualifikasi\PostController@edit');
                Route::delete('/delete/{id}','MasterKualifikasi\PostController@delete');
            });
            Route::group(['prefix' => 'intern'], function(){
                Route::get('/','MasterJabatanIntern\ViewController@index');
                Route::post('/baru','MasterJabatanIntern\PostController@baru');
                Route::get('/edit/{id}','MasterJabatanIntern\ViewController@edit');
                Route::put('/edit/{id}','MasterJabatanIntern\PostController@edit');
                Route::delete('/delete/{id}','MasterJabatanIntern\PostController@delete');
            });
            Route::group(['prefix' => 'pangkat'], function(){
                Route::get('/','MasterPangkat\ViewController@index');
                Route::post('/baru','MasterPangkat\PostController@baru');
                Route::post('/edit','MasterPangkat\PostController@edit');
                Route::post('/edit/{id}','MasterPangkat\PostController@edit');
                Route::get('/delete/{id}','MasterPangkat\PostController@delete');
            });
            Route::group(['prefix' => 'jabatan'], function(){
                Route::get('/','MasterJabatan\ViewController@index');
                Route::get('/pengaturan','MasterJabatan\ViewController@jabatan');
                Route::get('/pengaturan-jenis','MasterJabatan\ViewController@jenisJabatan');
                Route::post('/pengaturan','MasterJabatan\PostController@simpanJabatan');
                Route::post('/pengaturan-jenis','MasterJabatan\PostController@simpanJenisJabatan');
                Route::get('/pengaturan/delete/{id}','MasterJabatan\PostController@hapusJabatan');
                Route::get('/pengaturan-jenis/delete/{id}','MasterJabatan\PostController@hapusJenisJabatan');
            });
            Route::group(['prefix' => 'pelatihan'], function(){
                Route::get('/','MasterPelatihan\ViewController@index');
                Route::post('/baru','MasterPelatihan\PostController@baru');
                Route::post('/edit','MasterPelatihan\PostController@edit');
                Route::get('/delete/{id}','MasterPelatihan\PostController@delete');

            });
            // Pendidikan
            Route::group(['prefix' => 'pendidikan'], function(){

                Route::get('/','MasterPendidikan\ViewController@index');
                // Gelar Pendidikan
                Route::group(['prefix' => 'gelar-pendidikan'], function(){
                    Route::get('/','MasterPendidikan\ViewController@gelarPendidikan');
                    Route::post('/','MasterPendidikan\PostController@simpanGelar');
                    Route::get('/delete/{id}','MasterPendidikan\PostController@hapusGelar');
                });
                // Strata Pendidikan
                Route::group(['prefix' => 'strata-pendidikan'], function(){
                    Route::get('/','MasterStrataPendidikan\ViewController@index');
                    Route::post('/baru','MasterStrataPendidikan\PostController@baru');
                    Route::post('/edit','MasterStrataPendidikan\PostController@edit');
                    Route::get('/edit/{id}','MasterStrataPendidikan\ViewController@edit');
                    Route::put('/edit/{id}','MasterStrataPendidikan\PostController@edit');
                    Route::get('/delete/{id}','MasterStrataPendidikan\PostController@delete');
                });
                // Jenis Pendidikan
                Route::group(['prefix' => 'jenis-pendidikan'], function(){
                    Route::get('/','MasterJenisPendidikan\ViewController@index');
                    Route::post('/baru','MasterJenisPendidikan\PostController@baru');
                    Route::post('/edit','MasterJenisPendidikan\PostController@edit');
                    Route::get('/edit/{id}','MasterJenisPendidikan\ViewController@edit');
                    Route::put('/edit/{id}','MasterJenisPendidikan\PostController@edit');
                    Route::get('/delete/{id}','MasterJenisPendidikan\PostController@delete');
                });
                // Institusi Pendidikan
                Route::group(['prefix' => 'institusi-pendidikan'], function(){
                    Route::get('/','MasterInstitusiPendidikan\ViewController@index');
                    Route::post('/baru','MasterInstitusiPendidikan\PostController@baru');
                    Route::post('/edit','MasterInstitusiPendidikan\PostController@edit');
                    Route::get('/edit/{id}','MasterInstitusiPendidikan\ViewController@edit');
                    Route::put('/edit/{id}','MasterInstitusiPendidikan\PostController@edit');
                    Route::get('/delete/{id}','MasterInstitusiPendidikan\PostController@delete');
                });
            });
            // Gelar Pendidikan
            Route::group(['prefix' => 'gelar-pendidikan'], function(){
                Route::get('/','MasterGelarPendidikan\ViewController@index');
                Route::post('/baru','MasterGelarPendidikan\PostController@baru');
                Route::post('/edit','MasterGelarPendidikan\PostController@edit');
                Route::get('/edit/{id}','MasterGelarPendidikan\ViewController@edit');
                Route::put('/edit/{id}','MasterGelarPendidikan\PostController@edit');
                Route::get('/delete/{id}','MasterGelarPendidikan\PostController@delete');
            });
            // Strata Pendidikan
            Route::group(['prefix' => 'strata-pendidikan'], function(){
                Route::get('/','MasterStrataPendidikan\ViewController@index');
                Route::post('/baru','MasterStrataPendidikan\PostController@baru');
                Route::post('/edit','MasterStrataPendidikan\PostController@edit');
                Route::get('/edit/{id}','MasterStrataPendidikan\ViewController@edit');
                Route::put('/edit/{id}','MasterStrataPendidikan\PostController@edit');
                Route::get('/delete/{id}','MasterStrataPendidikan\PostController@delete');
            });
            // Jenis Pendidikan
            Route::group(['prefix' => 'jenis-pendidikan'], function(){
                Route::get('/','MasterJenisPendidikan\ViewController@index');
                Route::post('/baru','MasterJenisPendidikan\PostController@baru');
                Route::post('/edit','MasterJenisPendidikan\PostController@edit');
                Route::get('/edit/{id}','MasterJenisPendidikan\ViewController@edit');
                Route::put('/edit/{id}','MasterJenisPendidikan\PostController@edit');
                Route::get('/delete/{id}','MasterJenisPendidikan\PostController@delete');
            });
            // Institusi Pendidikan
            Route::group(['prefix' => 'institusi-pendidikan'], function(){
                Route::get('/','MasterInstitusiPendidikan\ViewController@index');
                Route::post('/baru','MasterInstitusiPendidikan\PostController@baru');
                Route::post('/edit','MasterInstitusiPendidikan\PostController@edit');
                Route::get('/edit/{id}','MasterInstitusiPendidikan\ViewController@edit');
                Route::put('/edit/{id}','MasterInstitusiPendidikan\PostController@edit');
                Route::get('/delete/{id}','MasterInstitusiPendidikan\PostController@delete');
            });
            // Master Penghargaan
            Route::group(['prefix' => 'penghargaan'], function(){
                Route::get('/','MasterPenghargaan\ViewController@index');
                Route::post('/baru','MasterPenghargaan\PostController@create');
                Route::post('/edit','MasterPenghargaan\PostController@edit');
                // Route::get('/edit/{id}','MasterPenghargaan\ViewController@edit');
                Route::put('/edit/{id}','MasterPenghargaan\PostController@edit');
                Route::get('/delete/{id}','MasterPenghargaan\PostController@delete');
            });
            // Master Departemen
            Route::group(['prefix' => 'departemen'], function(){
                Route::get('/','MasterDepartemen\ViewController@index');
                Route::post('/','MasterDepartemen\PostController@simpanDepartemen');
                Route::get('/delete/{id}','MasterDepartemen\PostController@hapusDepartemen');
            });
            Route::group(['prefix' => 'subkualifikasi'], function(){
                Route::get('/','MasterSubkualifikasi\ViewController@index');
                Route::get('/baru','MasterSubkualifikasi\ViewController@baru');
                Route::post('/baru','MasterSubkualifikasi\PostController@baru');
                Route::get('/edit/{id}','MasterSubkualifikasi\ViewController@edit');
                Route::put('/edit/{id}','MasterSubkualifikasi\PostController@edit');
                Route::delete('/delete/{id}','MasterSubkualifikasi\PostController@delete');
            });
            Route::group(['prefix' => 'jabatan-kasal'], function(){
                Route::get('/','MasterJabatanKasal\ViewController@index');
                Route::get('/baru','MasterJabatanKasal\ViewController@baru');
                Route::post('/baru','MasterJabatanKasal\PostController@baru');
                Route::get('/edit/{id}','MasterJabatanKasal\ViewController@edit');
                Route::post('/edit/{id}','MasterJabatanKasal\PostController@edit');
                Route::get('/delete/{id}','MasterJabatanKasal\PostController@delete');
            });
            Route::group(['prefix' => 'tanda-tangan'], function(){
                Route::get('/','MasterTandaTangan\ViewController@index');
                Route::get('/baru','MasterTandaTangan\ViewController@baru');
                Route::post('/baru','MasterTandaTangan\PostController@baru');
                Route::get('/edit/{id}','MasterTandaTangan\ViewController@edit');
                Route::post('/edit/{id}','MasterTandaTangan\PostController@edit');
                Route::get('/delete/{id}','MasterTandaTangan\PostController@delete');
                Route::get('/search-pegawai','AjaxController@searchPegawai');
            });
            Route::group(['prefix' => 'corporate-grade'], function(){
                Route::get('/','CorporateGrade\ViewController@index');
                Route::get('/level','CorporateGrade\ViewController@level');
                Route::get('/profesi','CorporateGrade\ViewController@profesi');
                Route::get('/profesi/baru','CorporateGrade\ViewController@profesiBaru');
                Route::get('/grade','CorporateGrade\ViewController@grade');
                Route::get('/grade/baru','CorporateGrade\ViewController@gradeBaru');
            });
            Route::group(['prefix' => 'kuisioner'], function(){
                Route::get('/','MasterKuisioner\ViewController@index');
                Route::post('/','MasterKuisioner\ViewController@index');
                Route::get('/baru','MasterKuisioner\ViewController@baru');
                Route::get('/update/dibalik','MasterKuisioner\ViewController@updateDibalik');
                Route::post('/baru','MasterKuisioner\PostController@baru');
                Route::post('/edit','MasterKuisioner\PostController@edit');
                Route::get('/{id_kuisioner}/pertanyaan','MasterKuisioner\ViewController@pertanyaan');
                Route::post('/{id_kuisioner}/pertanyaan/baru','MasterKuisioner\PostController@pertanyaanBaru');
                Route::post('/{id_kuisioner}/pertanyaan/edit','MasterKuisioner\PostController@pertanyaanEdit');
                Route::get('/{id_kuisioner}/hapus','MasterKuisioner\PostController@hapus');
                Route::get('/{id_kuisioner}/pertanyaan/{id_pertanyaan}/hapus','MasterKuisioner\PostController@pertanyaanHapus');
            });
            Route::group(['prefix' => 'jenis-kendaraan'], function () {
                Route::get('/', 'MasterJenisKendaraan\ViewController@index');
                Route::post('/baru', 'MasterJenisKendaraan\PostController@baru');
                Route::get('/edit/{id}','MasterJenisKendaraan\ViewController@edit');
                Route::put('/edit/{id}','MasterJenisKendaraan\PostController@edit');
                Route::delete('/delete/{id}','MasterJenisKendaraan\PostController@delete');
            });
            Route::group(['prefix' => 'status-rumah'], function () {
                Route::get('/', 'MasterStatusRumah\ViewController@index');
                Route::post('/baru', 'MasterStatusRumah\PostController@baru');
                Route::get('/edit/{id}','MasterStatusRumah\ViewController@edit');
                Route::put('/edit/{id}','MasterStatusRumah\PostController@edit');
                Route::delete('/delete/{id}','MasterStatusRumah\PostController@delete');
            });
            Route::group(['prefix' => 'nama-bank'], function () {
                Route::get('/', 'MasterNamaBank\ViewController@index');
                Route::post('/baru', 'MasterNamaBank\PostController@baru');
                Route::get('/edit/{id}','MasterNamaBank\ViewController@edit');
                Route::put('/edit/{id}','MasterNamaBank\PostController@edit');
                Route::delete('/delete/{id}','MasterNamaBank\PostController@delete');
            });
            Route::group(['prefix' => 'status-pegawai'], function () {
                Route::get('/', 'MasterStatusPegawai\ViewController@index');
                Route::post('/baru', 'MasterStatusPegawai\PostController@baru');
                Route::get('/edit/{id}','MasterStatusPegawai\ViewController@edit');
                Route::put('/edit/{id}','MasterStatusPegawai\PostController@edit');
                Route::delete('/delete/{id}','MasterStatusPegawai\PostController@delete');
            });
            Route::group(['prefix' => 'jenis-pegawai'], function () {
                Route::get('/', 'MasterJenisPegawai\ViewController@index');
                Route::post('/baru', 'MasterJenisPegawai\PostController@baru');
                Route::get('/edit/{id}','MasterJenisPegawai\ViewController@edit');
                Route::put('/edit/{id}','MasterJenisPegawai\PostController@edit');
                Route::delete('/delete/{id}','MasterJenisPegawai\PostController@delete');
            });
            Route::group(['prefix' => 'jenis-surat-peringatan'], function () {
                Route::get('/', 'MasterJenisSuratPeringatan\ViewController@index');
                Route::post('/baru', 'MasterJenisSuratPeringatan\PostController@baru');
                Route::get('/edit/{id}','MasterJenisSuratPeringatan\ViewController@edit');
                Route::put('/edit/{id}','MasterJenisSuratPeringatan\PostController@edit');
                Route::delete('/delete/{id}','MasterJenisSuratPeringatan\PostController@delete');
            });
            Route::group(['prefix' => 'faskes-asuransi'], function () {
                Route::get('/', 'MasterFaskesAsuransi\ViewController@index');
                Route::post('/baru', 'MasterFaskesAsuransi\PostController@baru');
                Route::get('/edit/{id}','MasterFaskesAsuransi\ViewController@edit');
                Route::put('/edit/{id}','MasterFaskesAsuransi\PostController@edit');
                Route::delete('/delete/{id}','MasterFaskesAsuransi\PostController@delete');
            });
            Route::group(['prefix' => 'kategori-pegawai'], function() {
                Route::get('/', 'MasterKategoriPegawai\ViewController@index');
                Route::post('/create', 'MasterKategoriPegawai\PostController@create');
                Route::post('/{id}/edit','MasterKategoriPegawai\PostController@edit');
                Route::post('/{id}/delete','MasterKategoriPegawai\PostController@delete');
            });

            Route::group(['prefix' => 'masa-kerja'], function() {
                Route::get('/', 'MasterMasaKerja\ViewController@index');
                Route::post('/create', 'MasterMasaKerja\PostController@create');
                Route::post('/{id}/edit','MasterMasaKerja\PostController@edit');
                Route::post('/{id}/delete','MasterMasaKerja\PostController@delete');
            });

            Route::group(['prefix' => 'golongan'], function() {
                Route::get('/', 'MasterGolongan\ViewController@index');
                Route::post('/create', 'MasterGolongan\PostController@create');
                Route::post('/{id}/edit','MasterGolongan\PostController@edit');
                Route::post('/{id}/delete','MasterGolongan\PostController@delete');
            });

            Route::group(['prefix' => 'beban-kerja'], function(){
                Route::get('/','MasterBebanKerja\ViewController@index');
                Route::post('/simpan','MasterBebanKerja\PostController@simpan');
                Route::get('/delete/{id}','MasterBebanKerja\PostController@hapus');
            });

            Route::group(['prefix' => 'resiko-kerja'], function(){
                Route::get('/','MasterResikoKerja\ViewController@index');
                Route::post('/simpan','MasterResikoKerja\PostController@simpan');
                Route::get('/delete/{id}','MasterResikoKerja\PostController@hapus');
            });

            Route::group(['prefix' => 'tim-pembagi-jasa'], function() {
                Route::get('/', 'MasterTimPembagiJasa\ViewController@index');
                Route::post('/create', 'MasterTimPembagiJasa\PostController@create');
                Route::post('/{id}/edit','MasterTimPembagiJasa\PostController@edit');
                Route::post('/{id}/delete','MasterTimPembagiJasa\PostController@delete');
            });

            Route::group(['prefix' => 'cuti'], function(){
                Route::get('/','MasterCuti\ViewController@index');
                Route::post('/','MasterCuti\PostController@submitForm');
                Route::get('/delete/{id}','MasterCuti\PostController@delete');
            });
            Route::group(['prefix' => 'export-import-pegawai'], function(){
                Route::get('/','Pegawai\ExportImport\ViewController@index');
                Route::get('/export',['as' => 'export-file', 'uses' => 'Pegawai\ExportImport\ExportController@export']);

                Route::post('/import','Pegawai\ExportImport\ImportController@import');
            });

            Route::group(['prefix' => 'general'], function(){
                Route::get('/','GeneralSettings\ViewController@index');
                Route::post('/','GeneralSettings\PostController@submitForm');
            });
        });

        Route::group(['prefix' => 'laporan'], function() {
            Route::get('/', ['as' => 'report', 'uses' => 'Pegawai\Laporan\ViewController@index']);
            // Route::get('/rekap-keluar-masuk', 'Laporan\RekapPersonelKeluarMasukController@index');
            // Route::get('/rekap-personel-intern', 'Laporan\RekapPersonelInternController@index');
            // Route::get('/daftar-jabfung','Laporan\DaftarJabfungController@index');
            // Route::get('/daftar-keluar-masuk','Laporan\LaporanKeluarMasukController@index');
            // Route::get('/daftar-nominatif','Laporan\LaporanNominatifController@index');
            // Route::get('/rekap-personel-usia','Laporan\RekapPersonelUsiaController@index');
            // Route::get('/penempatan-personel','Laporan\PenempatanPersonelController@index');
            // Route::get('/daftar-susunan-personel','Laporan\DaftarSusunanPersonelController@index');
            // Route::get('/daftar-personel-kualifikasi','Laporan\DaftarPersonelKualifikasiController@index');
            // Route::get('/rekap-personel-profesi','Laporan\RekapPersonelProfesiController@index');
            // Route::get('/laporan-pensiun','Laporan\LaporanPensiunController@index');
            // Route::get('/laporan-sipstr-expired','Laporan\LaporanSipstrExpiredController@index');
            // Route::get('/absensi','Laporan\AbsensiController@index');
            // Route::get('/surat-keterangan','Laporan\SuratKeteranganController@index');
            // Route::get('/surat-penunjukan','Laporan\SuratPenunjukanController@index');
            // Route::get('/garjas-pns','Laporan\GarjasPNSController@index');
            // Route::get('/garjas-militer','Laporan\GarjasMiliterController@index');
            Route::get('/laporan-legalitas','Pegawai\Laporan\ReadController@laporanLegalitas');
            Route::post('/daftar-keluar-masuk', 'Pegawai\Laporan\ReadController@laporanKeluarMasuk');
            Route::post('/profile-pegawai','Pegawai\Laporan\ReadController@laporanResumePegawai');
            Route::get('/get-pegawai', 'Pegawai\ReadController@getPegawai');
            /*
            Route::get('/pegawai', ['as' => 'profile-report', 'uses' => 'ReportsController@employeeReport']);
            Route::post('/nominatif', ['as' => 'nominative-report', 'uses' => 'ReportsController@nominativeReport']);
            Route::post('/kualifikasi', ['as' => 'qualification-report', 'uses' => 'ReportsController@qualificationReport']);
            Route::post('/keluar-masuk', ['as' => 'out-in-report', 'uses' => 'ReportsController@inOutReport']);*/
        });

        Route::group(['prefix' => 'statistika'], function() {
            Route::get('/', ['as' => 'statistika', 'uses' => 'Statistika\ViewController@index']);

            Route::get('/jenis-pegawai', 'Statistika\ReadController@ajaxIndexJenisPegawai');
            Route::get('/status-pegawai', 'Statistika\ReadController@ajaxIndexStatusPegawai');
            Route::get('/gender', 'Statistika\ReadController@ajaxIndexGender');
            Route::get('/umur', 'Statistika\ReadController@ajaxIndexUmur');
            Route::get('/pegawai-aktif', 'Statistika\ReadController@ajaxIndexPegawaiAktif');
            Route::get('/pegawai-keluar', 'Statistika\ReadController@ajaxIndexPegawaiKeluar');
        });

        // new AjaxMethod
        Route::get('/ajax', ['as' => 'ajax-get', 'uses' => 'AjaxController@index']);
        Route::post('/ajax', ['as' => 'ajax-post', 'uses' => 'AjaxController@index']);

        // AJAX
        Route::get('/get-military-education/{id}', ['as' => 'get-militaryeducation', 'uses' => 'AjaxController@getMilitaryEducation']);
        Route::get('/get-education/{id}', ['as' => 'get-education', 'uses' => 'AjaxController@getEducation']);
        Route::get('/get-training/{id}', ['as' => 'get-training', 'uses' => 'AjaxController@getTraining']);
        Route::get('/get-position/{id}', ['as' => 'get-position', 'uses' => 'AjaxController@getPosition']);
        Route::get('/get-positions/{id}', ['as' => 'get-positions', 'uses' => 'AjaxController@getPositions']);
        Route::get('/get-appretiation/{id}', ['as' => 'get-appretiation', 'uses' => 'AjaxController@getAppretiation']);
        Route::get('/get-family/{id}', ['as' => 'get-family', 'uses' => 'AjaxController@getFamily']);
        Route::get('/get-department/{id}', ['as' => 'get-department', 'uses' => 'AjaxController@getDepartment']);
        Route::get('/get-kasal/{id}', ['as' => 'get-kasal', 'uses' => 'AjaxController@getKasal']);
        Route::get('/get-intern/{id}', ['as' => 'get-intern', 'uses' => 'AjaxController@getIntern']);
        Route::get('/get-pns/{id}', ['as' => 'get-pns', 'uses' => 'AjaxController@getPns']);
        Route::get('/get-mtraining/{id}', ['as' => 'get-mtraining', 'uses' => 'AjaxController@getMtraining']);
        Route::get('/get-mappretiation/{id}', ['as' => 'get-mappretiation', 'uses' => 'AjaxController@getMappretiation']);
        Route::get('/get-mposition/{id}', ['as' => 'get-mposition', 'uses' => 'AjaxController@getMposition']);
        Route::get('/get-mdepartment/{id}', ['as' => 'get-mdepartment', 'uses' => 'AjaxController@getMdepartment']);
        Route::get('/get-meducation/{id}', ['as' => 'get-meducation', 'uses' => 'AjaxController@getMeducation']);
        Route::get('/get-image/training/{filename}', ['as' => 'get-training-image', 'uses' => 'AjaxController@getTrainingImage']);
        Route::get('/get-image/appretiation/{filename}', ['as' => 'get-appretiation-image', 'uses' => 'AjaxController@getappretiationImage']);
        Route::get('/get-image/education/{filename}', ['as' => 'get-education-image', 'uses' => 'AjaxController@getEducationImage']);
        Route::get('/get-image/military/{filename}', ['as' => 'get-military-image', 'uses' => 'AjaxController@getMilitaryImage']);
        Route::get('/get-image/photo-profile/{filename}', ['as' => 'get-photo-profile', 'uses' => 'AjaxController@getPhotoProfile']);

        Route::get('/import/master-pangkat', 'ImportController@masterPangkat');
        Route::get('/import/master-jabatan', 'ImportController@masterJabatan');
        Route::get('/import/master-jabatan-kasal', 'ImportController@masterJabatanKasal');
        Route::get('/import/master-kualifikasi', 'ImportController@masterKualifikasi');
        Route::get('/import/master-subkualifikasi', 'ImportController@masterSubkualifikasi');
        Route::get('/import/pegawai', 'ImportController@pegawai');
        Route::get('/import/marriage', 'ImportController@marriage');
        Route::get('/import/jabatan', 'ImportController@jabatan');
        Route::get('/import/family', 'ImportController@family');
        Route::get('/import/jasa', 'ImportController@jasa');
        Route::get('/import/dikmil', 'ImportController@dikmil');
        Route::get('/import/dikum', 'ImportController@dikum');
        Route::get('/import/dikum-update-text', 'ImportController@dikumUpdateText');
        Route::get('/import/pangkat', 'ImportController@pangkat');
        Route::get('/import/pel', 'ImportController@pel');
        //Route::get('/import/rewrite-off-status', 'ImportController@rewriteOffStatus');
        //Route::get('/import/rewrite-tmt-out', 'ImportController@rewriteTmtOut');
        Route::get('/import/update-text-pendidikan', 'ImportController@updateTextPendidikanUmumMiliter');
        Route::get('/import/update-agama', 'ImportController@updateAgama');

    });

});

Route::group(['prefix' => 'kuisioner'], function(){
    Route::get('/{slugkuisioner}', 'Kepegawaian\MasterKuisioner\ViewController@sampling');
    Route::post('/{slugkuisioner}/edit', 'Kepegawaian\MasterKuisioner\ViewController@samplingEdit');
    Route::post('/{slugkuisioner}/baru','Kepegawaian\MasterKuisioner\PostController@addJawaban');
});

Route::group(['prefix' => 'cuti'], function() {
    Route::get('/', 'Kepegawaian\CutiPengajuan\ViewController@indexUser');
    Route::get('/pengajuan', 'Kepegawaian\CutiPengajuan\ViewController@indexUser');
    Route::get('/pengajuan/form/new', 'Kepegawaian\CutiPengajuan\ViewController@formNew');
    Route::post('/pengajuan/form/new', 'Kepegawaian\CutiPengajuan\PostController@formSubmit');
    Route::get('/pengajuan/form/{id}', 'Kepegawaian\CutiPengajuan\ViewController@formSingleStaff');
    Route::get('/pengajuan/form/{id}/edit', 'Kepegawaian\CutiPengajuan\ViewController@formEdit');
    Route::post('/pengajuan/form/{id}/edit', 'Kepegawaian\CutiPengajuan\PostController@formSubmit');
    Route::post('/pengajuan/form/{id}/delete', 'Kepegawaian\CutiPengajuan\PostController@formDelete');
    Route::get('/kuota', 'Kepegawaian\CutiKuota\ViewController@indexUser');
});
Route::group(['prefix' => 'api/kepegawaian/cuti'], function() {
    Route::get('/get-sisa-cuti', 'Kepegawaian\CutiPengajuan\APIController@getSisaCuti');
    Route::get('/get-durasi-cuti', 'Kepegawaian\CutiPengajuan\APIController@getDurasiCuti');
    Route::get('/pengajuan/get-data', 'Kepegawaian\CutiPengajuan\APIController@getDataPengajuanCuti');

    Route::get('/kuota/get-mutasi', 'Kepegawaian\CutiKuota\APIController@getMutasi');
    Route::get('/kuota/get-my-kuota', 'Kepegawaian\CutiKuota\APIController@getMyKuota');
    Route::get('/kuota/get-data', 'Kepegawaian\CutiKuota\APIController@getDataKuota');

})

?>