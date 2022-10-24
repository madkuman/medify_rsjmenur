<?php 
	Route::group(['prefix' => 'notification'], function(){
		Route::get('/mark_as_read/{id}', 'Users\Notification\EditController@mark_as_read');
		Route::get('/mark_all_as_read', 'Users\Notification\EditController@mark_all_as_read');
		Route::get('/all', 'Users\Notification\ViewController@all');
	});

	Route::group(['prefix' => 'api/notification'], function(){
		Route::get('/fetch', 'Users\Notification\ReadController@fetch');
		Route::get('/count_unread', 'Users\Notification\ReadController@count_displayed');
		Route::get('/update_displayed', 'Users\Notification\EditController@mark_as_displayed');
	});
?>