<?php

namespace App\Http\Controllers\Farmasi\PaketObat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hospital\Lokasi;
use App\Models\Farmasi\PaketObat;
use App\Models\Farmasi\TipeObat;

class ViewController extends Controller
{
    public function index($farmasi)
	{
		$farm = session('farmasi');
		$aturan = app('App\Http\Controllers\Farmasi\AturanObat\ReadController')->getAll();

		$data['lokasi'] = Lokasi::all();
		$data['sidebar_active'] = "paket-obat";
		$data['farmasi'] = $farm;
		$data['aturan'] = $aturan;
		$data['satuan_penggunaan'] = TipeObat::all();
		$data['paket_obat'] = PaketObat::where('farmasi_id', $farm->id)->with('detail.item_detail', 'detail.item_detail.item_detail')->orderBy('created_at','desc')->get();
		$data['tipe_obat'] = app('App\Http\Controllers\Farmasi\TipeObat\ReadController')->getAll();
    
		return view('farmasi.paket-obat.index',$data);
	}
}
