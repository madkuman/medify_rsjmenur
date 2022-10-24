<?php

namespace App\Http\Controllers\UnitTindakan\Transaksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\UnitTindakan\Transaksi;
use Carbon\Carbon;

class CreateController extends Controller
{
	public function create($kasus_id, $tindakan_id,$keterangan = null)
	{	
		$tindakan_hari_ini = Transaksi::where('kasus_id', $kasus_id)->whereDate('created_at', Carbon::today())->where('flag',0)->pluck('unit_tindakan_id')->toArray();
		if (!in_array($tindakan_id, $tindakan_hari_ini)) {
			$transaksi = new Transaksi;
			$transaksi->kasus_id = $kasus_id;
			// $transaksi->pasien_id = $pasien_id;
			$transaksi->unit_tindakan_id = $tindakan_id;
            $transaksi->keterangan = $keterangan;
			// $transaksi->pasien_pembayaran_id = $pasien_pembayaran_id;
			// $transaksi->nomor_sep = $nomor_sep;
			$transaksi->save();
			return $transaksi;
		}
		else return 0;
	}
	public function editKasus($tindakan_id,$kasus_id)
	{	
		$transaksi = Transaksi::find($tindakan_id);
		$transaksi->kasus_id = $kasus_id;
		$transaksi->save();
		return $transaksi;
	}

	public function createByPoli($data_transaksi, $unit_tindakan)
	{
		foreach ($unit_tindakan as $u) {
			$transaksi = new Transaksi;
			$transaksi->unit_tindakan_id = $u->id;
			$transaksi->pasien_id = $data_transaksi->pasien_id;
			$transaksi->pasien_pembayaran_id = $data_transaksi->pasien_pembayaran_id;
			$transaksi->transaksi_rawat_jalan_id = $data_transaksi->id;
			$transaksi->nomor_sep = $data_transaksi->no_sep;
			$transaksi->save();			
		}
		return TRUE;
	}
}