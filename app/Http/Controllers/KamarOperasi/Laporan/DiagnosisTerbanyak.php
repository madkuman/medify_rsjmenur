<?php

namespace App\Http\Controllers\KamarOperasi\Laporan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class DiagnosisTerbanyak extends Controller
{
	public function getData($tanggal_min,$tanggal_max)
	{
		$current_start_date = $tanggal_min->copy()->startOfDay();
		$count = 0;

		$date_init = $this->initTanggal($tanggal_min,$tanggal_max);
		$icd_top10_array = $this->getICD10TopArray($tanggal_min,$tanggal_max);
		$icd_top10 = $this->getICD10TopObject($tanggal_min,$tanggal_max);

		while($current_start_date < $tanggal_max)
		{
			$current_end_date = $current_start_date->copy()->endOfDay();
			$data_current_date = app('App\Http\Controllers\KamarOperasi\Laporan\ReadController')->getKasusTerbanyak($current_start_date,$current_end_date);
			
			if(!empty($data_current_date))
			{
				foreach($data_current_date as $item)
				{
					$obj = (object) $item;
					if(in_array($obj->icd_10_id, $icd_top10_array))
					{
						$icd_top10[$obj->icd_10_id]->tanggal[$count] = $obj->total;
					}
				}
			} 
			$current_start_date->addDay();
			$count++;
		}
		$data['tanggal'] = $date_init;
		$data['diagnosis'] = $icd_top10;
		return $data;
	}

	private function getICD10TopArray($tanggal_min,$tanggal_max)
	{
		$data_current_date = app('App\Http\Controllers\KamarOperasi\Laporan\ReadController')->getKasusTerbanyak($tanggal_min,$tanggal_max);
		
		$icd_top10 = [];
		foreach($data_current_date as $item)
		{
			$icd_top10[] = $item['icd_10_id'];
		}

		return $icd_top10;
	}

	private function getICD10TopObject($tanggal_min,$tanggal_max)
	{
		$data_current_date = app('App\Http\Controllers\KamarOperasi\Laporan\ReadController')->getKasusTerbanyak($tanggal_min,$tanggal_max);
		$date_init = $this->initArray($tanggal_min,$tanggal_max);
		$icd_top10 = [];
		foreach($data_current_date as $item)
		{
			$temp = new \StdClass();
			$temp->icd= $item['icd_10_id'];
			$temp->diagnosis= $item['diagnosis'];
			$temp->tanggal = $date_init;
			$temp->tanggal['total'] = $item['total'];
			$icd_top10[$temp->icd] = $temp;
		}

		return $icd_top10;
	}

	private function initArray($tanggal_min,$tanggal_max)
	{

		$current_start_date = $tanggal_min->copy()->startOfDay();
		$day = [];
		while($current_start_date < $tanggal_max)
		{
			$day[] = 0;
			//$day[] = $current_start_date->format('d/m/y');
			$current_start_date->addDay();

		}

		return $day;
	}

	private function initTanggal($tanggal_min,$tanggal_max)
	{

		$current_start_date = $tanggal_min->copy()->startOfDay();
		$day = [];
		while($current_start_date < $tanggal_max)
		{
			//$day[] = 0;
			$day[] = $current_start_date->format('d/m/y');
			$current_start_date->addDay();

		}

		return $day;
	}
}
