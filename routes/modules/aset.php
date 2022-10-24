<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/api/find/{query}', 'Aset\APIController@findCategory')->name('find.category');
Route::get('/api/aset/item/get', 'Aset\APIController@getItems');

Route::group(['middleware' => ['check-module']], function(){
    Route::group(['prefix' => 'aset'], function () {
        Route::get('/', 'Aset\HomeController@index')->name('admin');
        Route::get('/home', 'Aset\HomeController@index')->name('admin.home');
        Route::resource('category', 'Aset\CategoriesController');
        Route::get('/getJsonCategory', 'Aset\CategoriesController@getJsonCategory')->name('admin.category.json');
        Route::resource('supplier', 'Aset\SuppliersController');
        Route::get('/getJsonSupplier', 'Aset\SuppliersController@getJsonSupplier')->name('admin.supplier.json');
        Route::get('/getJsonSupplierHistory/{id}', 'Aset\SuppliersController@getJsonSupplierHistory')->name('admin.supplier.history.json');
        Route::resource('items_template', 'Aset\ItemsTemplateController');
        Route::get('/getJsonItemsTemplate', 'Aset\ItemsTemplateController@getJsonItemsTemplate')->name('admin.items_template.json');
        Route::get('/getJsonItems/{id}', 'Aset\ItemsTemplateController@getJsonItems')->name('admin.items.json');
        Route::resource('transaction', 'Aset\TransactionController');
        Route::get('/getJsonTransaction', 'Aset\TransactionController@getJsonTransaction')->name('admin.transaction.json');
        Route::get('/transaction_add/items', 'Aset\TransactionController@addItems')->name('admin.transaction.add.items');
        
        Route::get('/transactionPrint/{kode}', 'Aset\TransactionController@transactionPrint')->name('admin.transaction.print');

        Route::post('/items/create/{id}', 'Aset\ItemsTemplateController@itemsCreate')->name('admin.items.create');
        Route::post('/items/update/{id}', 'Aset\ItemsTemplateController@itemsUpdate')->name('admin.items.update');
        Route::post('/items/delete/{id}', 'Aset\ItemsTemplateController@itemsDelete')->name('admin.items.delete');
        Route::get('/items/history/{id}', 'Aset\ItemsTemplateController@itemsHistory')->name('admin.items.history');
        Route::get('/getJsonHistoryItems/{id}', 'Aset\ItemsTemplateController@getJsonHistoryItems')->name('admin.items.history.json');

        Route::get('/items/transaction/{id_transaction}', 'Aset\ItemsTemplateController@itemsTransaction')->name('admin.items.transaction');

        Route::get('/laporan', 'Aset\LaporanController@index')->name('admin.laporan');
        Route::get('/transaction_add/items-po/{id}', 'Aset\TransactionController@addItemsPO')->name('admin.transaction.add.items-po');
    });
});
