<?php

namespace App\Http\Controllers\Admin\TarifTipe;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Keuangan\TarifTipe;

class ViewController extends Controller
{
    	public function index(Request $request)
	{
		$data['tipe'] = TarifTipe::get();
		$data['sidebar_active'] = "tarif";
		return view('admin.tarif-tipe.index',$data);
	}

	public function create()
	{
		$data['sidebar_active'] = "tarif";
		return view('admin.tarif-tipe.create',$data);
	}

	public function edit($id)
	{
		$data['tipe'] = TarifTipe::find($id);
		$data['sidebar_active'] = "tarif";
		return view('admin.tarif-tipe.edit',$data);
	}
}
