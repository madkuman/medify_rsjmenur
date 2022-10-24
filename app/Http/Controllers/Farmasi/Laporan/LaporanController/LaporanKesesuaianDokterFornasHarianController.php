<?php

namespace App\Http\Controllers\Farmasi\Laporan\LaporanController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Farmasi\TransaksiObat;

class LaporanKesesuaianDokterFornasHarianController extends Controller
{
    public function get($date_start,$date_end)
	{
		$transaksi = TransaksiObat::whereBetween('created_at',[$date_start,$date_end])->whereNotNull('paid_at')->whereNull('transaksi_asal_id')->with('pasien_detail','final_detail.resep_detail.racikan','lokasi','dokter')->get();
		return $transaksi;
	}
}
