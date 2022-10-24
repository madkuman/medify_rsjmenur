<?php

namespace App\Http\Controllers\Group\Farmasi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Farmasi\Farmasi;
use DB;
use Bugsnag;

class CreateController extends Controller
{
    public function create($name, $slug, $id, $lokasi_id=null)
    {
    	ini_set('max_execution_time', 300);

    	try {
    		DB::connection('farmasi')->beginTransaction();

    		$pharmacy = new Farmasi;
			$pharmacy->nama = $name;
            $pharmacy->jenis = 3;
			$pharmacy->slug = $slug;
			$pharmacy->group_id = $id;
            $pharmacy->lokasi_id = $lokasi_id;
			$pharmacy->deskripsi = 'Untuk Grup '.$name;
			$pharmacy->save();

			DB::connection('farmasi')->commit();

    	} catch (Exception $e) {
    		DB::connection('farmasi')->rollback();
    		app('App\Http\Controllers\Error\Handler')->bugsnag($e);
    	}
    	
		app('App\Http\Controllers\Farmasi\Items\CreateController')->createStarter($pharmacy->id);
		
		return $pharmacy;
    }
}
