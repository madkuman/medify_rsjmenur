<?php

namespace App\Http\Controllers\LabPK\Laporan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\LabPK\Transaksi;
use App\Models\Pasien\PembayaranPerusahaan;
use App\Models\LabPK\TransaksiDetail;
use App\Models\Hospital\Kelas;
use DB;

class ReadLaporanKunjunganTahunanPerDebiturController extends Controller
{
    public function get($start,$end)
	{
		$current_date = $start->copy();
		$count_baris = 0;
		$temp_data= [];
		$asuransi_list = $this->getAsuransi();
		$all_asuransi = [];
		foreach($asuransi_list as $asuransi_item)
		{
			$all_asuransi = array_merge($all_asuransi,$asuransi_item);
		}

		$asuransi_ids_implode = implode(",", $all_asuransi);
		//dd($asuransi_ids_implode);


		$asuransi_name = PembayaranPerusahaan::whereIn('id',$all_asuransi)->select('id','nama')->get();
		$kelas = Kelas::select('id','nama')->get();
		while($current_date<=$end)
		{
			$temp_start_of_month = $current_date->copy()->startOfMonth()->format('Y-m-d');
			$temp_end_of_month = $current_date->copy()->endOfMonth()->format('Y-m-d');
			$format_query = $current_date->copy()->startOfMonth()->format('M');
			
			$db_name = config('app.db_name');
			$query = "
			SELECT COUNT(1) as total,perusahaan_id,class FROM
			(
			SELECT pp.perusahaan_id as perusahaan_id,t.class as class FROM 
			`".$db_name."_lab_pk`.transaksi t,
			`".$db_name."_patients`.pasien_pembayaran pp
			WHERE t.pasien_pembayaran_id = pp.id
			AND pp.perusahaan_id in ($asuransi_ids_implode)
			AND t.verified_at BETWEEN CAST('$temp_start_of_month' AS DATE) 
			AND CAST('$temp_end_of_month' AS DATE)
			)tes
			GROUP BY perusahaan_id,class
			";			
			//dd($query);
			$transaksi = DB::select($query);
			
			$temp_data[$format_query] = $transaksi;
			
			$current_date->addMonth();
			
		}
		//dd($temp_data,$asuransi_name,$kelas);
		$data_return = [];
		$data_return['Umum']['1'] = [];
		$data_return['Umum']['2'] = [];
		$data_return['Umum']['3'] = [];
		$data_return['Umum']['VIP A'] = [];
		$data_return['Umum']['VIP B'] = [];
		$data_return['Umum']['VIP C'] = [];
		$data_return['Umum']['VIP D'] = [];
		$data_return['BPJS JKN NON PBI']['1'] = [];
		$data_return['BPJS JKN NON PBI']['2'] = [];
		$data_return['BPJS JKN NON PBI']['3'] = [];
		$data_return['BPJS JKN NON PBI']['VIP A'] = [];
		$data_return['BPJS JKN NON PBI']['VIP B'] = [];
		$data_return['BPJS JKN NON PBI']['VIP C'] = [];
		$data_return['BPJS JKN NON PBI']['VIP D'] = [];
		$data_return['BPJS JKN PBI'][0] = [];
		$data_return['JAMKESDA']['P-100'] = [];
		$data_return['JAMKESDA']['P-50'] = [];
		$data_return['JAMKESDA']['KOTA SBY'] = [];
		$data_return['SPM'][0] = [];
		$data_return['KARTU SEHATI'][0] = [];
		$data_return['KEMENKES COVID'][0] = [];
		foreach($temp_data as $key => $item){
			foreach($item as $this_item){
				//dd($this_item->perusahaan_id,config('const.asuransi_tunai')[0]);
				if($this_item->perusahaan_id == config('const.asuransi_tunai')[0]){
					$this_kelas = $kelas->where('id',$this_item->class)->first();
					//dd($this_kelas);
					$data_return["Umum"][$this_kelas->nama][$key] = $this_item->total;
				}
				else if($this_item->perusahaan_id == config('const.asuransi_bpjs_non_pbi')[0]){
					$this_kelas = $kelas->where('id',$this_item->class)->first();
					$data_return["BPJS JKN NON PBI"][$this_kelas->nama][$key] = $this_item->total;
				}
				else if($this_item->perusahaan_id == config('const.asuransi_bpjs_pbi')[0]){
					if(!isset($data_return["BPJS JKN PBI"][$key])){
						$data_return["BPJS JKN PBI"][0][$key] = 0;
					}
					$data_return["BPJS JKN PBI"][0][$key] += $this_item->total;
				}
				else if($this_item->perusahaan_id == config('const.asuransi_jamkesda_p100')[0]){
					if(!isset($data_return["JAMKESDA"]["P-100"][$key])){
						$data_return["JAMKESDA"]["P-100"][$key] = 0;
					}
					$data_return["JAMKESDA"]["P-100"][$key] += $this_item->total;
				}
				else if($this_item->perusahaan_id == config('const.asuransi_jamkesda_p50')[0]){
					if(!isset($data_return["JAMKESDA"]["P-50"][$key])){
						$data_return["JAMKESDA"]["P-50"][$key]  = 0;
					}
					$data_return["JAMKESDA"]["P-50"][$key] += $this_item->total;
				}
				else if($this_item->perusahaan_id == config('const.asuransi_jamkesda_sby')[0]){
					if(!isset($data_return["JAMKESDA"]["KOTA SBY"][$key])){
						$data_return["JAMKESDA"]["KOTA SBY"][$key]  = 0;
					}
					$data_return["JAMKESDA"]["KOTA SBY"][$key] += $this_item->total;
				}
				else if($this_item->perusahaan_id == config('const.asuransi_spm')[0]){
					if(!isset($data_return["SPM"][0][$key])){
						$data_return["SPM"][0][$key] = 0;
					}
					$data_return["SPM"][0][$key] += $this_item->total;
				}
				else if($this_item->perusahaan_id == config('const.asuransi_kartu_sehati')[0]){
					if(!isset($data_return["KARTU SEHATI"][0][$key])){
						$data_return["KARTU SEHATI"][0][$key] = 0;
					}
					$data_return["KARTU SEHATI"][0][$key] += $this_item->total;
				}
				else if($this_item->perusahaan_id == config('const.asuransi_kemenkes_covid')[0]){
					if(!isset($data_return["KEMENKES COVID"][0][$key])){
						$data_return["KEMENKES COVID"][0][$key] = 0;
					}
					$data_return["KEMENKES COVID"][0][$key] += $this_item->total;
				}
				
			}
			
		}
		//dd($data_return);
		return $data_return;
	}

	private function getAsuransi()
	{
		$data['asuransi_tunai'] = config('const.asuransi_tunai');
		$data['asuransi_bpjs_non_pbi'] = config('const.asuransi_bpjs_non_pbi');
		$data['asuransi_bpjs_pbi'] = config('const.asuransi_bpjs_pbi');	
		$data['asuransi_jamkesda_p100'] = config('const.asuransi_jamkesda_p100');
		$data['asuransi_jamkesda_p50'] = config('const.asuransi_jamkesda_p50');
		$data['asuransi_jamkesda_sby'] = config('const.asuransi_jamkesda_sby');
		$data['asuransi_spm'] = config('const.asuransi_spm');
		$data['asuransi_kartu_sehati'] = config('const.asuransi_kartu_sehati');
		$data['asuransi_kemenkes_covid'] = config('const.asuransi_kemenkes_covid');
		return $data;
	}
}
