<?php

namespace App\Http\Controllers\LabPK\Laporan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\LabPK\Transaksi;
use App\Models\Urikkes\Transaksi as TransaksiUrikkes;
use App\Models\Urikkes\TransaksiDetail as TransaksiDetailUrikkes;
use App\Models\Urikkes\Paket;
use App\Models\Hospital\Lokasi;
use DB;

class ReadLaporanKunjunganTahunanPerLokasiController extends Controller
{
    public function get($start,$end)
	{
		$current_date = $start->copy();
		$count_baris = 0;
		$temp_data= [];
		$temp_data_urikkes = [];
		$lokasis = Lokasi::with('departemen')->get();
		$pakets = Paket::all();
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
								  ->where('lokasi_id','!=',6)
								  ->groupBy('lokasi_id')
								  ->select('lokasi_id', DB::raw('count(1) as total'))
								  ->get();

			$kasus_mcu = Transaksi::whereNotNull('verified_at')
			  ->whereNotNull('verified_by')
			  ->where('verified_at','>=',$temp_start_of_month)
			  ->where('verified_at','<=',$temp_end_of_month)
			  ->where('lokasi_id',6)
			  ->pluck('kasus_id')
			  ->toArray();

			$transaksi_mcu = TransaksiUrikkes::with('transaksi_detail_first:transaksi_id,paket_id')
											 ->whereIn('kasus_id',$kasus_mcu)
											 ->select('id','kasus_id')
											 ->get();							 
			
			$temp_data[$format_query] = $transaksi;
			$temp_data_urikkes[$format_query] = $transaksi_mcu;
			$current_date->addMonth();
			
		}
		$data_return = [];
		$data_return['Rawat Inap'] = [];
		$data_return['Rawat Jalan'] = [];
		$data_return['MBCU'] = [];
		$data_return['Lain-lain'] = [];
		foreach($temp_data as $key => $item){
			//dd($key,$item[0]->lokasi_id);
			$this_item = $item->first();
			//dd($this_item);
			if(empty($this_item) && count($item) == 0){
				continue;
			}
			$lokasi_id = $this_item->lokasi_id;
			if(empty($lokasi_id)){
				$data_return["Lain-lain"]["Mandiri"][$key] = $this_item->total;
			}
			else{
				$temp_lokasi = $lokasis->where('id',$this_item->lokasi_id)->first();
				//dd($temp_lokasi,$lokasis,$this_item->lokasi_id);
				if($temp_lokasi->departemen->slug == "rawat-inap"){
					$data_return["Rawat Inap"][$temp_lokasi->nama][$key] = $this_item->total;
				}
				else{
					if($temp_lokasi->departemen->slug == "igd"){
						$data_return["Rawat Jalan"]["igd"][$key] = $this_item->total;
					}
					else{
						$data_return["Rawat Jalan"][$temp_lokasi->nama][$key] = $this_item->total;
					}
					
				}
			}
			
		}

		foreach($temp_data_urikkes as $key => $item){
			foreach($item as $item2){
				$paket_id = $item2->transaksi_detail_first->paket_id;
				$this_paket = $pakets->where('id',$paket_id)->first();
				if(!empty($this_paket)){
					if(!isset($data_return["MBCU"][$this_paket->nama][$key])){
						$data_return["MBCU"][$this_paket->nama][$key] = 0;
					}
					$data_return["MBCU"][$this_paket->nama][$key]++;
				}
				
			}
		}
		//dd($data_return);
		return $data_return;
	}
}
