<?php

namespace App\Http\Controllers\BPJS\Monitoring\DataKlaim;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class ViewController extends Controller
{

	public function index()
	{
		$data['today'] = Carbon::now()->subMonth(2)->format('d-m-Y');
		return view('bpjs.monitoring.data-klaim.index',$data);
	}

	public function getData(Request $request)
	{
		$tanggal = Carbon::createFromFormat('d-m-Y', $request->tanggal)->format('Y-m-d');
		$pelayanan = $request->pelayanan;
		$status = $request->status;

		$data = app('App\Http\Controllers\BPJS\Monitoring\DataKlaim\ReadController')->getData($tanggal,$pelayanan,$status);
		
		$data = json_decode($data);

		$data_temp = $data->response->klaim ?? [];

		$klaim_data = $data_temp;

		return json_encode($klaim_data);
	}
}
