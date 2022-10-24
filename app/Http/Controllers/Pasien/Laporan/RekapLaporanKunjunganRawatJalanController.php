<?php

namespace App\Http\Controllers\Pasien\Laporan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RawatJalan\Poliklinik;
use App\Models\RawatJalan\Transaksi;

class RekapLaporanKunjunganRawatJalanController extends Controller
{
	public function get($start,$end)
	{
		$poliklinik = Poliklinik::all();
		foreach($poliklinik as $item)
		{
			$item->total_baru = Transaksi::whereBetween('waktu_masuk',[$start,$end])->whereNotNull('waktu_pemeriksaan')->whereNotNull('kasus_id')->where('poliklinik_id',$item->id)->where('is_pasien_baru',1)->count();
			$item->total_lama = Transaksi::whereBetween('waktu_masuk',[$start,$end])->whereNotNull('waktu_pemeriksaan')->whereNotNull('kasus_id')->where('poliklinik_id',$item->id)->where(function ($q){
				$q->where('is_pasien_baru',0)->orWhereNull('is_pasien_baru');
			})->count();
			$item->total = $item->total_baru + $item->total_lama;
		}
		return $poliklinik;
	}
}
