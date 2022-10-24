<?php

namespace App\Http\Controllers\Gizi\Belanja;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Gizi\Belanja;
use App\Models\Gizi\BelanjaDetail;
use App\Models\Gizi\BahanMakanan;
use Auth;
use Carbon\Carbon;

class EditController extends Controller
{
    public function finalisasi($data)
    {
    	$belanja = Belanja::where('id',$data['id'])->first();
    	$belanja->total_belanja = $data['total_belanja'];
    	$belanja->confirmed_at = Carbon::now();
        $belanja->confirmed_by = Auth::user()->id;
		$belanja->save();

		//$detail = BelanjaDetail::where('belanja_id',$data['id'])->get();
        //dd($detail);
		$i = 0;
		foreach ($data['bahan_id'] as $item) 
		{
		 	$detail = BelanjaDetail::where('belanja_id',$data['id'])
                                    ->where('bahan_makanan_id',$item)->first();
            //dd($detail);
            $detail->jumlah_realisasi = $data['realisasi'][$i];
            $detail->total_satuan = $data['total_satuan'][$i];
            $detail->save();    
		 	$i++;
		}
		return $belanja;
    }

    public function updateStok($data)
    {   
    	$detail = BelanjaDetail::where('belanja_id',$data['id'])->get();
    	foreach ($detail as $item) 
    	{  
            if($item->detail_bahan->jenis_bahan_id == 1)
            {
                app('App\Http\Controllers\Gizi\BahanMakananLog\CreateController')
                ->create($item->bahan_makanan_id,$item->jumlah_realisasi,$data['id'],0);    
            }
            else
            {
                continue;
            }
    	}
    	return $detail;
    }
}
