<?php

namespace App\Http\Controllers\CSSD\Laporan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CSSD\AlkesSatuanLog;
use App\Models\CSSD\AlkesSatuan;
use App\Models\CSSD\Alkes;

class RekapPenggunaanAlatController extends Controller
{
	public function getData($tanggal_min,$tanggal_max)
	{
		$alkes = Alkes::all();

		$data = [];
		$tanggal = [];

		$j = 0;
		foreach($alkes as $item)
		{
			$alkes_id = $item->id;
			$current_date = $tanggal_min->copy();
			$count = 0;
			while($current_date<$tanggal_max)
			{
				$temp = $current_date->copy();
				$temp_start = $temp->copy()->startOfDay();
				$temp_end = $temp->copy()->endOfDay();
				//$alkes_satuan_id = AlkesSatuan::where('alkes_id',$alkes_id)->pluck('id')->toArray();
				//$item = AlkesSatuanLog::whereIn('alkes_satuan_id',$alkes_satuan_id)->whereBetween('created_at',[$temp_start,$temp_end])->get();
				

				$item = AlkesSatuanLog::whereBetween('created_at',[$temp_start,$temp_end])
				->whereHas('alkes_satuan',function($q) use ($alkes_id){
					$q->where('item_template_id',$alkes_id);
				})->count();
				$data[$alkes_id][$count++] = $item;
				if($j == 0 ) $tanggal[] = $temp->format('d/m');
				$current_date->addDay();
			}
			$j++;
		}
		$return['alkes'] = $alkes;
		$return['alkes_jumlah'] = $data;
		$return['tanggal'] = $tanggal;

		return $return;
	}
}
