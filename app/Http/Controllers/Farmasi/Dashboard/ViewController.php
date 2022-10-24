<?php

namespace App\Http\Controllers\Farmasi\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hospital\Lokasi;

class ViewController extends Controller
{
	public function index($farmasi)
	{
		$farm = session('farmasi');
		
		if ($farm->jenis < 4 && $farm->jenis != 3) { //Farmasi
			$transaksi = app('App\Http\Controllers\Farmasi\Transaksi\ReadController')->getStatistik($farm->id);
			$data['unconfirmed'] = app('App\Http\Controllers\Farmasi\Transaksi\ReadController')->getUnconfirmed($farm->id);

			$data['distribusi'] = app('App\Http\Controllers\Farmasi\Distribusi\ReadController')->getStatistik($farm->id);
			$data['pengadaan'] = app('App\Http\Controllers\Farmasi\Pengadaan\ReadController')->getStatistik($farm->id);
			$data['transaksi'] = $transaksi['count'];
			unset($transaksi['count']);
			$data['perBulan'] = $transaksi;
		} else { //Gudang
			$distribusi = app('App\Http\Controllers\Farmasi\Distribusi\ReadController')->getStatistikGudang($farm->id);
			$supplier = app('App\Http\Controllers\Farmasi\Pengadaan\ReadController')->getStatistikSupplier($farm->id);
			$item = app('App\Http\Controllers\Farmasi\Items\ReadController')->getStatistik($farm->id); //exclude
			$data['unconfirmed'] = app('App\Http\Controllers\Farmasi\Distribusi\ReadController')->getUnconfirmed($farm->id);
			$data['pengadaan'] = $supplier->pengadaan;
			$data['distribusi'] = $distribusi->distribusi;
			$data['perFarmasi'] = $distribusi->farmasi;
			// $data['perSupplier'] = $supplier->supplier;
			$data['perBulan'] = $distribusi->data;
			// $data['perKategori'] = $item->kategori;
			$data['item'] = $item->item;
		}
        $temp = app('App\Http\Controllers\Farmasi\Farmasi\ViewController')->templateView($farmasi,$farm,"dashboard");
		$data = $data + $temp; 
		return view('farmasi.dashboard.index',$data);
	}
}
