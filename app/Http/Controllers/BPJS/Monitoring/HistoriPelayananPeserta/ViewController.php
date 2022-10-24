<?php

namespace App\Http\Controllers\BPJS\Monitoring\HistoriPelayananPeserta;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class ViewController extends Controller
{
	public function index()
	{
		$data['date_start'] = Carbon::now()->subMonth()->startOfMonth()->format('d-m-Y');
		$data['date_end'] = Carbon::now()->format('d-m-Y');
		return view('bpjs.monitoring.histori-pelayanan-peserta.index',$data);
	}

	public function getData(Request $request)
	{
		$tanggal_start = Carbon::createFromFormat('d-m-Y', $request->tanggal_start)->format('Y-m-d');
		$tanggal_end = Carbon::createFromFormat('d-m-Y', $request->tanggal_end)->format('Y-m-d');
		$no_bpjs = $request->no_bpjs;
		
		$data = app('App\Http\Controllers\BPJS\Monitoring\HistoriPelayananPeserta\ReadController')->getData($no_bpjs,$tanggal_start,$tanggal_end);

		$data = json_decode($data);

		$data_temp = $data->response->histori ?? [];

		$data_new = $data_temp;

		return json_encode($data_new);
	}
}
