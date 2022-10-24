<?php

namespace App\Http\Controllers\Farmasi\Laporan\LaporanController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Farmasi\StokLog;
use App\Models\Farmasi\ItemsKategori;
use App\Models\Farmasi\Farmasi;
use DB;

class LaporanPenggunaanBarangController extends Controller
{
	public function get($date_start,$date_end,$item_template_ids,$farmasi_ids){
		$date_start->copy()->startOfDay()->format('Y-m-d H:i:s');
		$date_end->copy()->endOfDay()->format('Y-m-d H:i:s');

        $farmasi_ids_implode =  implode(",", $farmasi_ids);


		$data = [];

		$farmasi = Farmasi::whereIn('id',$farmasi_ids)->get();
		foreach($farmasi as $far)
		{
			$data[$far->id]['nama'] = $far->nama;
			$current_date = $date_start->copy();
			while($current_date <= $date_end)
			{
				$tahun = $current_date->copy()->format('Y');
				$bulan = (int) $current_date->copy()->format('m');
				$data[$far->id][$tahun.'-'.$bulan] = 0;
				$current_date->addMonth();
			}
		}

        $stok_log = app('App\Http\Controllers\Farmasi\Items\ReadController')->penggunaanBarang($farmasi_ids_implode,$date_start,$date_end,$item_template_ids);
		$count = 1;
		foreach($stok_log as $log)
		{
		    if(isset($data[$log->farmasi_id][$log->tanggal])){
			    $data[$log->farmasi_id][$log->tanggal] += $log->total_biaya;
            }
		}

		$return['data'] = $data;
		$return['farmasi'] = $farmasi;

		return $return;
	}
}
