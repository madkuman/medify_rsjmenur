<?php

namespace App\Http\Controllers\LabPK\Laporan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Models\Urikkes\Paket;
use Carbon\Carbon;

class ReadLaporanPenerimaanController extends Controller
{
    public function get($start,$end,$jenis_laporan)
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

				$date_start = $start->copy()->format('Y-m-d');
				$date_end = $end->copy()->format('Y-m-d');
				$asuransi_ids_implode = implode(",", $asuransi_ids);
				$lokasi_ids = implode(",", $lokasi_list);
				
				$data_query = $this->buildDate($jenis_laporan,$start,$end,$asuransi_name,$nama_pelayanan,$result_all);

				$result_all = $data_query['result_all'];
				
				$query= "
					SELECT 
						".$data_query['select'].",
						SUM(tarif.harga) as total
					FROM 
						`".$db_name."_lab_pk`.transaksi_detail td,
						`".$db_name."_lab_pk`.transaksi t,
						`".$db_name."_keuangan`.tarif tarif,
						`".$db_name."_patients`.pasien_pembayaran pp
					WHERE 
						t.id = td.transaksi_id
						AND t.tarif_tipe_id = tarif.tipe_id
						AND td.tarif_id = tarif.tarif_master_id
						AND tarif.kelas_id IN (t.class,0)
						AND t.pasien_pembayaran_id = pp.id
						AND t.lokasi_id IN ($lokasi_ids)
						AND pp.perusahaan_id IN ($asuransi_ids_implode)
						AND t.verified_at  
						BETWEEN CAST('$date_start' AS DATE) 
						AND CAST('$date_end' AS DATE)
					".$data_query['group_by']."
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

		$medical_checkup = $this->getDataMedicalCheckup($start,$end,$jenis_laporan);
		$result_all = array_merge($result_all, $medical_checkup);
		
		echo "DONE AT :".Carbon::now()->format('H:i')."\n";
		return $result_all;

	}

	private function getAsuransi()
	{
		$data['JKN NON PBI'] = config('const.asuransi_bpjs_non_pbi');
		//$data['JKN PBI'] = config('const.asuransi_bpjs_pbi');	
		// $data['Jamkesda Kota SBY'] = config('const.asuransi_jamkesda_sby');
		// $data['Jamkesda P100'] = config('const.asuransi_jamkesda_p100');
		// $data['Jamkesda P50'] = config('const.asuransi_jamkesda_p50');
		$data['SK Direktur'] = config('const.asuransi_sk_direktur');
		//$data['SPM'] = config('const.asuransi_spm');
		$data['Umum'] = config('const.asuransi_tunai');

		return $data;
	}

	public function getDataMedicalCheckup($start,$end,$jenis_laporan)
	{
		$db_name = config('app.db_name');
		$pakets = Paket::all();
		$result_all = [];
		foreach($pakets as $paket)
		{
			$paket_id = $paket->id;
			
			$date_start = $start->copy()->format('Y-m-d');
			$date_end = $end->copy()->format('Y-m-d');
			$data_query = $this->buildDate($jenis_laporan,$start,$end,'SK Direktur',$paket->nama,$result_all);
			$result_all = $data_query['result_all'];


			$query= "
			SELECT 
				".$data_query['select'].",
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
				AND t.verified_at
				BETWEEN CAST('$date_start' AS DATE) 
				AND CAST('$date_end' AS DATE)
				".$data_query['group_by']."";


			echo $paket->nama;
			$result = DB::select($query);
			foreach($result as $result_row)
			{
				$result_all['SK Direktur'][$paket->nama][$result_row->tanggal] = $result_row->total;
			}
			echo " DONE\n";
			
		}
		return $result_all;

	}

	private function buildDate($jenis_laporan,$start,$end,$asuransi_name,$nama_pelayanan,$result_all)
	{
		if($jenis_laporan == 'bulanan')
		{
			$month = $end->copy()->format('m');
			$month = (int) $month;
			$year = $start->copy()->format('Y');
			$select = "CONCAT(YEAR(t.verified_at), '-' ,MONTH(t.verified_at)) as tanggal";
			$group_by = "GROUP BY YEAR(t.verified_at), MONTH(t.verified_at)";
			for($i=1;$i<=12;$i++)
			{
				if($i<=$month) $total_temp = 0;
				else $total_temp = '';

				$result_all[$asuransi_name][$nama_pelayanan][$year.'-'.$i] = $total_temp;
			}
		}
		else if($jenis_laporan == 'tahunan')
		{
			
			$select = "CONCAT(YEAR(t.verified_at)) as tanggal";
			$group_by = "GROUP BY YEAR(t.verified_at)";
			$temp_start = $start->copy();
            while($temp_start->lte($end))
            {
                $year = $temp_start->copy()->format('Y');
				$result_all[$asuransi_name][$nama_pelayanan][$year] = 0;
                $temp_start->addYear();
            }
		}
		else if($jenis_laporan == 'harian')
		{
			$startDate = $start->copy();
			
			while($startDate->lte($end))
			{
				$temp_date = $startDate->copy()->format('Y-n-j');
				$result_all[$asuransi_name][$nama_pelayanan][$temp_date] = 0;
				$startDate->addDay();
			}
			$select = "CONCAT(YEAR(t.verified_at), '-' ,MONTH(t.verified_at), '-' ,DAY(t.verified_at)) as tanggal";
			$group_by = "GROUP BY YEAR(t.verified_at), MONTH(t.verified_at), DAY(t.verified_at)";
		}
		$data['select'] = $select;
		$data['group_by'] = $group_by;
		$data['result_all'] = $result_all;

		return $data;
	}
}
