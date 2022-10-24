<?php

namespace App\Http\Controllers\Farmasi\Laporan\LaporanController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Farmasi\Items;
use Carbon\Carbon;

class LaporanBarangMendekatiExpiredController extends Controller
{
    public function get($farmasi_ids,$batas_hari)
	{
		$today = Carbon::now()->startOfDay();	
		$max_date = Carbon::now()->addDays($batas_hari)->endOfDay();
		$data = Items::join('items_farmasi', 'items_farmasi.id', '=', 'items.item_farmasi_id')
				->join('farmasi', 'farmasi.id', '=', 'items_farmasi.farmasi_id')
				->whereIn('farmasi.id',$farmasi_ids)
				->where('items.jumlah','>',0)
				->where('items.kadaluarsa','>=',$today)
				->where('items.kadaluarsa','<=',$max_date)
				->with('item_farmasi.item_template')
				->with('log_pengadaan.pengadaan')
				->get();

		$result['max_date'] = $max_date;
		$result['data'] = $data;

		return $result;
	}
}
