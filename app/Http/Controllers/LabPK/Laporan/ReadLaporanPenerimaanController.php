<?php

namespace App\Http\Controllers\LabPK\Laporan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Models\Urikkes\Paket;
use Carbon\Carbon;

class ReadLaporanPenerimaanController extends Controller
{
    public function get($start,$end)
	{
		echo "START AT :".Carbon::now()->format('H:i')."\n";
		$labpk = config('const.lab-pk');
		$db_name = config('app.db_name');
		$asuransi_list = $this->getAsuransi();
		$lokasi_master['rawat_inap'] = app('App\Http\Controllers\Hospital\Lokasi\ReadController')->getLokasiByDepartemenSlug('rawat-inap')->pluck('id')->toArray();
		$lokasi_master['rawat_jalan'] = app('App\Http\Controllers\Hospital\Lokasi\ReadController')->getLokasiByDepartemenSlug('rawat-jalan')->pluck('id')->toArray();
		$lokasi_master['igd'] = app('App\Http\Controllers\Hospital\Lokasi\ReadController')->getLokasiByDepartemenSlug('igd')->pluck('id')->toArray();

		$result_all = [];



		foreach($asuransi_list as $asuransi_name => $asuransi_ids)
		{

			foreach($lokasi_master as $nama_pelayanan => $lokasi_list)
			{
				if($nama_pelayanan == 'rawat_inap') $nama_pelayanan = 'Rawat Inap';
				else if($nama_pelayanan == 'rawat_jalan') $nama_pelayanan = 'Rawat Jalan';
				else if($nama_pelayanan == 'igd') $nama_pelayanan = 'IGD';

				$current_date = $start->copy();

				$temp_start_of_month = $start->copy()->startOfMonth()->format('Y-m-d');
				$temp_end_of_month = $end->copy()->endOfMonth()->format('Y-m-d');
				$format_query = $current_date->startOfMonth()->format('Ym');
				$asuransi_ids_implode = implode(",", $asuransi_ids);
				$lokasi_ids = implode(",", $lokasi_list);
				$month = $end->copy()->endOfMonth()->format('m');
				$month = (int) $month;
				$year = $start->copy()->startOfMonth()->format('Y');

				for($i=1;$i<=12;$i++)
				{
					if($i<=$month) $total_temp = 0;
					else $total_temp = '';

					$result_all[$asuransi_name][$nama_pelayanan][$year.'-'.$i] = $total_temp;
				}

				$query= "
					SELECT 
						CONCAT(YEAR(k.krs_at), '-' ,MONTH(k.krs_at)) as tanggal,
						SUM(tarif.harga) as total
					FROM 
						`".$db_name."_lab_pk`.transaksi_detail td,
						`".$db_name."_lab_pk`.transaksi t,
						`".$db_name."_keuangan`.tarif tarif,
						`".$db_name."_kasus`.kasus k,
						`".$db_name."_patients`.pasien_pembayaran pp
					WHERE 
						t.id = td.transaksi_id
						AND t.tarif_tipe_id = tarif.tipe_id
						AND td.tarif_id = tarif.tarif_master_id
						AND tarif.kelas_id IN (t.class,0)
						AND t.kasus_id = k.id
						AND k.pasien_pembayaran_id = pp.id
						AND t.lokasi_id IN ($lokasi_ids)
						AND pp.perusahaan_id IN ($asuransi_ids_implode)
						AND k.krs_at  
						BETWEEN CAST('$temp_start_of_month' AS DATE) 
						AND CAST('$temp_end_of_month' AS DATE)
						GROUP BY YEAR(k.krs_at), MONTH(k.krs_at)
				";

				
				echo $asuransi_name.'_'.$nama_pelayanan;

				$result = DB::connection('lab_pk')->select($query);
				foreach($result as $result_row)
				{
					$result_all[$asuransi_name][$nama_pelayanan][$result_row->tanggal] = $result_row->total;
				}
				echo " DONE\n";
				
			}
		}

		$medical_checkup = $this->getDataMedicalCheckup($start,$end);
		$result_all['SK Direktur'] = array_merge($result_all['SK Direktur'], $medical_checkup);
		
		echo "DONE AT :".Carbon::now()->format('H:i')."\n";
		return $result_all;

	}

	private function getAsuransi()
	{
		$data['JKN NON PBI'] = config('const.asuransi_bpjs_non_pbi');
		$data['JKN PBI'] = config('const.asuransi_bpjs_pbi');	
		$data['Jamkesda Kota SBY'] = config('const.asuransi_jamkesda_sby');
		$data['Jamkesda P100'] = config('const.asuransi_jamkesda_p100');
		$data['Jamkesda P50'] = config('const.asuransi_jamkesda_p50');
		$data['SK Direktur'] = config('const.asuransi_sk_direktur');
		$data['SPM'] = config('const.asuransi_spm');
		$data['Umum'] = config('const.asuransi_tunai');

		return $data;
	}

	public function getDataMedicalCheckup($start,$end)
	{
		$db_name = config('app.db_name');
		$pakets = Paket::all();
		$result_all = [];
		foreach($pakets as $paket)
		{
			$paket_id = $paket->id;
			
			$temp_start_of_month = $start->copy()->startOfMonth()->format('Y-m-d');
			$temp_end_of_month = $end->copy()->endOfMonth()->format('Y-m-d');
			$month = $end->copy()->endOfMonth()->format('m');
			$month = (int) $month;
			$year = $start->copy()->startOfMonth()->format('Y');


			for($i=1;$i<=12;$i++)
			{
				if($i<=$month) $total_temp = 0;
				else $total_temp = '';

				$result_all[$paket->nama][$year.'-'.$i] = $total_temp;
			}

			$query= "
			SELECT 
				CONCAT(YEAR(k.krs_at), '-' ,MONTH(k.krs_at)) as tanggal, 
				SUM(tarif.harga) as total
			FROM 
				`".$db_name."_lab_pk`.transaksi_detail td,
				`".$db_name."_lab_pk`.transaksi t,
				`".$db_name."_keuangan`.tarif tarif,
				`".$db_name."_kasus`.kasus k,
				`".$db_name."_urikkes`.transaksi t_med,
				`".$db_name."_urikkes`.transaksi_detail td_med,
				`".$db_name."_urikkes`.paket p_med
			WHERE 
				t.id = td.transaksi_id
				AND t.tarif_tipe_id = tarif.tipe_id
				AND td.tarif_id = tarif.tarif_master_id
				AND tarif.kelas_id IN (t.class,0) 
				AND t.kasus_id = k.id
				AND t_med.kasus_id = k.id
				AND t_med.id = td_med.transaksi_id
				AND td_med.paket_id = p_med.id
				AND p_med.id = $paket_id
				AND k.krs_at
				BETWEEN CAST('$temp_start_of_month' AS DATE) 
				AND CAST('$temp_end_of_month' AS DATE)
				GROUP BY YEAR(k.krs_at), MONTH(k.krs_at);";


			
			echo $paket->nama;
			$result = DB::select($query);
			foreach($result as $result_row)
			{
				$result_all[$paket->nama][$result_row->tanggal] = $result_row->total;
			}
			echo " DONE\n";
			
		}
		return $result_all;

	}
}
