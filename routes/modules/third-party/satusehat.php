<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'satusehat'], function () {
    Route::get('kfa/search', 'ThirdParty\SatuSehat\KFA\ReadController@search')->name('kfa.search');
});
