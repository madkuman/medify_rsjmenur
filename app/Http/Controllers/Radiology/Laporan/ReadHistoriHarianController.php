<?php

namespace App\Http\Controllers\Radiology\Laporan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Radiology\TransactionDetail;
use App\Models\Keuangan\TarifKategori;
use App\Models\Keuangan\TarifMaster;

class ReadHistoriHarianController extends Controller
{
    public function get($start,$end)
	{
		$layanan_array = config('const.layanan-array-4');
		$radiologi = config('const.radiologi');

		
		$data = [];
	
		foreach($layanan_array as $item_layanan)
		{
			$lokasi_id = app('App\Http\Controllers\Hospital\Lokasi\ReadController')->getLokasiByDepartemenSlug($item_layanan)->pluck('id')->toArray();
			$data['lokasi_id'][$item_layanan] = $lokasi_id;
		}

		$data['transaksi'] = TransactionDetail::where('status', 'done')
		->whereHas('transaction', function($q) use($start,$end){
			$q->whereBetween('result_created_at', [$start,$end]);
		})->with('transaction.pasien','transaction.kasus','transaction.pembayaran.perusahaan','transaction.asal','transaction.creator','tarif')
		->get();

		return $data;
	}
}
