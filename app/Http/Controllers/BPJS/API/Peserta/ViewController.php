<?php

namespace App\Http\Controllers\BPJS\API\Peserta;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ViewController extends Controller
{
    public function syncPasien(Request $request)
    {
    	return view('bpjs.import.sync-peserta-pasien');
    }
}
