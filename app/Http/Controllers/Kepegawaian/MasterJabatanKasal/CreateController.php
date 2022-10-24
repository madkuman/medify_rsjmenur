<?php

namespace App\Http\Controllers\Kepegawaian\MasterJabatanKasal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\MasterJabatanKasal;

class CreateController extends Controller
{
    	public function new($nama,$order=99)
    	{
    		$check = MasterJabatanKasal::where('nama',$nama)->get();
    		if(count($check) == 0)
    		{
    			$new = new MasterJabatanKasal;
    			$new->nama = $nama;
    			$new->order = $order;
    			$new->save();
    		}
    		return 1;
    	}
}
