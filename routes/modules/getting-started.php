<?php

use App\Models\Hospital\Spesialisasi;

Route::group(['prefix' => 'getting-started'], function() {
	Route::get('/', 'GettingStarted\ViewController@profesi');
	Route::get('/profesi', 'GettingStarted\ViewController@profesi');
	Route::get('/profesi/spesialisasi/get/{input}', 'GettingStarted\ViewController@getSpesialisasi');
	Route::get('/grup', 'GettingStarted\ViewController@grup');
	Route::get('/grup/reclist/get', 'GettingStarted\ViewController@recList');
	Route::get('/avatar', 'GettingStarted\ViewController@avatar');
	Route::get('/hubungkan-kepegawaian', 'GettingStarted\ViewController@syncKepegawaian');
	Route::get('/email-resmi', 'GettingStarted\ViewController@emailOfficial');
	Route::get('/sip-str', 'GettingStarted\ViewController@noSIPSTR');
	Route::get('/integrasi-dpjp', 'GettingStarted\ViewController@DPJP');

	Route::post('/profesi', 'GettingStarted\PostController@profesi');
	Route::post('/grup', 'GettingStarted\PostController@grup');
	Route::post('/avatar', 'GettingStarted\PostController@avatar');
	Route::post('/hubungkan-kepegawaian', 'GettingStarted\PostController@syncKepegawaian');
	Route::post('/email-resmi', 'GettingStarted\PostController@emailOfficial');
	Route::post('/sip-str', 'GettingStarted\PostController@noSIPSTR');
	Route::post('/integrasi-dpjp', 'GettingStarted\PostController@DPJP');
});

Route::group(['prefix' => 'api/getting-started'], function() {
	Route::post('/bpjs/referensi/spesialis', 'BPJS\API\Referensi\ReadController@getSpesialis');
	Route::get('/bpjs/referensi/dpjp/{jp}/{spesialis}', 'BPJS\API\Referensi\ReadController@getDPJP');
});

?>