<?php

namespace App\Http\Controllers\KamarOperasi\PeranTim;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\KamarOperasi\PeranTim;

class ViewController extends Controller
{
    	public function index()
    	{
    		$data['peran'] = PeranTim::all();
    		return view('kamaroperasi.peran-tim.index',$data);
    	}
}
