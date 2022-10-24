<?php

namespace App\Http\Controllers\RawatJalan\PermintaanRujuk;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RawatJalan\PermintaanRujuk;
use App\Models\Pasien\Pasien;

class ReadController extends Controller
{
    public function getRiwayatByKasus($kasus_id)
    {	
    	//dd($kasus_id);
    	$data = PermintaanRujuk::where('kasus_id',$kasus_id)->get();
    	//dd($data);
    	return $data;
    }

	public function getTujuanRujuk($pasien_rm, $tgl_lahir, $antrian = null)
	{
		$pasien = Pasien::where('no_rm', $pasien_rm)->where('date_of_birth', $tgl_lahir)->first();
		$transaksi = null;
		if ($pasien) {
			$transaksi = PermintaanRujuk::with('creator','pasien','poli_tujuan', 'kasus.sep.pasien', 'kasus.sep.poli')
					->where('pasien_id', $pasien->id)
					->where('status', 0)
					->groupBy('poli_tujuan_id')
					->get()->toArray();
		}
		if ($antrian) {
			return $pasien;
		}else {
			return $transaksi;
		}
	}
}
