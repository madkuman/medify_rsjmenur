<?php

namespace App\Http\Controllers\Farmasi\Laporan\LaporanController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Farmasi\LogPenghapusan;
use Carbon\Carbon;

class LaporanPenghapusanBarangController extends Controller
{
    public function get($tanggal_awal,$tanggal_akhir,$farmasi_ids,$item_template_ids,$produsen_ids,$supplier_ids,$sumber_dana_ids)
	{
		$today = Carbon::now()->endOfDay();	
		$data = LogPenghapusan::leftJoin('items','items.id','=','log_penghapusan.item_id')
                ->leftJoin('items_farmasi', 'items_farmasi.id', '=', 'items.item_farmasi_id')
				->leftJoin('item_template','item_template.id','=','items_farmasi.item_template_id')
				->leftJoin('penghapusan', 'penghapusan.id', '=', 'log_penghapusan.penghapusan_id')
				->leftJoin('farmasi', 'farmasi.id', '=', 'penghapusan.farmasi_id')
				->leftJoin('log_pengadaan','log_pengadaan.id','=','items.log_pengadaan_id')
				->leftJoin('pengadaan','pengadaan.id','=','log_pengadaan.pengadaan_id')
				->whereIn('farmasi.id',$farmasi_ids)
                ->where('penghapusan.tgl_pengeluaran','>=',$tanggal_awal)
                ->where('penghapusan.tgl_pengeluaran','<=',$tanggal_akhir)
				->when($item_template_ids, function ($query, $item_template_ids) {
					return $query->whereIn('item_template.id', $item_template_ids);
				})
				->when($produsen_ids, function ($query, $produsen_ids) {
					return $query->whereIn('log_pengadaan.produsen_id', $produsen_ids);
				})
				->when($supplier_ids, function ($query, $supplier_ids) {
					return $query->whereIn('penghapusan.supplier_id', $supplier_ids);
				})
				->when($sumber_dana_ids, function ($query, $sumber_dana_ids) {
					return $query->whereIn('pengadaan.sumber_dana_id', $sumber_dana_ids);
				})
				->with('detail_item.item_farmasi.item_template')
				->with('detail_penghapusan')
				->with('detail_item.log_pengadaan.pengadaan')
				->get();

		return $data;
	}
}
