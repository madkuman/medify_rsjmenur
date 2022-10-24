<?php

namespace App\Http\Controllers\IGD\Ruangan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\IGD\Ruangan;
use DB;
use Bugsnag;

class CreateController extends Controller
{
    public function create(Request $request)
    {
        DB::connection('igd')->beginTransaction();
        try
        {
        	$ruangan = new Ruangan();
        	$ruangan->name = $request->input('name');
        	$ruangan->kapasitas = $request->input('kapasitas');
        	$ruangan->level = $request->input('level');
        	$ruangan->save();

    		$status = 1;
			$message = 'Ruangan berhasil ditambahkan.';
			$title = 'Berhasil!';
    		
        	DB::connection('igd')->commit();
            return redirect('igd/ruangan')->with('message', $message)
                ->with('title',$title)
                ->with('status', $status);

        } catch (\Exception $e) {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            DB::connection('igd')->rollback();
            
        }
    }
}
