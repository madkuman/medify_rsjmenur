<?php

namespace App\Http\Controllers\Gizi\BahanMakananLog;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Gizi\BahanMakananLog;
use App\Models\Gizi\BahanMakanan;
use Auth;

class DeleteController extends Controller
{
    public function rollback($id,$flag)
    {	
    	if($flag == 1)
    	{
    		$log = BahanMakananLog::where('belanja_id',$id)->get();	
    	}
    	else
    	{
    		$log = BahanMakananLog::where('produksi_id',$id)->get();
    	}
    	foreach ($log as $item) 
    	{
    		$this->count($item,$flag);
    		$item->delete();
    	}
    }

    private function count($item,$flag)
    {
    	$bahan = BahanMakanan::where('id',$item->bahan_makanan_id)->first();
		if($flag == 1)
		{
			$bahan->stok = $bahan->stok - $item->jumlah;	
		}
		else
		{
			$bahan->stok = $bahan->stok + $item->jumlah;
		}
		$bahan->save();
    }
}
