<?php

namespace App\Http\Controllers\Admin\CaraPulang;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hospital\MasterCaraPulang;
use App\Models\Hospital\MasterCaraPulangINACBG;

class ViewController extends Controller
{
    public function index(Request $request)
	{
		$data['cara_pulang'] = MasterCaraPulang::get();
		return view('admin.cara-pulang.index', $data);
	}

	public function create()
	{
		$data['slugs'] = MasterCaraPulang::get();
		$data['inacbg'] = MasterCaraPulangINACBG::get();
		return view('admin.cara-pulang.create', $data);
	}

	public function edit($id)
	{
		$data['cara_pulang'] = MasterCaraPulang::find($id);
		$data['slugs'] = MasterCaraPulang::get();
		$data['inacbg'] = MasterCaraPulangINACBG::get();
		return view('admin.cara-pulang.edit', $data);
	}
}
