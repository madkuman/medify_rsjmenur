<?php	

	Route::group(['middleware' => ['group-check-role']], function(){
		Route::group(['prefix' => '/group/{slug}'], function(){
			Route::get('/members', ['uses' => 'Group\Members\ViewController@members', 'as' => 'group.members']);
			Route::get('/settings', ['uses' => 'Group\Settings\ViewController@settings', 'as' => 'group.settings']);
			Route::get('/discussions', ['uses' => 'Group\Discussions\ViewController@discussions', 'as' => 'group.discussions']);
			Route::post('/members', 'Group\Members\EditController@join');
			Route::post('/members/admin', 'Group\Members\EditController@admin');
			Route::post('/members/delete', 'Group\Members\DeleteController@remove');
            Route::post('/members/admin-kontrol-esakip', 'Group\Members\EditController@adminKontrolEsakip');
			Route::post('/settings', 'Group\Settings\EditController@edit');
			Route::post('/discussions', 'Group\Discussions\CreateController@create');
			Route::post('/discussions/edit', 'Group\Discussions\EditController@editPost');
			Route::post('/discussions/delete', 'Group\Discussions\DeleteController@deletePost');

			Route::get('/rekam-medis', 'Group\RekamMedis\ViewController@index');
			Route::get('/farmasi', 'Group\Farmasi\ViewController@index');
			Route::get('/laundry', 'Group\Laundry\ViewController@index');

			Route::get('/settings/delete-group/{id}','Group\Settings\DeleteController@delete');
		});
		Route::group(['prefix' => 'api/group/{slug}'], function(){
			Route::get('/invite/user/search/', 'Group\Members\ReadController@search');
			Route::post('/invite/create/', 'Group\Members\CreateController@create');
			Route::post('/member/accept/', 'Group\Members\EditController@accept');
			Route::delete('/member/decline/', 'Group\Members\DeleteController@decline');
            Route::post('/member/show/', 'Group\Members\EditController@show');
		});
	});
	Route::group(['prefix' => 'api/group'], function(){
		Route::post('/invite/accept', 'Group\Members\EditController@join');
		Route::post('/invite/decline', 'Group\Members\DeleteController@remove');
		Route::get('/search', 'Group\Group\ReadController@search');
	});
?>