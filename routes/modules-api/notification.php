<?php 
	Route::group(['prefix' => 'api/notification'], function(){
		Route::get('/fetch', 'Users\Notification\ReadController@fetch');
		Route::get('/mark_as_read/{id}', 'Users\Notification\EditController@mark_as_read');
		Route::get('/all', 'Users\Notification\ViewController@all');
	});
?>