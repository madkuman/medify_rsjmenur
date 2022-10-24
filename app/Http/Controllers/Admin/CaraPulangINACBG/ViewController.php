<?php

namespace App\Http\Controllers\Admin\CaraPulangINACBG;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hospital\MasterCaraPulangINACBG;

class ViewController extends Controller
{
    public function index(Request $request)
	{
		$data['cara_pulang'] = MasterCaraPulangINACBG::get();
		return view('admin.cara-pulang-inacbg.index', $data);
	}
}
