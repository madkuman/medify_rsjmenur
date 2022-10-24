<?php

namespace App\Http\Controllers\Gizi\Seed;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Gizi\DietTambahan;
use App\Models\Gizi\JenisMakanan;
use App\Models\Gizi\KategoriMakanan;
use App\Models\Gizi\BentukMakanan;
use App\Models\Gizi\Diet;

class ViewController extends Controller
{
    public function addKode()
    {
    	$data['JenisMakanan'] = JenisMakanan::all();
    	//$data['DietTambahan'] = DietTambahan::all();
    	$data['Diet'] = Diet::all();
    	$data['BentukMakanan'] = BentukMakanan::all();
    	$data['KategoriMakanan'] = KategoriMakanan::all();
    	$status = 'belanja';

    	return view('gizi.seed.tambahkode',['data'=>$data,'status'=>$status]);

    }
}
