<?php

namespace App\Http\Controllers\Gizi\BahanMakananLog;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Gizi\BahanMakananLog;
use App\Models\Gizi\BahanMakanan;
use Auth;

class CreateController extends Controller
{
	public function create($bahan_makanan_id,$number,$belanja_id,$produksi_id)
	{	
		//dd($bahan_makanan_id,$number,$belanja_id,$produksi_id);
		$log = new BahanMakananLog;
		$log->bahan_makanan_id = $bahan_makanan_id;
		if($belanja_id != 0)
		{
			$log->jenis = 1;
			$log->belanja_id = $belanja_id;
			$log->produksi_id = 0;
			$this->count($bahan_makanan_id,$number,1);
		}
		else
		{
			$log->jenis = 2;
			$log->produksi_id = $produksi_id;
			$log->belanja_id = 0;
			$this->count($bahan_makanan_id,$number,2);
		}
		$log->jumlah = $number;
		$log->created_by = Auth::user()->id;
		$log->save();

		
	}

	private function count($bahan_makanan_id,$number,$flag)
	{
		$bahan = BahanMakanan::where('id',$bahan_makanan_id)->first();
		if($flag == 1)
		{
			$bahan->stok = $bahan->stok + $number;	
		}
		else
		{
			$bahan->stok = $bahan->stok - $number;
		}
		$bahan->save();
	}
}

