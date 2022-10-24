<?php

Route::group(['prefix' => 'nutrition'], function() {
	Route::get('/', 'Nutrition\Order\ViewController@show');
	Route::group(['prefix' => 'recipe'], function() {
		Route::get('/create', 'Nutrition\Recipe\CreateController@index');
		Route::post('/store', 'Nutrition\Recipe\CreateController@store');
		Route::get('/show', 'Nutrition\Recipe\ViewController@index');
		Route::get('/show_details/{id_recipe}', 'Nutrition\Recipe\ViewController@show_details');
		Route::get('/edit/{id_recipe}', 'Nutrition\Recipe\EditController@index');
		Route::post('/update/{id_recipe}', 'Nutrition\Recipe\EditController@update');
		Route::get('/delete/{id_class_recipe}', 'Nutrition\Recipe\DeleteController@index');
		Route::get('/print/{id_recipe}', 'Nutrition\Recipe\InvoiceController@index');

		Route::get('/reloadorder/{ket}', 'Nutrition\Recipe\ViewController@reloadorder');

		Route::get('/foodperday', 'Nutrition\Recipe\ViewController@foodperday');

		Route::get('/insert_to_class_recipe', 'Nutrition\Recipe\CreateController@insert_to_class_recipe');

		Route::get('/detail', 'Nutrition\Recipe\ViewController@showdetail');
	});

	Route::get('/pengaturan', 'Nutrition\Pengaturan\ViewController@show');

	Route::group(['prefix' => 'jadwal'], function() {
		Route::get('/create', 'Nutrition\Jadwal\ViewController@create');
		Route::get('/show', 'Nutrition\Jadwal\ViewController@show');
		Route::get('/show_menu/{id}', 'Nutrition\Jadwal\ViewController@show_menu');
		Route::get('/show_menu/{id}/tambah', 'Nutrition\Jadwal\ViewController@tambah_jenis_diet');
		Route::get('/show_menu/{id}/lihat', 'Nutrition\Jadwal\ViewController@lihat_menu_jenis_diet');
		
		Route::get('/show_menu/{id}/edit', 'Nutrition\Jadwal\ViewController@edit_menu');

		Route::post('/store', 'Nutrition\Jadwal\CreateController@store');
		Route::post('/{id}/tambah_jenis_diet', 'Nutrition\Jadwal\CreateController@tambah_jenis_diet');

		Route::post('/show_menu/{id}/update', 'Nutrition\Jadwal\EditController@update_menu');

		Route::get('/show_menu/{id_menu}/{id_menu_jenis_diet}/delete', 'Nutrition\Jadwal\DeleteController@delete_menu_jenis_diet');
		Route::get('/delete/{id}', 'Nutrition\Jadwal\DeleteController@delete_menu');
	});

	Route::group(['prefix' => 'ingredients'], function() {
		Route::get('/create', 'Nutrition\Ingredients\CreateController@index');
		Route::post('/store', 'Nutrition\Ingredients\CreateController@store');
		Route::get('/show', 'Nutrition\Ingredients\ViewController@index');
		route::get('/edit/{id_ingredients}', 'Nutrition\Ingredients\EditController@index');
		Route::post('/update/{id_ingredients}', 'Nutrition\Ingredients\EditController@update');
		Route::get('/delete/{id_ingredients}', 'Nutrition\Ingredients\DeleteController@index');
	});

	Route::group(['prefix' => 'order'], function() {
		Route::get('/create', 'Nutrition\Order\CreateController@index');
		Route::get('/getkasus/{pasien_id}', 'Nutrition\Order\CreateController@getkasus');
		Route::get('/getbangsal/{kelas_id}', 'Nutrition\Order\CreateController@getbangsal');
		Route::get('/getbangsalnew/{layanan}', 'Nutrition\Order\CreateController@getbangsalnew');
		Route::get('/getruangan/{bangsal_id}', 'Nutrition\Order\CreateController@getruangan');
		Route::get('/getruanganigd/', 'Nutrition\Order\CreateController@getruanganigd');
		Route::get('/getruanganrawatjalan/', 'Nutrition\Order\CreateController@getruanganrawatjalan');
		Route::get('/getbed/{ruangan_id}/', 'Nutrition\Order\CreateController@getbed');
		Route::get('/ajax_biasa/{id_diet}', 'Nutrition\Order\CreateController@ajax_biasa');
		Route::get('/reloadorder/{ket}', 'Nutrition\Order\ViewController@ReloadOrder');
		Route::get('/getordermenu/{ket}', 'Nutrition\Order\ViewController@getOrderMenu');
		Route::get('/energy_source/{id_diet_Selection}', 'Nutrition\Order\CreateController@energy_source');
		Route::get('/energy_source_detail/{id_diet_detail_energy_sources}', 'Nutrition\Order\CreateController@energy_source_detail');
		Route::get('/get_name/{id_diet_detail_energy_sources}', 'Nutrition\Order\CreateController@source_energy_name');
		Route::get('/show-data', 'Nutrition\Order\ViewController@show');
		// Route::get('/show-data', 'Nutrition\Order\ViewController@show_filter');
			//invoice
		Route::get('/invoice/{id_order}', 'Nutrition\Order\InvoiceController@invoice');
		Route::get('/invoice/pdf/{id_order}', 'Nutrition\Order\InvoiceController@downloadPDF');
		Route::get('/invoice/printlabel/{id_order}', 'Nutrition\Order\InvoiceController@print_label');
		Route::get('/invoice/print/label', 'Nutrition\Order\InvoiceController@print_all_label');

		Route::post('/store', 'Nutrition\Order\CreateController@store');
		Route::post('/store-new', 'Nutrition\Order\CreateController@store_new');
		Route::get('/show', 'Nutrition\Order\ViewController@index');
		Route::get('/show/detail/{id_order}', 'Nutrition\Order\ViewController@detail');
		Route::post('/show/detail/order/{id_order}', 'Nutrition\Order\EditController@order');
		Route::get('/show/now', 'Nutrition\Order\ViewController@pengantaran');
		Route::post('/show/pengantaran', 'Nutrition\Order\ViewController@now');
		Route::get('/delete/{id_order}', 'Nutrition\Order\DeleteController@index');

		Route::get('/mustbuy', 'Nutrition\Order\MustBuyController@index');
		Route::get('/mustbuy/{id_buy_list}', 'Nutrition\Order\MustBuyController@afterbuy');

			//recap
		Route::get('/show/recap', 'Nutrition\Order\ViewController@recap');
		Route::get('/show/recap/time', 'Nutrition\Order\ViewController@recapbytime');

			//data pasien
		Route::get('/patientdata/{name}', 'Nutrition\Order\CreateController@patient_data');

		Route::get('/ajaxfood/{a}', 'Nutrition\Order\ViewController@ajax_food');
		Route::get('/ajaxbangsal/{input_bangsal}', 'Nutrition\Order\ViewController@ajax_bangsal');
		Route::get('/ajaxruangan/{input_ruangan}', 'Nutrition\Order\ViewController@ajax_ruangan');
		Route::get('/searchajax',array('as'=>'searchajax','uses'=>'Nutrition\Order\ViewController@autocomplete'));
		Route::get('/cari', 'Nutrition\Order\ViewController@loaddata');

		//pengantaran
		Route::get('/reloadpengantaran/{ket}/{bangsal}/{ruangan}', 'Nutrition\Order\ViewController@reloadpengantaran');
		Route::get('/updatepengantaran/{id_order}/{status}', 'Nutrition\Order\ViewController@updatepengantaran');

		Route::get('/dummy', 'Nutrition\Order\CreateController@dummy');
		Route::get('/dummy-order/{tanggal_pertama}/{tanggal_kedua}', 'Nutrition\Order\CreateController@dummy_order');

	});

	Route::group(['prefix' => 'stock'], function() {
		Route::get('/show', 'Nutrition\Stock\ViewController@index');
		Route::get('/edit/{id_stock}', 'Nutrition\Stock\EditController@index');
		Route::post('/update/{id_stock}', 'Nutrition\Stock\EditController@update');
		Route::get('/recap', 'Nutrition\Stock\ViewController@recap');
	});

	Route::group(['prefix' => 'transaction'], function() {
		Route::get('/', 'Nutrition\Transaction\ViewController@index');
		Route::get('/create', 'Nutrition\Transaction\ViewController@create');
		Route::get('/histori', 'Nutrition\Transaction\ViewController@histori');
		Route::get('/konfirmasi-belanja/{id_buy_list}', 'Nutrition\Transaction\ViewController@konfirmasi_belanja');
		Route::post('/konfirmasi-belanja/{id_buy_list}/konfirmasi', 'Nutrition\Transaction\CreateController@konfirmasi');
		Route::get('/create/{id_buy_list}', 'Nutrition\Transaction\CreateController@index');
		Route::get('/add', 'Nutrition\Transaction\CreateController@new');
		Route::get('/add-tp', 'Nutrition\Transaction\CreateController@new_tp');
		Route::post('/store', 'Nutrition\Transaction\CreateController@store');
		// Route::get('/show', 'Nutrition\Transaction\ViewController@index');
		Route::get('/show/recap', 'Nutrition\Transaction\ViewController@recap');
		Route::get('/show/history/{date}', 'Nutrition\Transaction\ViewController@getRecapbyDate');
		Route::get('/edit/{id_transaction}', 'Nutrition\Transaction\EditController@index');
		Route::post('/update/{id_transaction}', 'Nutrition\Transaction\EditController@update');
		Route::get('/delete/{id_transaction}', 'Nutrition\Transaction\DeleteController@index');
	});

	Route::group(['prefix' => 'buy_list'], function() {
		Route::post('/create', 'Nutrition\Transaction\CreateController@add_buy_list');
		Route::post('/create/new', 'Nutrition\Transaction\CreateController@add_new_buy_list');
		Route::get('/detail/{id_buy_list}', 'Nutrition\Transaction\ViewController@detail_buylist');
	});

	Route::group(['prefix' => 'production'], function() {
		Route::get('/', 'Nutrition\Production\ViewController@index2');
		Route::get('/today', 'Nutrition\Production\CreateController@index');
		// Route::get('/create', 'Nutrition\Production\CreateController@create');
		Route::post('/create', 'Nutrition\Production\ViewController@create');
		Route::get('/create-wrp', 'Nutrition\Production\ViewController@creating'); //create yg baru
		Route::get('/preview/{id}', 'Nutrition\Production\ViewController@hasil_creating'); //halaman yg buat review setelah buat data baru
		Route::get('/preview/{id}/delete', 'Nutrition\Production\DeleteController@index');
		Route::post('/store', 'Nutrition\Production\CreateController@store');
		Route::get('/show', 'Nutrition\Production\ViewController@index');
		Route::get('/edit/{id_production}', 'Nutrition\Production\EditController@index');
		Route::post('/update/{id_production}', 'Nutrition\Production\EditController@update');
		Route::get('/delete/{id_production}', 'Nutrition\Production\DeleteController@index');

		Route::get('/ajax_production/{id_production}', 'Nutrition\Production\CreateController@ajax_production');

		Route::get('/ordertoday', 'Nutrition\Production\ViewController@ordertoday');
		Route::get('/showtoday', 'Nutrition\Production\ViewController@showtoday');
		Route::get('/show/detail/{id}', 'Nutrition\Production\ViewController@showdetail');

		Route::get('/invoicefood', 'Nutrition\Production\InvoiceController@invoicefood');
		Route::get('/invoiceingredients', 'Nutrition\Production\InvoiceController@invoiceingredients');
		Route::get('/print/{id_production}', 'Nutrition\Production\InvoiceController@printdetail');	
	});
});

?>