<?php

namespace App\Http\Controllers\Gizi\Seed;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Models\Gizi\DietKode;

class PostController extends Controller
{
    public function create(Request $request)
    {
    	$kode = new DietKode;
    	$kode->bentuk_makanan_id = $request->BentukMakanan;
    	$kode->kategori_makanan_id = $request->KategoriMakanan;
    	$kode->jenis_makanan_id	= $request->JenisMakanan;
    	$kode->diet_id = $request->Diet;
    	$kode->nama = $request->KodeDiet;
    	$kode->save();

    	return back();
    }
}
