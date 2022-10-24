<?php

namespace App\Http\Controllers\Admin\Lokasi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hospital\Lokasi;
use App\Models\Hospital\LokasiDepartemen;
use App\Models\Hospital\LokasiZonaPPI;
use App\Models\Keuangan\Kategori;

class ViewController extends Controller
{
    public function index()
    {	
    	$data = Lokasi::with('departemen','kategori_keuangan','zona_ppi_detail')->get();
    	return view('admin.lokasi.index',['data'=>$data]);
    }

    public function create()
    {
    	$data['lokasi_departemen'] = LokasiDepartemen::all();
    	$data['kategori_keuangan'] = Kategori::where('type',1)->get();
    	$data['zona_ppi'] = LokasiZonaPPI::all();
    	return view('admin.lokasi.create',$data);
    }

    public function edit($id)
    {
    	$data['data'] = Lokasi::where('id',$id)->first();
    	$data['lokasi_departemen'] = LokasiDepartemen::all();
    	$data['kategori_keuangan'] = Kategori::where('type',1)->get();
    	$data['zona_ppi'] = LokasiZonaPPI::all();
    	return view('admin.lokasi.create',$data);
    }
}
