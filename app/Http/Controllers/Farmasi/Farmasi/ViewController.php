<?php

namespace App\Http\Controllers\Farmasi\Farmasi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Models\Farmasi\Farmasi;
use DOMPDF;
use DB;
use App\Models\Hospital\Lokasi;
use Bugsnag;

class ViewController extends Controller
{
	public function index(Request $request)
	{
		$pharmacy = app('App\Http\Controllers\Farmasi\Farmasi\ReadController')->getAll();
		$data['pharmacy'] = $pharmacy;
		$data['lokasi'] = Lokasi::all();
		// $data['sidebar_active'] = "laporan";
		return view('farmasi.farmasi.index', $data);
	}

	public function templateView($slug,$farmasi,$sidebar)
	{
		$data['lokasi'] = Lokasi::all();
		$data['farm'] = $slug;
		$data['farmasi'] = $farmasi;
		$data['farmer'] = $farmasi->nama;
		$data['sidebar_active'] = $sidebar;
		// dd($data);
		return $data;
	}
}