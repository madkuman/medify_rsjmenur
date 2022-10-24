<?php

namespace App\Http\Controllers\Farmasi\Laporan\LaporanController;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Farmasi\StokLog;
use App\Models\Farmasi\ItemsKategori;
use App\Models\Farmasi\ItemsTemplate;
use App\Models\Farmasi\Farmasi;
use DB;

class LaporanStokEmergensiController extends Controller
{
    public function get($params){

		$date = $params['date'];
        $item_template_ids = $params['item_template_ids'];
        $farmasi_ids = $params['farmasi_ids'];
        $lokasi_ids = $params['lokasi_ids'];
        $sumber_dana_id = $params['sumber_dana_id'];
        $jenis_pembayaran_ids = $params['jenis_pembayaran_ids'];

        $date_start = Carbon::minValue();
        $date_end = $date->copy()->endOfDay()->format('Y-m-d H:i:s');
        $date_start = $date_start->copy()->endOfDay()->format('Y-m-d H:i:s');
        $farmasi_ids_implode =  implode(",", $farmasi_ids);

		$params_query['farmasi_ids_implode'] = $farmasi_ids_implode;
		$params_query['date_start'] = $date_start; 
		$params_query['date_end'] = $date_end;
		$params_query['item_template_ids'] = $item_template_ids;
		$params_query['lokasi_ids'] = implode(",",$lokasi_ids);
		$params_query['sumber_dana_id'] = $sumber_dana_id;
		$params_query['jenis_pembayaran_ids'] = $jenis_pembayaran_ids;

        $stok_log = app('App\Http\Controllers\Farmasi\Items\ReadController')->mutasiQueryItemsFarmasiWithNewFilter($params_query);

		$data = [];

		$farmasi = Farmasi::whereIn('id',$farmasi_ids)->get();
		foreach($stok_log as $log)
		{
			$index = $log->item_template_id;

			foreach($farmasi as $farmasi_item)
			{
				if(!isset($data[$index]['farmasi-'.$farmasi_item->id]))
				$data[$index]['farmasi-'.$farmasi_item->id] = 0;
			}
			if(isset($data[$log->item_template_id])){
                $data[$index]['obat'] = $log->nama;
                $data[$index]['harga'] = !empty($log->harga_saat_itu) ? $log->harga_saat_itu : $log->harga;
                $data[$index]['farmasi-'.$log->farmasi_id] += $log->stok_akhir;
            }else{
			    $data[$index]['obat'] = $log->nama;
			    $data[$index]['harga'] = !empty($log->harga_saat_itu) ? $log->harga_saat_itu : $log->harga;
			    $data[$index]['farmasi-'.$log->farmasi_id] = $log->stok_akhir;
            }

		}

		$data_conversion = [];
		foreach($data as $item)
		{
			$data_conversion[] = $item;
		}

		$return['data'] = $data_conversion;
		$return['farmasi'] = $farmasi;

		return $return;
	}
}
