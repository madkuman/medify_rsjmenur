<?php

Route::prefix('vclaim-v2')->group(function () {
    
    Route::prefix('rujukan')->group(function () {
        Route::get('khusus/list/bulan/tahun', 'BPJS\RujukanKhusus\ViewController@listBulanTahun');
        Route::get('listsarana/ppkrujukan', 'BPJS\RujukanListSaranaPPK\ViewController@listSarana');
        Route::get('list-spesialistik/ppk-rujukan', 'BPJS\RujukanListSaranaPPK\ViewController@listSpesialistikPpkRujukan');
        
        Route::post('insert', 'BPJS\Rujukan\PostController@createRujukanV2');
        Route::post('update', 'BPJS\Rujukan\PostController@updateRujukanV2');
        Route::post('delete', 'BPJS\Rujukan\PostController@deleteRujukan');
        Route::post('khusus/insert', 'BPJS\RujukanKhusus\PostController@create');
        Route::post('khusus/delete', 'BPJS\RujukanKhusus\PostController@delete');
    });
    
    Route::prefix('sep')->group(function () {
        Route::get('internal/{nomor_sep}', 'BPJS\API\Sep\ReadController@getInternal');
        Route::get('internal/{nomor_sep}/delete/', 'BPJS\API\Sep\ReadController@getInternal');
        Route::get('kllinduk/list/{nomor_kartu_peserta}', 'BPJS\API\Sep\ReadController@dataIndukKecelakaan');
        
        Route::post('create', 'BPJS\SEP\PostController@create');

        Route::post('insert', 'ThirdParty\BPJS\Vclaim\SEP\CreateController@createSep2VersiAPI');
        
        Route::post('{no_sep}/edit', 'BPJS\SEP\PostController@edit');
        Route::put('update-tanggal-pulang', 'BPJS\SEP\PostController@putUpdateTanggalPulang');
        
        Route::post('{no_sep}/delete', 'BPJS\SEP\PostController@delete');
    });

});