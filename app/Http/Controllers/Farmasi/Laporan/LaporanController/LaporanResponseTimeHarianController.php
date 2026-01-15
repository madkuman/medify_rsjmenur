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

        $eager = [
            'pasien_detail',
            'analisa_resep_creator',
            'final_detail.resep_detail',
            'lokasi',
            'transaksi_obat_telaah_obat_penyiapan',
            'transaksi_obat_telaah_obat_pengemasan',
            'transaksi_obat_telaah_obat_penyerahan',
            'transaksi_obat_telaah_obat_penerimaan_perawat',
        ];
		$data = $transaksi->with($eager)->get();
		
		return $data;
	}
}
