<?php

namespace App\Http\Controllers\LabPK\Laporan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\LabPK\TransaksiDetail;
use App\Models\Keuangan\TarifKategori;
use App\Models\Keuangan\TarifMaster;

class ReadLaporanPemeriksaanLaboratoriumController extends Controller
{
	public function get($start,$end)
	{
		$labpk = config('const.lab-pk');

		$tarif_kategori = TarifKategori::where('slug',$labpk)->pluck('id')->toArray();
		$tarif_ids = TarifMaster::whereIn('kategori_id',$tarif_kategori)->with('kategori')->get();

		$data = [];

		$last_kategori = '';
		$count_kategori = 1;
		$count_tarif = 1;
		foreach($tarif_ids as $tarif)
		{
			$current_kategori = $tarif->kategori->id;

			if($current_kategori != $last_kategori)
			{

				$temp = [];
				$temp['no'] = '';
				$temp['nama'] = '';
				$temp['sederhana'] = '';
				$temp['sedang'] = '';
				$temp['canggih'] = '';
				$temp['total'] = '';
				$data[] = $temp;

				$last_kategori = $current_kategori;
				$temp = [];
				$temp['no'] = $count_kategori++;
				$temp['nama'] = $tarif->kategori->nama;
				$temp['sederhana'] = '';
				$temp['sedang'] = '';
				$temp['canggih'] = '';
				$temp['total'] = '';
				$data[] = $temp;
				$count_tarif = 1;
			}


			$temp = [];
			$temp['no'] = excel_column($count_tarif++);
			$temp['nama'] = $tarif->deskripsi;
			$temp['sederhana'] = 0;
			$temp['sedang'] = 0;
			$temp['canggih'] = 0;


			$total = 0;
			
			$transaksi = TransaksiDetail::where('transaksi_detail.status', 'done')
			->leftJoin('transaksi','transaksi.id','=','transaksi_detail.transaksi_id')
			->whereDate('transaksi.verified_at', '>=', $start)
			->whereDate('transaksi.verified_at', '<=', $end)
			->where('transaksi_detail.tarif_id',$tarif->id)
			->count();	

			$total = $transaksi;

			if($tarif->slug == 'lab-pk-sederhana') $temp['sederhana'] = $total;
			elseif($tarif->slug == 'lab-pk-canggih') $temp['canggih'] = $total;
			elseif($tarif->slug == 'lab-pk-sedang') $temp['sedang'] = $total;

			$temp['total'] = $temp['sederhana'] + $temp['sedang'] + $temp['canggih'];

			$data[] = $temp;
		}
		return $data;

	}
}
