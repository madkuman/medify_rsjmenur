<?php
//video pasien routes
Route::get('/rawatjalan/videopub/{id}','RawatJalan\Video\ViewController@pub');
Route::get('/rawatjalan/videowaiting/{id}','RawatJalan\Video\ViewController@waiting');
Route::get('/rawatjalan/videopenunjang/{id}','RawatJalan\Video\ViewController@penunjang');
Route::post('/rawatjalan/video/penunjang/','RawatJalan\Video\PostController@penunjang');
?>