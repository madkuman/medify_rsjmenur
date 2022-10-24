<?php

namespace App\Http\Controllers\Admin\ObatMaster;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Gudang\ItemsTemplate as MasterObat;
use App\Models\Farmasi\TipeObat;

class ViewController extends Controller
{
	public function index(Request $request)
	{
		$data['obat'] = MasterObat::get();
		$data['sidebar_active'] = "obat-master";
		return view('admin.obat-master.index', $data);
	}

	public function create()
	{
		$data['tipe'] = TipeObat::get();
		$data['sidebar_active'] = "obat-master";
		return view('admin.obat-master.create', $data);
	}

	public function edit($id)
	{
		$data['obat'] = MasterObat::find($id);
		$data['tipe'] = TipeObat::get();
		$data['sidebar_active'] = "obat-master";
		return view('admin.obat-master.edit', $data);
	}
}
