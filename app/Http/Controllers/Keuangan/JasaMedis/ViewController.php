<?php

namespace App\Http\Controllers\Keuangan\JasaMedis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Keuangan\JasaMedis;
use Carbon\Carbon;
use DB;

class ViewController extends Controller
{
	public function index()
	{
		$data['sidebar_active'] = "jasa-medis";
		$today = Carbon::today();
		$data['today'] = $today;
		return view('keuangan.jasamedis.index',$data);
	}
}
