<?php

namespace App\Http\Controllers\Admin\FormBuilder;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Schema\Blueprint;
use DB;
use Schema;

class PostController extends Controller
{
	public function create(Request $request)
	{
        try {
			$connection = $request->connection;
			$data['connection'] = $connection;
			$data['folder_model'] =$request->folder_model;
			$data['folder_view'] = $request->folder_view;
			$data['base_route'] = $request->base_route;
			$data['folder_controller'] = $request->folder_controller;
			$data['route_file'] = $request->route_file;

			$data = (object)$data;
			$drop_if_exist = $request->drop_if_exist;

			$snake_cased_judul = str_replace(" ", "_", strtolower($request->judul));

			if(isset($connection)){
				if($drop_if_exist){
					Schema::connection($connection)->dropIfExists($snake_cased_judul);
				}
				if(Schema::connection($connection)->hasTable($snake_cased_judul)){
					return json_encode(['text' =>  "tabel ".$snake_cased_judul." sudah ada di koneksi ".$connection,
			            'title' => "Table already exist",
			            'type' =>  'error',
			        	'url' => 0
			        ]);
				}
				Schema::connection($connection)->create($snake_cased_judul, function(Blueprint $table) use($request)
				{
			        $table->increments('id');
		        	app('App\Http\Controllers\Admin\FormBuilder\HelperDB')->insertColumn($table, $request->input);
		        	$table->integer('kasus_id');
		        	$table->integer('created_by')->unsigned();
		        	$table->integer('updated_by')->unsigned();
		        	$table->integer('deleted_by')->unsigned();
		    		$table->softDeletes();
			        $table->timestamps();
			    });
			}
			if(isset($connection) && isset($data->folder_model)){
	            app('App\Http\Controllers\Admin\FormBuilder\HelperModel')->writeModel($data, $snake_cased_judul);
	        }
			if(isset($data->base_route) && isset($data->route_file) && isset($data->folder_controller)){
	            app('App\Http\Controllers\Admin\FormBuilder\HelperRoute')->writeRoute($data, $request->judul);
	        }
			if(isset($connection) && isset($data->folder_model) && isset($data->folder_controller) && isset($data->folder_view)){
	            app('App\Http\Controllers\Admin\FormBuilder\HelperController')->writeController($data, $request->judul, $request->input);
	        }
			if(isset($data->folder_view)){
	            app('App\Http\Controllers\Admin\FormBuilder\HelperView')->writeView($data, $request);
	        }

			return json_encode(['text' =>  "Berhasil!",
	            'title' => "Berhasil",
	            'type' =>  'success',
	        	'url' => 0
	        ]);

        } catch (\Exception $e) {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            return json_encode(['text' =>  "GAGAL! CEK BUGSNAG",
	            'title' => "GAGAL HE!",
	            'type' =>  'error',
	        	'url' => 0
	        ]);
        }
	}
}
