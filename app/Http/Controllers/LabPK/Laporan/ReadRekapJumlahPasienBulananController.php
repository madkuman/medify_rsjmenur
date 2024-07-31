<?php

namespace App\Http\Controllers\LabPK\Laporan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\LabPK\TransaksiDetail;
use App\Models\Keuangan\TarifKategori;
use App\Models\Keuangan\TarifMaster;
use App\Models\Pasien\PembayaranPerusahaan;
use App\Models\Pasien\PembayaranPerusahaanType;

class ReadRekapJumlahPasienBulananController extends Controller
{
	public function get($start,$end)
	{
		$labpk = config('const.lab-pk');

		$tarif_kategori = TarifKategori::where('slug',$labpk)->pluck('id')->toArray();
		$tarif_ids = TarifMaster::whereIn('kategori_id',$tarif_kategori)->with('kategori')->get();
		$perusahaan = PembayaranPerusahaan::orderBy('type','asc')->get();
		$perusahaan_tipe = PembayaranPerusahaanType::with('perusahaan')->get();

		$data = [];

		foreach($tarif_ids as $tarif)
		{
			$total = 0;
			$data[$tarif->id][0] = $tarif->kategori->nama;
			$data[$tarif->id][1] = $tarif->deskripsi;
			$index = 2;
			foreach($perusahaan as $pt)
			{
				$transaksi = TransaksiDetail::where('status', 'done')
				->whereHas('transaksi', function($q) use($start,$end,$pt){
					$q->whereDate('verified_at', '>=', $start)->whereDate('verified_at', '<=', $end)
					->whereHas('pembayaran', function ($q2) use ($pt){
						$q2->from(config('app.db_name').'_patients.pasien_pembayaran')
						->where('perusahaan_id',$pt->id);
					});
				})
				->where('tarif_id',$tarif->id)
				->count();	

				$data[$tarif->id][$index++] = $transaksi;
				$total+=$transaksi;
			}
			$data[$tarif->id]['total'] = $total;
		}

		$return['perusahaan'] = $perusahaan;
		$return['perusahaan_tipe'] = $perusahaan_tipe;
		$return['data'] = $data;

		return $return;

	}
}
