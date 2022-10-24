<?php

namespace App\Http\Controllers\Pasien\Laporan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RawatJalan\Poliklinik;
use App\Models\RawatJalan\Transaksi;

class DataPendukungRekapLaporanKunjunganRawatJalanController extends Controller
{
	public function get($start,$end)
	{
		$poliklinik = Poliklinik::all();
		foreach($poliklinik as $item)
		{
			$all = new \StdClass();
			$all->total_baru_pria = $this->getTransaksi($start,$end,$item->id,1,[1],0);
			$all->total_baru_wanita = $this->getTransaksi($start,$end,$item->id,1,[2],0);
			$all->total_baru = $this->getTransaksi($start,$end,$item->id,1,[1,2],0);

			$all->total_lama_pria = $this->getTransaksi($start,$end,$item->id,0,[1],0);
			$all->total_lama_wanita = $this->getTransaksi($start,$end,$item->id,0,[2],0);
			$all->total_lama = $this->getTransaksi($start,$end,$item->id,0,[1,2],0);

			$all->total_pria = $this->getTransaksi($start,$end,$item->id,2,[1],0);
			$all->total_wanita = $this->getTransaksi($start,$end,$item->id,2,[2],0);
			$all->total = $this->getTransaksi($start,$end,$item->id,2,[1,2],0);
			$item->all = $all;

			$rujukan = new \StdClass();
			$rujukan->total_baru_pria = $this->getTransaksi($start,$end,$item->id,1,[1],[1]);
			$rujukan->total_baru_wanita = $this->getTransaksi($start,$end,$item->id,1,[2],[1]);
			$rujukan->total_baru = $this->getTransaksi($start,$end,$item->id,1,[1,2],[1]);

			$rujukan->total_lama_pria = $this->getTransaksi($start,$end,$item->id,0,[1],[1]);
			$rujukan->total_lama_wanita = $this->getTransaksi($start,$end,$item->id,0,[2],[1]);
			$rujukan->total_lama = $this->getTransaksi($start,$end,$item->id,0,[1,2],[1]);

			$rujukan->total_pria = $this->getTransaksi($start,$end,$item->id,2,[1],[1]);
			$rujukan->total_wanita = $this->getTransaksi($start,$end,$item->id,2,[2],[1]);
			$rujukan->total = $this->getTransaksi($start,$end,$item->id,2,[1,2],[1]);
			$item->rujukan = $rujukan;

		}
		return $poliklinik;
	}

	private function getTransaksi($start,$end,$poliklinik_id,$is_baru,$jenis_kelamin,$rujukan_type)
	{
		$transaksi = Transaksi::whereBetween('waktu_masuk',[$start,$end])->whereNotNull('waktu_pemeriksaan')->where('poliklinik_id',$poliklinik_id);

		if($is_baru == 1)
		{
			$transaksi->where('is_pasien_baru',1);
		}
		elseif($is_baru == 0)
		{
			$transaksi->where(function ($q){
				$q->where('is_pasien_baru',0)->orWhereNull('is_pasien_baru');
			});
		}
		
		$transaksi->whereHas('pasien_detail',function ($q) use ($jenis_kelamin){
			$q->from(config('app.db_name').'_patients.pasien')->whereIn('gender',$jenis_kelamin);
		});

		if($rujukan_type != 0)
		{
			$transaksi = $transaksi->whereHas('permintaan_rujuk',function($q) use ($rujukan_type){
				$q->from(config('app.db_name').'_rawat_jalan.permintaan_rujuk')->whereIn('type',$rujukan_type);
			})->count();
		}
		else
		{
			$transaksi = $transaksi->count();
		}

		return $transaksi;
	}
}
