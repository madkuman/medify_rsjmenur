<?php

namespace App\Http\Controllers\Farmasi\Laporan\LaporanController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Farmasi\StokLog;
use App\Models\Farmasi\ItemsKategori;
use App\Models\Farmasi\ItemsTemplate;
use App\Models\Farmasi\Kategori;
use DB;

class LaporanPersediaanFarmasiController extends Controller
{
	public function get($date,$item_template_ids,$farmasi_ids){
		$date_start = $date->copy()->startOfDay();
		$date_end = $date->copy()->endOfDay();
		$stok_log = app('App\Http\Controllers\Farmasi\Items\ReadController')->mutasiStokQuery($farmasi_ids,$date_start,$date_end,$item_template_ids);

		$array = [];

		foreach ($stok_log as $key => $item) {
			if($item->stok_awal > 0 || $item->penerimaan > 0 || $item->pemakaian > 0 || $item->stok_akhir > 0)
			$array[] = $item;
		}
		return $array;
	}
}
