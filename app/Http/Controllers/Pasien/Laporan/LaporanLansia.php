<?php

namespace App\Http\Controllers\Pasien\Laporan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\IGD\Transaksi as TransaksiIGD;
use App\Models\RawatJalan\Transaksi as TransaksiRawatJalan;
use App\Models\Pasien\Pasien;


class LaporanLansia extends Controller
{
	public function get($start,$end)
	{
		$data = [];
		$data = $this->getIGD($data,$start,$end);
		$data = $this->getRJ($data,$start,$end);
		return $data;
	}

	private function getIGD($data,$start,$end)
	{
		$usia_60 = 365*60;
		$transaksi = TransaksiIGD::whereBetween('waktu_masuk',[$start,$end])->where('usia_masuk','>=',$usia_60)->with('pasien')->get();
		foreach($transaksi as $temp)
		{
			array_push($data, $temp);
		}
		return $data;
	}

	private function getRJ($data,$start,$end)
	{
		$usia_60 = 365*60;
		$transaksi = TransaksiRawatJalan::whereBetween('waktu_masuk',[$start,$end])->where('usia_masuk','>=',$usia_60)->with('pasien')->get();
		foreach($transaksi as $temp)
		{
			array_push($data, $temp);
		}
		return $data;
	}
}
