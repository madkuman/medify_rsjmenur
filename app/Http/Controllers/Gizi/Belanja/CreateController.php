<?php

namespace App\Http\Controllers\Gizi\Belanja;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Gizi\Belanja;
use App\Models\Gizi\BelanjaDetail;
use Auth;

class CreateController extends Controller
{
    public function belanja($data)
    {
    	if(!empty($data['belanja_id']))
    	{
    		$belanja = Belanja::where('id',$data['belanja_id'])->first();
    		$detail = BelanjaDetail::where('belanja_id',$belanja_id)->get();
    		foreach ($detail as $item) 
    		{
    			$item->delete();
    		}
    	}
    	else
    	{
    		$belanja = new Belanja;	
    	}
    	$belanja->deskripsi = $data['deskripsi'];
    	$belanja->keterangan = $data['keterangan'];
    	$belanja->total_belanja = null;
    	$belanja->created_by = Auth::user()->id;
    	$belanja->save();
    	$i = 0;
    	foreach($data['bahan'] as $bahan)
    	{	
    		$this->detailbelanja($bahan,$belanja->id,$data['jumlah'][$i]);
    		$i++;
    	}

    	return $belanja;
    }

    public function detailbelanja($bahan,$belanja_id,$jumlah)
    {
    	$detail = new BelanjaDetail;
    	$detail->belanja_id = $belanja_id;
    	$detail->bahan_makanan_id = $bahan;
    	$detail->jumlah_estimasi = $jumlah;
    	$detail->created_by = Auth::user()->id;
    	$detail->save();
    }
}
