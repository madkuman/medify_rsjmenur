<?php

namespace App\Http\Controllers\Radiology\Laporan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Radiology\TransactionDetail;
use App\Models\Keuangan\TarifKategori;
use App\Models\Keuangan\TarifMaster;

class ReadRekapHarianController extends Controller
{
    public function get($start,$end)
	{
		$layanan_array = config('const.layanan-array-4');
		$radiologi = config('const.radiologi');

		$tarif_kategori = TarifKategori::where('slug',$radiologi)->get();
		
		$data = [];

		foreach($tarif_kategori as $item_kategori)
		{
			$tarif_ids = TarifMaster::where('kategori_id',$item_kategori->id)->pluck('id')->toArray();

			foreach($layanan_array as $item_layanan)
			{
				$lokasi_id = app('App\Http\Controllers\Hospital\Lokasi\ReadController')->getLokasiByDepartemenSlug($item_layanan)->pluck('id')->toArray();

				$total = 0;
				$data[$item_kategori->id][0] = $item_kategori->nama;

				$transaksi = TransactionDetail::where('status', 'done')
				->whereIn('tarif_id',$tarif_ids)
				->whereHas('transaction', function($q) use($start,$end, $lokasi_id){
					$q->whereBetween('result_created_at', [$start,$end])
					->whereIn('lokasi_id',$lokasi_id);
				})
				->count();


				$data[$item_kategori->id][$item_layanan] = $transaksi;
				$total+=$transaksi;
			}

			$data[$item_kategori->id]['total'] = $total;
		}

		return $data;
	}
}
