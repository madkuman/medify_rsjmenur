<?php

namespace App\Http\Controllers\Pasien\Laporan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RawatJalan\Transaksi;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\Diagnosis;
use App\Models\Kasus\ICD10;
use DB;

class SepuluhBesarRawatJalanDiagnosaICDController extends Controller
{
	public function get($start,$end)
	{
		$transaksi = Transaksi::whereBetween('waktu_masuk',[$start,$end])->whereNotNull('waktu_pemeriksaan')->whereNotNull('kasus_id')->get();
		$transaksi_kasus_id = $transaksi->pluck('kasus_id');

		$kasus = Kasus::whereIn('id',$transaksi_kasus_id)->pluck('id');

		$diagnosis = Diagnosis::whereIn('kasus_id',$transaksi_kasus_id)
		->select('icd_10', DB::raw('count(*) as total'))
		->groupBy('icd_10')
		->orderBy('total','desc')->take(10)
		->get();

		foreach($diagnosis as $item)
		{
			$temp = ICD10::find($item->icd_10);
			$item->kode_icd = $temp->code_icd;
			$item->deskripsi = $temp->long_desc;
			$item->total_pr = $this->getGenderTotal($transaksi_kasus_id, $item->icd_10,'P');
			$item->total_lk = $this->getGenderTotal($transaksi_kasus_id, $item->icd_10,'L');
		}

		return $diagnosis;
	}

	private function getGenderTotal($transaksi_kasus_id,$icd_10,$jk)
	{
		$count = Diagnosis::whereIn('kasus_id',$transaksi_kasus_id)
		->where('icd_10',$icd_10)
		->whereHas('kasus',function ($q) use ($jk){
			$q->whereHas('identitas',function($q2) use ($jk){
				$q2->where('jenis_kelamin',$jk);
			});
		})->count();
		return $count;
	}
}
