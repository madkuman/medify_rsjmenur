<?php

namespace App\Http\Controllers\LabPK\Laporan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\LabPK\Transaksi;
use App\Models\LabPK\TransaksiDetail;
use DB;

class ReadLaporanKunjunganTahunanPerTarifController extends Controller
{
    public function get($start,$end)
	{
		$current_date = $start->copy();
		$count_baris = 0;
		$temp_data= [];
		
		while($current_date<=$end)
		{
			$temp_start_of_month = $current_date->copy()->startOfMonth();
			$temp_end_of_month = $current_date->copy()->endOfMonth();
			$format_query = $current_date->copy()->startOfMonth()->format('M');
			
			$transaksi = Transaksi::with('asal')
								  ->whereNotNull('verified_at')
								  ->whereNotNull('verified_by')
								  ->where('verified_at','>=',$temp_start_of_month)
								  ->where('verified_at','<=',$temp_end_of_month)
								  ->pluck('id')
								  ->toArray();

			$transaksi_detail = TransaksiDetail::with('tarif')
			                                   ->whereIn('transaksi_id',$transaksi)
											   ->groupBy('tarif_id')
			  								   ->select('tarif_id', DB::raw('count(1) as total'))	
											   ->get();	 					 
			
			$temp_data[$format_query] = $transaksi_detail;
			
			$current_date->addMonth();
			
		}
		$data_return = [];
		foreach($temp_data as $key => $item){
			foreach($item as $this_item){
				$data_return[$this_item->tarif->deskripsi][$key] = $this_item->total;
			}
			
		}
		
		return $data_return;
	}
}
