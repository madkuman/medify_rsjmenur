<?php

namespace App\Http\Controllers\Farmasi\Laporan\LaporanController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Farmasi\StokLog;
use App\Models\Farmasi\ItemsKategori;
use App\Models\Farmasi\ItemsTemplate;
use DB;

class LaporanPerbekalanFarmasiController extends Controller
{
	public function get($params){
		$stok_log = app('App\Http\Controllers\Farmasi\Items\ReadController')->mutasiStokQueryWithNewFilter($params);

		$array = [];

		foreach ($stok_log as $key => $item) {
			if($item->stok_awal > 0 || $item->penerimaan > 0 || $item->pemakaian > 0 || $item->stok_akhir > 0)
			$array[] = $item;
		}

		return $array;
	}
}
