<?php

namespace App\Http\Controllers\Gudang\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ViewController extends Controller
{
	public function index()
	{
		$distribusi = app('App\Http\Controllers\Gudang\Distribusi\ReadController')->getStatistik();
		$unconfirmed = app('App\Http\Controllers\Gudang\Distribusi\ReadController')->getUnconfirmed();
		$supplier = app('App\Http\Controllers\Gudang\Pengadaan\ReadController')->getStatistik();
		$item = app('App\Http\Controllers\Gudang\Items\ReadController')->getStatistik();

		$data['perBulan'] = $distribusi->data;
		$data['perFarmasi'] = $distribusi->farmasi;
		$data['distribusi'] = $distribusi->distribusi;
		$data['unconfirmed'] = $unconfirmed;
		$data['perKategori'] = $item->kategori;
		$data['item'] = $item->item;
		$data['perSupplier'] = $supplier->supplier;
		$data['pengadaan'] = $supplier->pengadaan;
		$data['sidebar_active'] = "dashboard";
		
		return view('warehouse.dashboard.index',$data);
	}
}
