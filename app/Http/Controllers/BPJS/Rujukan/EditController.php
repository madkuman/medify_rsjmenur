<?php

namespace App\Http\Controllers\BPJS\Rujukan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\RujukLuar;

class EditController extends Controller
{
    public function edit(Request $request, $no_rujukan)
    {
    	// dd($request);
    	$rujuk_luar = RujukLuar::where('no_rujukan', $no_rujukan)->first();
    	$rujuk_luar->jenis_rujuk = $request->jenis_rujuk;
    	$rujuk_luar->tipe_rujuk = $request->tipe_rujuk;
    	$rujuk_luar->diagnosa = $request->diagnosis;
    	$rujuk_luar->ppk_faskes = json_decode($request->faskes)->kode;
    	$rujuk_luar->faskes = json_decode($request->faskes)->nama;
    	$rujuk_luar->poli_rujuk = json_decode($request->poli)->kode;
    	$rujuk_luar->nama_poli_rujukan = json_decode($request->poli)->nama;
    	$rujuk_luar->save();

    	return $rujuk_luar;
    }
}
