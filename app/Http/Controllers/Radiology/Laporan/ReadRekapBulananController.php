<?php

namespace App\Http\Controllers\Radiology\Laporan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Radiology\TransactionDetail;
use App\Models\Keuangan\TarifKategori;
use App\Models\Keuangan\TarifMaster;
use DB;

class ReadRekapBulananController extends Controller
{
	public function get($start,$end,$layanan)
	{
		if($layanan == 'all') $lokasi_id = app('App\Http\Controllers\Hospital\Lokasi\ReadController')->getLokasi();
		else
			$lokasi_id = app('App\Http\Controllers\Hospital\Lokasi\ReadController')->getLokasiByDepartemenSlug($layanan);

		$lokasi_id = $lokasi_id->pluck('id')->toArray();

		$radiologi = config('const.radiologi');

		$tarif_kategori = TarifKategori::where('slug',$radiologi)->get();

		$data = [];

		foreach($tarif_kategori as $item_kategori)
		{
			$current = $start->copy();
			$total = 0;
			$data[$item_kategori->id][0] = $item_kategori->nama;
			$tarif_ids = TarifMaster::where('kategori_id',$item_kategori->id)->pluck('id')->toArray();
			while($current < $end)
			{
				$transaksi = TransactionDetail::where('status', 'done')
				->whereHas('transaction', function($q) use($current, $lokasi_id){
					$q->whereDate('result_created_at', $current)
					->whereIn('lokasi_id',$lokasi_id);
				})
				->whereIn('tarif_id',$tarif_ids)
				->count();	
				$day = (int) $current->format('d');
				$data[$item_kategori->id][$day] = $transaksi;

				$current->addDay();
				$total+=$transaksi;
			}

			$data[$item_kategori->id]['total'] = $total;
		}

		return $data;

	}
}
