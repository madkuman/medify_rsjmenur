<?php

namespace App\Http\Controllers\Farmasi\Laporan\LaporanController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Farmasi\Items;
use Carbon\Carbon;

class LaporanBarangTelahExpiredController extends Controller
{
    public function get($farmasi_ids)
	{
		$today = Carbon::now()->endOfDay();	
		$data = Items::join('items_farmasi', 'items_farmasi.id', '=', 'items.item_farmasi_id')
				->join('farmasi', 'farmasi.id', '=', 'items_farmasi.farmasi_id')
				->whereIn('farmasi.id',$farmasi_ids)
				->where('items.jumlah','>',0)
				->where('items.kadaluarsa','<=',$today)
				->with('item_farmasi.item_template')
				->with('log_pengadaan.pengadaan')
				->get();

		return $data;
	}
}
