<?php

namespace App\Http\Controllers\LabPK\MikrobiologiSpesimen;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\LabPK\MikrobiologiSpesimen;
use App\Models\LabPK\MikrobiologiSpesimenKategori;

class ViewController extends Controller
{
    public function index()
	{	
		$data['data'] = MikrobiologiSpesimen::all();
		$data['header'] = "pengaturan";
		return view('labpk.mikrobiologi-spesimen.index',$data);
	}

	public function create()
	{
		$data['kategori'] = MikrobiologiSpesimenKategori::all();
		$data['header'] = "pengaturan";
		return view('labpk.mikrobiologi-spesimen.create',$data);
	}

	public function edit($id)
	{
		$data['kategori'] = MikrobiologiSpesimenKategori::all();
		$data['spesimen'] = MikrobiologiSpesimen::where('id',$id)->first();
		$data['header'] = "pengaturan";
		return view('labpk.mikrobiologi-spesimen.edit',$data);
	}
}
