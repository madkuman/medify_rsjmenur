<?php

namespace App\Http\Controllers\Farmasi\Laporan\LaporanController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Farmasi\Items;
use Carbon\Carbon;

class LaporanBarangTelahExpiredController extends Controller
{
    public function get($farmasi_ids,$item_template_ids,$produsen_ids,$supplier_ids,$sumber_dana_ids)
	{
		$today = Carbon::now()->endOfDay();	
		
		$eager = [
			'item_farmasi.item_template',
			'log_pengadaan.produsen',
			'log_pengadaan.pengadaan',
			'log_pengadaan.pengadaan.supplier_detail'
		];
		
		$data = Items::with($eager)
				->select('items.id','items.item_farmasi_id','items.log_pengadaan_id','items.kadaluarsa','items.jumlah','items.kadaluarsa')
				->join('items_farmasi', 'items_farmasi.id', '=', 'items.item_farmasi_id')
				->join('farmasi', 'farmasi.id', '=', 'items_farmasi.farmasi_id')
				->leftJoin('item_template','item_template.id','=','items_farmasi.item_template_id')
				->leftJoin('log_pengadaan','log_pengadaan.id','=','items.log_pengadaan_id')
				->leftJoin('pengadaan','pengadaan.id','=','log_pengadaan.pengadaan_id')
				->whereIn('farmasi.id',$farmasi_ids)
				->where('items.jumlah','>',0)
				->where('items.kadaluarsa','<=',$today)
				->when($item_template_ids, function ($query, $item_template_ids) {
					return $query->whereIn('item_template.id', $item_template_ids);
				})
				->when($produsen_ids, function ($query, $produsen_ids) {
					return $query->whereIn('log_pengadaan.produsen_id', $produsen_ids);
				})
				->when($supplier_ids, function ($query, $supplier_ids) {
					return $query->whereIn('pengadaan.supplier_id', $supplier_ids);
				})
				->when($sumber_dana_ids, function ($query, $sumber_dana_ids) {
					return $query->whereIn('pengadaan.sumber_dana_id', $sumber_dana_ids);
				})
				// ->with('item_farmasi.item_template')
				// ->with('log_pengadaan.pengadaan')
				->orderBy('items.kadaluarsa')
				->get();

		return $data;
	}
}
