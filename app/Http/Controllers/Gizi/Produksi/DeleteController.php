<?php

namespace App\Http\Controllers\Gizi\Produksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Gizi\Produksi;
use App\Models\Gizi\ProduksiDetail;
use App\Models\Gizi\ProduksiBahan;
use App\Models\Gizi\ProduksiMakanan;
use DB;

class DeleteController extends Controller
{
    public function delete($id,$flag)
    {
    	//dd($id,$flag);
    	DB::connection('gizi')->beginTransaction();

    	try 
    	{	
    		$del = Produksi::where('id',$id)->first();
       	 	app('App\Http\Controllers\Gizi\BahanMakananLog\DeleteController')->rollback($del->id,2);
       	 	$this->deleteRest($del->id,'bahan');
       	 	$this->deleteRest($del->id,'makanan');
       	 	$this->deleteRest($del->id,'detail');
	    	
	    	$del->delete();
	    	
			DB::connection('gizi')->commit();
			if($flag != 'edit')
			{
				return redirect('/gizi/produksi/')
                              ->with('message','Data berhasil dihapus')
                              ->with('status', 1)
                              ->with('title', 'Sukses');
			}
			else
			{
				return;
			}
    	} 
    	catch(\Exception $e)
        {
          	app('App\Http\Controllers\Error\Handler')->bugsnag($e);
          	DB::connection('gizi')->rollback();
        }
    }

    private function deleteRest($id,$flag)
    {
    	if($flag == 'bahan')
    	{
    		$del = ProduksiBahan::where('produksi_id',$id)->get();
    	}
    	else if($flag == 'makanan')
    	{
    		$del = ProduksiMakanan::where('produksi_id',$id)->get();	
    	}
    	else
    	{
    		$del = ProduksiDetail::where('produksi_id',$id)->get();
    	}
    	foreach ($del as $item) 
    	{
    		$item->delete();
    	}
    } 
}
