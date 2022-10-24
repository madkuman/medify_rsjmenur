<?php

namespace App\Http\Controllers\BPJS\Monitoring\Kunjungan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Models\RawatJalan\PoliklinikBpjs;

class ViewController extends Controller
{
	public function index()
	{
		$data['today'] = Carbon::now()->format('d-m-Y');
		$poli_bpjs = PoliklinikBpjs::all();
		$array_poli_bpjs = [];
		foreach($poli_bpjs as $item)
		{
			$array_poli_bpjs[$item->kode] = $item->nama;
		}

		$data['poliklinik_bpjs'] = json_encode($array_poli_bpjs);
		return view('bpjs.monitoring.kunjungan.index',$data);
	}

	public function getData(Request $request)
	{
		$tanggal = Carbon::createFromFormat('d-m-Y', $request->tanggal)->format('Y-m-d');
		$pelayanan = $request->pelayanan;
		
		$data = app('App\Http\Controllers\BPJS\Monitoring\Kunjungan\ReadController')->getData($tanggal,$pelayanan);

		$data = json_decode($data);

		$data_temp = $data->response->sep ?? [];

		$data_new = $data_temp;

		return json_encode($data_new);
	}
}
