<?php

namespace App\Http\Controllers\LabPK\Laporan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hospital\Kelas;
use App\Models\LabPK\Transaksi;
use DB;

class ReadKunjunganBerdasarkanGenderDanUsiaController extends Controller
{
    public function get($jenis_laporan, $start,$end)
	{
		$labpk = config('const.lab-pk');
		$db_name = config('app.db_name');
		$current_date = $start->copy();
		$query = 'SELECT * FROM';

        if ($jenis_laporan == 'tahunan') {
			$format = 'Y';
        } else if ($jenis_laporan == 'mingguan') {
			$format = 'YW';
        } else {
			$format = "Ym";
        }

		if ($jenis_laporan == 'tahunan') {
			$format = 'Y';
        } else if ($jenis_laporan == 'mingguan') {
			$format = 'YW';
        } else {
			$format = "Ym";
        }

		if ($jenis_laporan == 'tahunan') {
			$format_mysql = "%Y";
		} else if ($jenis_laporan == 'mingguan') {
			$format_mysql = "%Y%u";
		} else {
			$format_mysql = "%Y%m";
		}
		$select = [
			DB::raw('DATE_FORMAT(transaksi.verified_at, "'.$format_mysql.'") as group_key'),
			DB::raw('sum(IF(pasien.gender != 2,1,0)) as gender_lk'),
			DB::raw('sum(IF(pasien.gender = 2,1,0)) as gender_pr'),
			DB::raw('sum(IF(DATEDIFF(transaksi.created_at, pasien.date_of_birth)/365 <= 18,1,0)) as usia_18'),
			DB::raw('sum(IF(DATEDIFF(transaksi.created_at, pasien.date_of_birth)/365 > 18,1,0)) as usia_19'),
		];
		$data_transaksi = Transaksi::select($select)
			->leftJoin(config('app.db_name')."_patients.pasien", 'transaksi.pasien_id', '=', 'pasien.id')
			->whereBetween('transaksi.verified_at', [$start, $end])
			->groupBy(DB::raw('DATE_FORMAT(transaksi.verified_at, "'.$format_mysql.'")'))
			->get();

		// dd($query->get());


		// while($current_date<=$end)
		// {
		// 	if ($jenis_laporan == 'tahunan') {
		// 		$temp_start_of_month = $current_date->startOfYear()->format('Y-m-d');
		// 		$temp_end_of_month = $current_date->endOfYear()->format('Y-m-d');
		// 		$format_query = $current_date->startOfYear()->format($format);
		// 	} else if ($jenis_laporan == 'mingguan') {
		// 		$temp_start_of_month = $current_date->startOfWeek()->format('Y-m-d');
		// 		$temp_end_of_month = $current_date->endOfWeek()->format('Y-m-d');
		// 		$format_query = $current_date->startOfWeek()->format($format);
		// 	} else {
		// 		$temp_start_of_month = $current_date->startOfMonth()->format('Y-m-d');
		// 		$temp_end_of_month = $current_date->endOfMonth()->format('Y-m-d');
		// 		$format_query = $current_date->startOfMonth()->format($format);
		// 	}
		// 	if ($temp_start_of_month < $start) {
		// 		$temp_start_of_month = $start->copy(); # jika week pake ymd maka jika milih start sabtu, maka senin - jumat gk keiutng
		// 	}


		// 	$data_query = "
		// 	SELECT t.id, p.gender, DATEDIFF(t.created_at, p.date_of_birth)/365 AS usia 
		// 	FROM `".$db_name."_lab_pk`.transaksi t
		// 	LEFT JOIN `".$db_name."_patients`.pasien p
		// 	ON t.pasien_id = p.id
		// 	WHERE t.verified_at  
		// 	BETWEEN CAST('$temp_start_of_month' AS DATE) 
		// 	AND CAST('$temp_end_of_month' AS DATE)";


		// 	$query .= "
		// 	(
		// 		SELECT COUNT(1) AS total_".$format_query."_gender_lk
		// 		FROM ($data_query) table_data
		// 		WHERE gender != 2
		// 	)table_".$format_query."_gender_lk,";
		// 	$query .= "
		// 	(
		// 		SELECT COUNT(1) AS total_".$format_query."_gender_pr
		// 		FROM ($data_query) table_data
		// 		WHERE gender = 2
		// 	)table_".$format_query."_gender_pr,";
		// 	$query .= "
		// 	(
		// 		SELECT COUNT(1) AS total_".$format_query."_usia_18
		// 		FROM ($data_query) table_data
		// 		WHERE usia <= 18
		// 	)table_".$format_query."_usia_18,";

		// 	$query .= "
		// 	(
		// 		SELECT COUNT(1) AS total_".$format_query."_usia_19
		// 		FROM ($data_query) table_data
		// 		WHERE usia > 18
		// 	)table_".$format_query."_usia_19,";

		// 	if ($jenis_laporan == 'tahunan') {
		// 		$current_date->addYear();
		// 	} else if ($jenis_laporan == 'mingguan') {
		// 		$current_date->addWeek();
		// 	} else {
		// 		$current_date->addMonth();
		// 	}
		// }
		// $query = substr($query, 0,-1);
		// $query.=";";

		// $result = DB::connection('lab_pk')->select($query);
		$data = [];


		if ($jenis_laporan == 'tahunan') {
			$new_end = $end->copy()->endOfYear();
			$current_date = $start->copy()->startOfYear();
		} else if ($jenis_laporan == 'mingguan') {
			$new_end = $end->copy()->endOfWeek();
			$current_date = $start->copy()->startOfWeek();
		} else {
			$new_end = $end->copy()->endOfYear();
			$current_date = $start->copy()->startOfYear();
		}

		while($current_date <= $new_end)
		{
			$format_query = $current_date->format($format);
			$format_query = (int) $format_query;
			$data[$format_query]["gender_lk"] = 0;
			$data[$format_query]["gender_pr"] = 0;
			$data[$format_query]["usia_18"] = 0;
			$data[$format_query]["usia_19"] = 0;
			if ($jenis_laporan == 'tahunan') {
				$header_format = 'Y';
			} else if ($jenis_laporan == 'mingguan') {
				$header_format = "Y \WW";
			} else {
				$header_format = 'M';
			}
			$data[$format_query]['header'] = indonesian_date($current_date,$header_format); 
			
			if ($jenis_laporan == 'tahunan') {
				$current_date->addYear();
			} else if ($jenis_laporan == 'mingguan') {
				$current_date->addWeek();
			} else {
				$current_date->addMonth();
			}
		}

		// foreach($result[0] as $index => $item)
		// {
		// 	$slugs = explode("_", $index);
		// 	$date = $slugs[1];
		// 	$type = $slugs[2]."_".$slugs[3];
		// 	$data[$date][$type] = $item;
		// }
		
		foreach ($data_transaksi as $item) {
			$group_key = $item->group_key;
			foreach ($item->toArray() as $key => $value) {
				if (!in_array($key, ['gender_lk', 'gender_pr', 'usia_18', 'usia_19'])) continue;
				$data[$group_key][$key] = $value; 
			}
		}
		
		return $data;

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
		$data['asuransi_sk_direktur'] = config('const.asuransi_sk_direktur');

		return $data;
	}
}
