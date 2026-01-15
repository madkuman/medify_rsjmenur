<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'whatsapp'], function () {
    Route::get('post', 'ThirdParty\Whatsapp\PostController@send')->name('whatsapp');
});
