<?php

namespace App\Http\Controllers\Admin\TarifKategoriINACBG;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Keuangan\TarifKategoriINACBG;

class ViewController extends Controller
{
    public function index(Request $request)
	{
		$data['kategori'] = TarifKategoriINACBG::get();
		$data['sidebar_active'] = "tarif";
		return view('admin.tarif-kategori-inacbg.index', $data);
	}
}
