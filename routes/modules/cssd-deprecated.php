<?php 



Route::group(['prefix' => 'cssd'], function() {
    
    Route::group(['prefix' => '/alat'], function() {
        Route::get('/','Cssd\Alat\ViewController@index');
        Route::get('/detail/{id}','Cssd\Alat\ViewController@detail');
        Route::get('/create','Cssd\Alat\CreateController@create');
        Route::get('/edit/{id}','Cssd\Alat\EditController@edit');
        Route::get('/delete/{id}','Cssd\Alat\DeleteController@delete');
        Route::post('/update','Cssd\Alat\EditController@update');
        Route::post('/satuan/store','Cssd\Alat\CreateController@storesatuan');
        Route::post('/store','Cssd\Alat\CreateController@store');
    });
    
    Route::group(['prefix' => '/permintaan'], function() {
        Route::get('/','Cssd\permintaan\ViewController@index');
        Route::get('/detail/{id}','Cssd\permintaan\ViewController@detail');
        Route::get('/rekap','Cssd\permintaan\ViewController@rekap');
        Route::post('/setuju','Cssd\permintaan\CreateController@setuju');
        Route::post('/tolak','Cssd\permintaan\CreateController@tolak');
        Route::get('/rekapalat/{pr_id}','Cssd\permintaan\ViewController@rekapalat');
        Route::get('/rekapsubmit/{pr_id}','Cssd\permintaan\ViewController@rekapsubmit');
        Route::get('/addPermintaan','Cssd\permintaan\ViewController@addPermintaan');
        Route::get('/addPermintaan/back','Cssd\permintaan\ViewController@index');
        Route::get('/rekap/{pr_id}','Cssd\permintaan\ViewController@hasilrekap');
        

    });
    
    Route::group(['prefix' => '/pengembalian'], function() {
        Route::get('/','Cssd\pengembalian\ViewController@index');
        Route::get('/detail/{id}','Cssd\pengembalian\ViewController@detail');
        Route::get('/setuju','Cssd\pengembalian\CreateController@setuju');
        Route::get('/rekap','Cssd\pengembalian\ViewController@rekap');
        Route::post('/setuju','Cssd\pengembalian\CreateController@setuju');
        Route::post('/tolak','Cssd\pengembalian\CreateController@tolak');
        Route::get('/rekap/hasilrekap','Cssd\pengembalian\ViewController@hasilrekap');
        Route::get('/rekapsubmit/{pr_id}','Cssd\pengembalian\ViewController@rekapsubmit');
        Route::get('/rekapalat/{pr_id}','Cssd\pengembalian\ViewController@rekapalat');
        Route::get('/addPengembalian','Cssd\pengembalian\ViewController@addPengembalian');
        Route::get('/addPengembalian/back','Cssd\pengembalian\ViewController@index');
        Route::get('/rekap/{pr_id}','Cssd\pengembalian\ViewController@hasilrekap');

        
        
        



        
    
    });
    Route::get('/dashboard','Cssd\dashboard\ViewController@index');


});


Route::group(['prefix' => 'api/cssd'], function() {
    Route::post('/AjaxAddPermintaan','Cssd\permintaan\CreateController@AjaxAddPermintaan'); 
    Route::post('/AjaxAddPengembalian','Cssd\pengembalian\CreateController@AjaxAddPengembalian'); 
    Route::get('/alat','Cssd\Alat\ReadController@get');    
    Route::get('/alat_search','Cssd\Alat\ReadController@alat_search');    
    Route::get('/alat/get','Cssd\Alat\ReadController@GetAlat');    
    Route::get('/permintaan/get','Cssd\permintaan\ReadController@GetPermintaan');    
    Route::get('/pengembalian/get','Cssd\pengembalian\ReadController@GetPengembalian');    
    Route::get('/PktPermintaan/get','Cssd\permintaan\ReadController@GetPaketAlat');    
    Route::get('/PktPengembalian/get','Cssd\pengembalian\ReadController@GetPaketAlat');    
    Route::post('/permintaan/add','Cssd\permintaan\CreateController@addpermintaan');    
    Route::post('/pengembalian/add','Cssd\pengembalian\CreateController@addpengembalian');    
    Route::get('/transaksipengembalian','Cssd\pengembalian\ReadController@get'); 
    Route::get('/permintaan/GetPaSubmit','Cssd\permintaan\ReadController@GetPaSubmit');    
    Route::get('/permintaan/GetPaketSubmit','Cssd\permintaan\ReadController@GetPaketSubmit');    
    Route::post('/permintaan/PostSubmit','Cssd\permintaan\CreateController@PostSubmit');    
    Route::post('/pengembalian/PostSubmit','Cssd\pengembalian\CreateController@PostSubmit');    

    Route::get('/ruangan/get','Cssd\permintaan\ReadController@GetRuangan');    
    Route::get('/ronde/get','Cssd\permintaan\ReadController@GetRonde'); 
    Route::get('/AjaxGetRuangan','Cssd\permintaan\ReadController@AjaxGetRuangan'); 
    Route::get('/AjaxGetRonde','Cssd\permintaan\ReadController@AjaxGetRonde'); 
    Route::get('/AjaxGetDiagnosis','Cssd\permintaan\ReadController@AjaxGetDiagnosis'); 
    Route::get('/AjaxGetDokter','Cssd\permintaan\ReadController@AjaxGetDokter'); 

    

    Route::get('/pengembalian/GetPaSubmit','Cssd\pengembalian\ReadController@GetPaSubmit');    
    Route::get('/pengembalian/GetPaketSubmit','Cssd\pengembalian\ReadController@GetPaketSubmit');

});

Route::get('/cssd/updatealat','Cssd\Alat\CreateController@updatepemakaian');
// tes
Route::get('/cssd/tespermintaan','Cssd\permintaan\ViewController@tespermintaan');
Route::get('/cssd/tespengembalian','Cssd\pengembalian\ViewController@tespengembalian');






?>