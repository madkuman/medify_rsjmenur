<?php

namespace App\Http\Controllers\LabPK\MikrobiologiSpesimenKategori;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\LabPK\MikrobiologiSpesimenKategori;

class ViewController extends Controller
{
    public function index()
	{	
		$data['data'] = MikrobiologiSpesimenKategori::all();
		$data['header'] = "pengaturan";
		return view('labpk.mikrobiologi-spesimen-kategori.index',$data);
	}

	public function create()
	{
		$data['header'] = "pengaturan";
		return view('labpk.mikrobiologi-spesimen-kategori.create',$data);
	}

	public function edit($id)
	{
		$data['data'] = MikrobiologiSpesimenKategori::where('id',$id)->first();
		$data['header'] = "pengaturan";
		return view('labpk.mikrobiologi-spesimen-kategori.edit',$data);
	}
}
