<?php

namespace App\Http\Controllers\RawatJalan\Histori;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RawatJalan\Poliklinik;

class ViewController extends Controller
{
    	public function index()
    	{
    		$data['poli'] = Poliklinik::all();
    		return view('rawatjalan.histori.index',$data);
    	}
}
