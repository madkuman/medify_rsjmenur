<?php

namespace App\Http\Controllers\Kasus\PenunjangPermintaan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Kasus\PenunjangPermintaan\CreateController;
use App\Models\Kasus\Kasus;
use DB;
use Bugsnag;

class PostController extends Controller
{

	protected $createController;

	public function __construct(CreateController $createController)
	{
		$this->createController = $createController;
	}

	public function create(Request $request, $nomor_kasus)
	{
        DB::connection('kasus')->beginTransaction();
        DB::connection('mysql')->beginTransaction();
        try
        {
    		$departemen = $request->input('departemen');
    		$kasus_id = $request->input('kasus_id');
    		$services = $request->input('services');
    		$jam_sampling = $request->input('jam_sampling');

    		$kasus = Kasus::find($kasus_id);

    		if($departemen == 'radiologi')
    			$this->createController->radiologi($kasus,$services);
    		else if($departemen == 'lab_pk')
    			$this->createController->labpk($kasus,$services,$jam_sampling);

    		$status = 1;
        	$message = 'Permintaan penunjang berhasil dilakukan';
        	$title = 'Berhasil!';
	
            DB::connection('kasus')->commit();
            DB::connection('mysql')->commit();
            return back()
            ->with('message', $message)
            ->with('title',$title)
            ->with('status', $status);

        } catch (\Exception $e) {
           
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);

            DB::connection('kasus')->rollback();
            DB::connection('mysql')->rollback();
            
        }
	}
}
