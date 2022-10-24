<?php

namespace App\Http\Controllers\Gizi\Belanja;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Models\Gizi\Belanja;
use App\Models\Gizi\BelanjaDetail;

class DeleteController extends Controller
{
    public function delete($id)
    {
    	DB::connection('gizi')->beginTransaction();

    	try 
    	{	
    		$del = Belanja::where('id',$id)->first();
        app('App\Http\Controllers\Gizi\BahanMakananLog\DeleteController')->rollback($del->id,1);

	    	$del_det = BelanjaDetail::where('belanja_id',$id)->get();

	    	foreach ($del_det as $item) 
	    	{
	    		$item->delete();
	    	}
	    	$del->delete();
	    	
			DB::connection('gizi')->commit();

         	return redirect('/gizi/belanja/')
                              ->with('message','Data berhasil dihapus')
                              ->with('status', 1)
                              ->with('title', 'Sukses');	
    	} 
    	catch(\Exception $e)
        {
          	app('App\Http\Controllers\Error\Handler')->bugsnag($e);
          	DB::connection('gizi')->rollback();
        }
    }

    public function edit($id)
    {
      //dd($id);
      $del = Belanja::where('id',$id)->first();
      //dd($del);

      $del_det = BelanjaDetail::where('belanja_id',$id)->get();

      foreach ($del_det as $item) 
      {
        $item->delete();
      }
      $del->delete();
    }
}
