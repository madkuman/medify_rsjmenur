<?php

namespace App\Http\Controllers\Farmasi\Laporan\LaporanController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Farmasi\StokLog;
use App\Models\Farmasi\ItemsKategori;
use DB;

class MutasiStokEmergensiController extends Controller
{
	public function get($date_start,$date_end,$kategori_ids,$farmasi_ids){
		$date_start->startOfDay();
		$date_end->endOfDay();

		$item_template_ids = ItemsKategori::whereIn('kategori_id',$kategori_ids)->pluck('item_template_id')->toArray();

		$stok_log = StokLog::whereBetween('tanggal',[$date_start,$date_end])
			->whereIn('farmasi_id',$farmasi_ids)
			->whereIn('item_template_id',$item_template_ids)
			->select([
				DB::raw("SUM(stok) as stok_akhir"),
				DB::raw("SUM(stok_awal) as stok_awal"),
				DB::raw("SUM(stok_mutasi) as stok_mutasi"),
				DB::raw("(SUM(total_pengadaan)+SUM(total_distribusi_masuk)) as stok_masuk"),
				DB::raw("(
					SUM(total_distribusi_keluar)+
					SUM(total_penghapusan)+
					SUM(total_transaksi)) 
					as stok_keluar"),
				'item_template_id',
				'harga'
			])
			->groupBy('item_template_id','harga')
			->with('item_template')->get();

		return $stok_log;
	}
}
