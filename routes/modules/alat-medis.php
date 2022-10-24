<?php
Route::group(['middleware' => ['check-module']], function(){
    Route::group(['prefix' => 'alat-medis'], function () {
        Route::get('/views','AlatMedis\ViewController@views');
        Route::get('/viewsJson','AlatMedis\ViewController@viewsJson');

        Route::get('/items', 'AlatMedis\ViewController@index')->name('items.index');
        Route::get('/getJsonItemsTemplate', 'AlatMedis\ReadController@getJsonItemsTemplate')->name('alat_medis.json');
        Route::post('/itemstemplate/create', 'AlatMedis\PostController@createItemsTemplate')->name('alat_medis.create');
        Route::get('/items_template/{id}','AlatMedis\ViewController@itemstemplateSingle')->name('alat-medis.item.detail');
        Route::post('/itemstemplate/edit/{id}', 'AlatMedis\PostController@editItemsTemplate')->name('alat_medis.edit');
        Route::delete('/itemstemplate/delete/{id}', 'AlatMedis\PostController@deleteItemsTemplate')->name('alat_medis.destroy');

        Route::get('/getJsonItems/{id}', 'AlatMedis\ReadController@getJsonItems')->name('alat-medis.items.json');
        Route::post('/items/create/{id}', 'AlatMedis\PostController@createItems')->name('alat_medis.items.create');
        Route::get('/items/history/{id}', 'AlatMedis\ViewController@itemsHistory')->name('alat-medis.items.history');
        Route::get('/getJsonHistoryItems/{id}', 'AlatMedis\ReadController@getJsonHistoryItems')->name('alat-medis.items.history.json');

        Route::delete('/items/delete/{id}', 'AlatMedis\PostController@deleteItems')->name('alat-medis.items.delete');
    });
});
?>
