<?php

namespace App\Http\Controllers\CSSD\Transaksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\KamarOperasi\Ruangan;
use App\Models\CSSD\Alkes;
use App\Models\CSSD\Transaksi;

class ViewController extends Controller
{
	public function permintaanIndex()
	{
		$navbar_active = 'permintaan';
		$data['navbar_active'] = $navbar_active;
		$data['ruangan_ok'] = Ruangan::all();;
		return view('cssd.transaksi.permintaan.index',$data);
	}

	public function permintaanBaru()
	{
		$navbar_active = 'permintaan';
		$data['navbar_active'] = $navbar_active;
		$data['ruangan_ok'] = Ruangan::all();
		$data['alkes'] = Alkes::all();
		return view('cssd.transaksi.permintaan.baru',$data);
	}

	public function single($id)
	{
		$transaksi = Transaksi::find($id);
		$data['transaksi'] = $transaksi;
		if($transaksi->type == 1)
			return view('cssd.transaksi.permintaan.single',$data);
		else
			return view('cssd.transaksi.pengembalian.single',$data);
	}

	public function pengembalianIndex()
	{
		$navbar_active = 'pengembalian';
		$data['navbar_active'] = $navbar_active;
		$data['ruangan_ok'] = Ruangan::all();;
		return view('cssd.transaksi.pengembalian.index',$data);
	}

	public function pengembalianBaru()
	{
		$navbar_active = 'pengembalian';
		$data['navbar_active'] = $navbar_active;
		$data['ruangan_ok'] = Ruangan::all();
		$data['alkes'] = Alkes::all();
		return view('cssd.transaksi.pengembalian.baru',$data);
	}
}
