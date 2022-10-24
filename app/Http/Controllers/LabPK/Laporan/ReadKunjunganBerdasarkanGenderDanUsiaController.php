<?php

namespace App\Http\Controllers\LabPK\Laporan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class ReadKunjunganBerdasarkanGenderDanUsiaController extends Controller
{
    public function get($start,$end)
	{
		$labpk = config('const.lab-pk');
		$db_name = config('app.db_name');
		$current_date = $start->copy();
		$query = 'SELECT * FROM';

		while($current_date<=$end)
		{
			$temp_start_of_month = $current_date->startOfMonth()->format('Y-m-d');
			$temp_end_of_month = $current_date->endOfMonth()->format('Y-m-d');
			$format_query = $current_date->startOfMonth()->format('Ym');

			$data_query = "
			SELECT t.id, p.gender, DATEDIFF(t.created_at, p.date_of_birth)/365 AS usia 
			FROM `".$db_name."_lab_pk`.transaksi t
			LEFT JOIN `".$db_name."_patients`.pasien p
			ON t.pasien_id = p.id
			WHERE t.verified_at  
			BETWEEN CAST('$temp_start_of_month' AS DATE) 
			AND CAST('$temp_end_of_month' AS DATE)";


			$query .= "
			(
				SELECT COUNT(1) AS total_".$format_query."_gender_lk
				FROM ($data_query) table_data
				WHERE gender != 2
			)table_".$format_query."_gender_lk,";
			$query .= "
			(
				SELECT COUNT(1) AS total_".$format_query."_gender_pr
				FROM ($data_query) table_data
				WHERE gender = 2
			)table_".$format_query."_gender_pr,";
			$query .= "
			(
				SELECT COUNT(1) AS total_".$format_query."_usia_18
				FROM ($data_query) table_data
				WHERE usia <= 18
			)table_".$format_query."_usia_18,";

			$query .= "
			(
				SELECT COUNT(1) AS total_".$format_query."_usia_19
				FROM ($data_query) table_data
				WHERE usia > 18
			)table_".$format_query."_usia_19,";

			$current_date->addMonth();
		}
		$query = substr($query, 0,-1);
		$query.=";";

		$result = DB::connection('lab_pk')->select($query);
		$data = [];

		$new_end = $end->copy()->endOfYear();
		$current_date = $start->copy()->startOfYear();

		while($current_date <= $new_end)
		{
			$format_query = $current_date->startOfMonth()->format('Ym');
			$format_query = (int) $format_query;
			$data[$format_query]["gender_lk"] = 0;
			$data[$format_query]["gender_pr"] = 0;
			$data[$format_query]["usia_18"] = 0;
			$data[$format_query]["usia_19"] = 0;
			$current_date->addMonth();
		}


		foreach($result[0] as $index => $item)
		{
			$slugs = explode("_", $index);
			$date = $slugs[1];
			$type = $slugs[2]."_".$slugs[3];
			$data[$date][$type] = $item;
		}
		
		return $data;

	}
}
