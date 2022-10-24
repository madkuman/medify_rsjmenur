<?php

namespace App\Http\Controllers\Admin\ObatAturan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Farmasi\AturanObat;

class ViewController extends Controller
{
    	public function index(Request $request)
	{
		$data['aturan'] = AturanObat::get();
		$data['sidebar_active'] = "obat-aturan";
		return view('admin.obat-aturan.index',$data);
	}

	public function create()
	{
		$data['sidebar_active'] = "obat-aturan";
		return view('admin.obat-aturan.create',$data);
	}

	public function edit($id)
	{
		$data['aturan'] = AturanObat::find($id);
		$data['sidebar_active'] = "obat-aturan";
		return view('admin.obat-aturan.edit',$data);
	}
}
