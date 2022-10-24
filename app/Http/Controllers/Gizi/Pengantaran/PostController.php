<?php

namespace App\Http\Controllers\Gizi\Pengantaran;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Auth;
use Carbon\Carbon;
use Bugsnag;
use App\Models\Gizi\PemesananDetail;

class PostController extends Controller
{
    public function post(Request $request,$id)
    {
    	DB::connection('gizi')->beginTransaction();
    	try
    	{	
    		$query = PemesananDetail::where('pemesanan_id',$id)
    				->where('waktu_makan_id',$request->get('waktu'))
    				->get();
            foreach ($query as $q) 
            {
                $q->delivered_at = Carbon::now();
                $q->delivered_by = Auth::user()->id;
                $q->save();
            }
		DB::connection('gizi')->commit();

    		return json_encode($query);
    	}
    	catch(\Exception $e)
        {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            DB::connection('gizi')->rollback();
        }
    }
}
