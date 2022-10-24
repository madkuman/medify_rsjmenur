<?php

namespace App\Http\Controllers\RekamMedis\Permintaan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    	public function baru(Request $request)
    	{
    		DB::connection('rekammedis')->beginTransaction();
			try{
	    		$data = $request->all();
	    		$transaksi = app('App\Http\Controllers\RekamMedis\Transaksi\CreateController')->create($data);
	    		$data['transaksi_id'] = $transaksi->id;
	    		$permintaan = app('App\Http\Controllers\RekamMedis\Permintaan\CreateController')->create($data);
	    		
		    	DB::connection('rekammedis')->commit();
	            return redirect('/rekammedis/permintaan'.$permintaan->id);

	        } catch (\Exception $e) {
	           
	            app('App\Http\Controllers\Error\Handler')->bugsnag($e);

	            DB::connection('rekammedis')->rollback();
	            
	        }
    	}
}
