<?php

namespace App\Http\Controllers\CSSD\AlkesSatuan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CSSD\AlkesSatuan;

class ReadController extends Controller
{
    	public function cekPengiriman($slug)
    	{
    		$satuan = AlkesSatuan::where('slug',$slug)->with('alkes')->first();
    		if(!empty($satuan->id))
    			return json_encode($satuan);
    		else
    			return 0;
    	}
}
