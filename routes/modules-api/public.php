<?php
Route::post('/api/rawatjalan/video/puboff','RawatJalan\Video\PostController@puboff');
Route::get('/api/rawatjalan/video/waiting/{id}','RawatJalan\Video\ReadController@waitNotif');
?>