<?php

namespace App\Http\Controllers\Farmasi\Laporan\LaporanController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Farmasi\TransaksiObat;
use App\Models\Farmasi\ResepDetail;
use DB;

class LaporanKesesuaianDokterFornasHarianController extends Controller
{
    public function get($date_start,$date_end,$jenis_resep)
	{
		// $transaksi = TransaksiObat::whereBetween('created_at',[$date_start,$date_end])->whereNotNull('paid_at')->with('pasien_detail','final_detail.resep_detail.racikan','lokasi','dokter')->get();

		$transaksi = TransaksiObat::whereBetween('created_at',[$date_start,$date_end])
							->whereNotNull('paid_at')
							->whereHas('final_detail.resep_detail.obat_detail.item_template', function ($q) {
								$q->where('jenis', '=', 'Obat');
							})
							->with('pasien_detail','final_detail.resep_detail.racikan','lokasi','dokter')
							->get();

		if($jenis_resep == 'fornas') {
			$jenis_resep_query = 'is_fornas';
		} else {
			$jenis_resep_query = 'is_formularium_rs';
		} 
 
		# status is_fornas atau is_formularium_rs berdasarkan resep_detail
		foreach($transaksi as $item) {
			foreach($item->final_detail->resep_detail as $detail)
                if(!empty($detail->obat_detail) && $detail->$jenis_resep_query == 0) {
					if($detail->obat_detail->item_template->jenis == 'Obat') {
						$item->$jenis_resep_query = 0;	
							continue 2;
					}
					else if($detail->obat_detail->item_template->jenis != 'Obat') {
						$item->$jenis_resep_query = 1;
					}
				}
		}
		
		return $transaksi;
	}
}
