<?php

namespace App\Http\Controllers\Farmasi\Laporan\LaporanController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Models\Farmasi\Farmasi;
use App\Models\Farmasi\TransaksiObat;
use DB;

class LaporanResponseTimeHarianController extends Controller
{
	public function get($date_start,$date_end,$farmasi_ids,$lokasi_ids,$jenis_resep)
	{
		$transaksi = TransaksiObat::whereIn('farmasi_id',$farmasi_ids)->whereIn('lokasi_id',$lokasi_ids)->whereBetween('created_at',[$date_start,$date_end])->whereNotNull('paid_at');
		
		if($jenis_resep == 'racikan')
			$transaksi = $transaksi->whereHas('final_detail', function($fin){
                $fin->whereHas('resep_detail', function($res){
                    $res->where('tipe',1);
                });
            });
		elseif($jenis_resep == 'non-racikan')
            $transaksi = $transaksi->whereHas('final_detail', function($fin){
                $fin->whereDoesntHave('resep_detail', function($res){
                    $res->where('tipe',1);
                });
            });

		$data = $transaksi->with('pasien_detail','final_detail.resep_detail','lokasi')->get();
		
		return $data;
	}
}
