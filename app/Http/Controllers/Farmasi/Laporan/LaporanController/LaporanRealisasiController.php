<?php

namespace App\Http\Controllers\Farmasi\Laporan\LaporanController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Farmasi\Farmasi;

class LaporanRealisasiController extends Controller
{
    public function get($params)
    {
        $date_start_year_ago = $params['date_start_year_ago'];
        $date_end_year_ago = $params['date_end_year_ago'];
        $date_start = $params['date_start'];
        $date_end = $params['date_end'];
        $item_template_ids = $params['item_template_ids'];
        $farmasi_ids = $params['farmasi_ids'];
        $sumber_dana_id = $params['sumber_dana_id'];

        $date_end = $date_end->copy()->endOfDay()->format('Y-m-d H:i:s');
        $date_start = $date_start->copy()->startOfDay()->format('Y-m-d H:i:s');
        $farmasi_ids_implode =  implode(",", $farmasi_ids);

        $params_query['farmasi_ids_implode'] = $farmasi_ids_implode;
		$params_query['date_start'] = $date_start; 
		$params_query['date_end'] = $date_end;
		$params_query['date_start_year_ago'] = $date_start_year_ago;
		$params_query['date_end_year_ago'] = $date_end_year_ago;
		$params_query['item_template_ids'] = $item_template_ids;
		$params_query['sumber_dana_id'] = $sumber_dana_id;

        $stok_log = app('App\Http\Controllers\Farmasi\Items\ReadController')->mutasiQueryItemsFarmasiWithYearAgo($params_query);

        $data = [];

        // $farmasi = Farmasi::whereIn('id',$farmasi_ids)->get();
		foreach($stok_log as $log)
		{
			$index = $log->item_template_id;

			// foreach($farmasi as $farmasi_item)
			// {
			// 	if(!isset($data[$index]['farmasi-'.$farmasi_item->id]))
			// 	$data[$index]['farmasi-'.$farmasi_item->id] = 0;
			// }
			if(isset($data[$log->item_template_id])){
                $data[$index]['obat'] = $log->nama;
                $data[$index]['satuan'] = $log->satuan;
                $data[$index]['harga'] = !empty($log->harga_saat_itu) ? $log->harga_saat_itu : $log->harga;
                
                if (isset($data[$index]['stok'])) {
                    $data[$index]['stok'] += $log->stok_akhir;
                } else {
                    $data[$index]['stok'] = $log->stok_akhir;
                }

                if (isset($data[$index]['pengadaan'])) {
                    $data[$index]['pengadaan'] += $log->pengadaan;
                } else {
                    $data[$index]['pengadaan'] = $log->pengadaan;
                }

                if (isset($data[$index]['transaksi_real'])) {
                    $data[$index]['transaksi_real'] += $log->transaksi_real;
                } else {
                    $data[$index]['transaksi_real'] = $log->transaksi_real;
                }

                if (isset($data[$index]['pengadaan_ago'])) {
                    $data[$index]['pengadaan_ago'] += $log->pengadaan_ago;
                } else {
                    $data[$index]['pengadaan_ago'] = $log->pengadaan_ago;
                }
                
            }else{
			    $data[$index]['obat'] = $log->nama;
                $data[$index]['satuan'] = $log->satuan;
			    $data[$index]['harga'] = !empty($log->harga_saat_itu) ? $log->harga_saat_itu : $log->harga;
			    $data[$index]['stok'] = $log->stok_akhir;
                $data[$index]['pengadaan'] = $log->pengadaan;
                $data[$index]['transaksi_real'] = $log->transaksi_real;
                $data[$index]['pengadaan_ago'] = $log->pengadaan_ago;
            }

		}

        $data_conversion = [];
		foreach($data as $item)
		{
			$data_conversion[] = $item;
		}

		$return['data'] = $data_conversion;
		// $return['farmasi'] = $farmasi;

		return $return;
    }
}
