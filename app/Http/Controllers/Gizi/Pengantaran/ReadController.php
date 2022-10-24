<?php

namespace App\Http\Controllers\Gizi\Pengantaran;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Gizi\Pemesanan;
use App\Models\Gizi\PemesananDetail;
use App\Models\RawatInap\Bangsal;
use App\Models\RawatInap\Ruangan;

class ReadController extends Controller
{
	public function getPemesanan($start,$end,$waktu)
	{
		$data = [];
		$count = [];
		$query = PemesananDetail::with(['pengantar'])->whereBetween('untuk_tanggal',[$start,$end])
				->where('waktu_makan_id',$waktu)
				->get();
		foreach($query as $item)
		{
			if(empty($data[$item->pemesanan_id]))
			{
				$count[$item->pemesanan_id] = 0;
				$data[$item->pemesanan_id]['pemesanan'] = Pemesanan::with(['lokasi','pasien'])->where('id',$item->pemesanan_id)->first();
				$data[$item->pemesanan_id][$count[$item->pemesanan_id]] = $item;
			}
			else
			{
				$count[$item->pemesanan_id]++;
				$data[$item->pemesanan_id][$count[$item->pemesanan_id]] = $item;	
			}
			 
		}
		return $data;
	}

	public function getBangsal()
	{
		$data = Bangsal::all();
		return $data;
	}

	public function getPemesananLokasi($start,$end,$waktu,$lokasi)
	{
		$bangsal = Bangsal::where('id',$lokasi)->first();
		$ruangan = Ruangan::where('bangsal_id',$bangsal->id)->pluck('lokasi_id');
		//dd($ruangan);
		$data = [];
		$count = [];
		//$pemesanan = Pemesanan::whereIn('lokasi_id',$ruangan)
		$query = PemesananDetail::whereHas('pemesanan', function ($q) use (&$ruangan){
					$q->whereIn('lokasi_id',$ruangan);
					//dd($ruangan);
				})
				->where('waktu_makan_id',$waktu)
				->whereBetween('untuk_tanggal',[$start,$end])
				->get();
		//dd($ruangan);
		foreach($query as $item)
		{
			if(empty($data[$item->pemesanan_id]))
			{
				$count[$item->pemesanan_id] = 0;
				$data[$item->pemesanan_id]['pemesanan'] = Pemesanan::where('id',$item->pemesanan_id)->first();
				$data[$item->pemesanan_id][$count[$item->pemesanan_id]] = $item;
			}
			else
			{
				$count[$item->pemesanan_id]++;
				$data[$item->pemesanan_id][$count[$item->pemesanan_id]] = $item;	
			}
			 
		}
		return $data;
	}	
}