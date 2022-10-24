<?php

namespace App\Http\Controllers\KamarOperasi\Ruangan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Models\KamarOperasi\JenisSpesialisOperasi;

class ViewController extends Controller
{
	public function index()
	{
		$ruangan = app('App\Http\Controllers\KamarOperasi\Ruangan\ReadController')->getAll();
		$dokter = app('App\Http\Controllers\KamarOperasi\Transaksi\ReadController')->listDokter();
		$data['spesialis_operasi'] = JenisSpesialisOperasi::all();
		$data['ruangan'] = $ruangan;
		$data['dokters'] = $dokter;
		$data['routeFlag'] = 1;
		$data['today'] = Carbon::today()->format('d/m/Y');
		return view('kamaroperasi.ruangan.index',$data);
	}

	public function single($id)
	{
		$ruangan = app('App\Http\Controllers\KamarOperasi\Ruangan\ReadController')->getSingle($id);
		$transaksi = app('App\Http\Controllers\KamarOperasi\Transaksi\ReadController')->getList($id);

		$data['transaksi']=$transaksi;
		$data['ruangan'] = $ruangan;
		$data['routeFlag'] = 1;
	    //dd($data);
		return view('kamaroperasi.ruangan.single',$data);
	}
}
