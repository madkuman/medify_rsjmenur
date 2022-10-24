<?php

namespace App\Http\Controllers\Admin\ObatTipe;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Farmasi\TipeObat;

class ViewController extends Controller
{
    	public function index(Request $request)
	{
		$data['tipe'] = TipeObat::get();
		$data['sidebar_active'] = "obat-tipe";
		return view('admin.obat-tipe.index',$data);
	}

	public function create()
	{
		$data['sidebar_active'] = "obat-tipe";
		return view('admin.obat-tipe.create',$data);
	}

	public function edit($id)
	{
		$data['tipe'] = TipeObat::find($id);
		$data['sidebar_active'] = "obat-tipe";
		return view('admin.obat-tipe.edit',$data);
	}
}
