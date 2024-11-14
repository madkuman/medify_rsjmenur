<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'satusehat'], function () {
    Route::get('kfa/search', 'ThirdParty\SatuSehat\KFA\ReadController@search')->name('kfa.search');
    Route::post('kfa/update', 'ThirdParty\SatuSehat\KFA\EditController@updateItemTemplate')->name('kfa.update');
    Route::get('kfa/search/detail/{kode}', 'ThirdParty\SatuSehat\KFA\ReadController@getProductDetail')->name('kfa.search_detail');
});
