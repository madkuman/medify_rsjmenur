<?php

namespace App\Http\Controllers\IGD\Transaksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\IGD\Transaksi;

class ViewController extends Controller
{
	public function new()
	{
		//$data['asuransi'] = app('App\Http\Controllers\IGD\Transaksi\ReadController')->getAsuransi();
		//$data['perusahaan_kerjasama'] = app('App\Http\Controllers\IGD\Transaksi\ReadController')->getPerusahaan();
		//$data['routeFlag'] = 1;
		return view('igd.transaksi.create');
	}

	public function histori()
	{
		$ruangan = app('App\Http\Controllers\IGD\Ruangan\ReadController')->getAll();
		$ruangan =  json_decode($ruangan);
		$data['ruangan'] = $ruangan->data;
		//dd($data);
		return view('igd.transaksi-histori.index',$data);
	}


	public function single($id)
	{
		$transaksi = Transaksi::find($id);
		//if(empty($transaksi->nomor_sep)) return redirect('pasien');
		$data['transaksi'] = $transaksi;
		return view('igd.transaksi.single',$data);
	}
}
