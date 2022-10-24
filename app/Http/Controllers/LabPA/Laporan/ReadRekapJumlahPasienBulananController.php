<?php

namespace App\Http\Controllers\LabPA\Laporan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\LabPA\TransactionDetail;
use App\Models\Keuangan\TarifKategori;
use App\Models\Keuangan\TarifMaster;
use App\Models\Pasien\PembayaranPerusahaan;
use App\Models\Pasien\PembayaranPerusahaanType;

class ReadRekapJumlahPasienBulananController extends Controller
{
	public function get($start,$end)
	{
		$labpa = config('const.lab-pa');

		$tarif_kategori = TarifKategori::where('slug',$labpa)->get();
		$perusahaan = PembayaranPerusahaan::orderBy('type','asc')->get();
		$perusahaan_tipe = PembayaranPerusahaanType::with('perusahaan')->get();

		$data = [];

		foreach($tarif_kategori as $item_kategori)
		{
			$tarif_ids = TarifMaster::where('kategori_id',$item_kategori->id)->pluck('id')->toArray();
			$total = 0;
			foreach($perusahaan as $pt)
			{
				$data[$item_kategori->id][0] = $item_kategori->nama;
				$transaksi = TransactionDetail::where('status', 'done')
				->whereHas('transaction', function($q) use($start,$end,$pt){
					$q->whereDate('result_created_at', '>=', $start)->whereDate('result_created_at', '<=', $end)
					->whereHas('pembayaran', function ($q2) use ($pt){
						$q2->from(config('app.db_name').'_patients.pasien_pembayaran')
						->where('perusahaan_id',$pt->id);
					});
				})
				->whereIn('tarif_id',$tarif_ids)
				->count();	

				$data[$item_kategori->id][$pt->id] = $transaksi;
				$total+=$transaksi;
			}
			$data[$item_kategori->id]['total'] = $total;
		}

		$return['perusahaan'] = $perusahaan;
		$return['perusahaan_tipe'] = $perusahaan_tipe;
		$return['data'] = $data;

		return $return;

	}
}
