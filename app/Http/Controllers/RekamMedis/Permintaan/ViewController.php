<?php

namespace App\Http\Controllers\RekamMedis\Permintaan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RekamMedis\Permintaan;
use App\Models\RekamMedis\TransaksiTujuan;

class ViewController extends Controller
{

    	public function baru()
    	{
    		$data['tujuan'] = TransaksiTujuan::all();
    		return view('rekammedis.permintaan.baru',$data);
    	}
}
