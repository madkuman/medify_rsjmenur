<?php
Route::group(['prefix' => 'api/third-party/sirs-covid-19'], function() {
	Route::get('rawatinap/get', 'ThirdParty\SIRSCovid19\RawatInap\ReadController@get');
});

?>