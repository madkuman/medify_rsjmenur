<?php

namespace App\Http\Controllers\Pasien\Laporan;

use App\Models\Hospital\MasterStatusPulang;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\Diagnosis;
use App\Models\Kasus\ICD10;
use App\Models\KamarJenazah\Permintaan;
use App\Models\Pasien\Pasien;

class KematianRSALController extends Controller
{
	public function get($start,$end)
	{
	    $meninggal = MasterStatusPulang::where('slug','meninggal')->first()->id;
		$kasus = Kasus::whereBetween('krs_at',[$start,$end])->where('krs_status',$meninggal)->orderBy('krs_at','asc')->with('pasien','admin.user')->get();
		$data = [];
		foreach($kasus as $item)
		{
			$pasien = Pasien::where('id',$item->pasien_id)->first();
			$temp = [];
			$temp['nama'] = $pasien->name ?? '-';
			$temp['no_rm'] = $pasien->no_rm ?? '-';
			$temp['usia'] = $pasien->age ?? '-';
			$temp['gender'] = $pasien->jenis_kelamin_lp ?? '-';
			$temp['alamat'] = $pasien->address ?? '-';
			$temp['mrs'] = $item->created_at->format('d-m-Y');
			$temp['krs'] = $item->krs_at->format('d-m-Y H:i');

			$dx = $this->getDiagnosa($item->id);

			$temp['diagnosa_masuk'] = $dx['masuk'];
			$temp['diagnosa_meninggal'] = $dx['meninggal'];
			$temp['keterangan'] = $dx['keterangan'];
			$temp['dpjp'] = $item->admin->user->name ?? '-';
			array_push($data, $temp);
		}
		$return['data'] = $data;
		return $return;
	}

	private function getDiagnosaICD($ids)
	{
		$icd = ICD10::whereIn('id',$ids)->get();
		return $icd;
	}

	private function getDiagnosaMasuk($kasus_id)
	{
		$diagnosa = Diagnosis::where('kasus_id',$kasus_id)->pluck('icd_10');
		$icd = $this->getDiagnosaICD($diagnosa);
		$items = $icd->pluck('long_desc')->toArray();
		$items = implode(", ",$items);
		return $items;
	}

	private function getDiagnosaMati($kasus_id)
	{
		$diagnosa = Diagnosis::where('kasus_id',$kasus_id)->pluck('icd_10');
		$icd = $this->getDiagnosaICD($diagnosa);
		$items = $icd->pluck('long_desc')->toArray();
		$items = implode(", ",$items);
		return $items;
	}

	private function getDiagnosaMasukICD($kasus_id)
	{
		$diagnosa = Diagnosis::where('kasus_id',$kasus_id)->pluck('icd_10');
		$icd = $this->getDiagnosaICD($diagnosa);
		$items = $icd->pluck('code_icd')->toArray();
		$items = implode(", ",$items);
		return $items;
	}

	private function getDiagnosa($kasus_id)
	{
		$diagnosa = Diagnosis::where('kasus_id',$kasus_id)->pluck('icd_10');
		$icd = ICD10::whereIn('id',$diagnosa)->get();
		$dx['masuk'] = $icd->pluck('long_desc')->toArray();
		$dx['keterangan'] = $icd->pluck('code_icd')->toArray();

		$diagnosa_utama = Diagnosis::where('kasus_id',$kasus_id)->where('utama',1)->pluck('icd_10');
		$icd = ICD10::whereIn('id',$diagnosa_utama)->get();
		$dx['meninggal'] = $icd->pluck('long_desc')->toArray();

		$dx['masuk'] = implode(", ",$dx['masuk']);
		$dx['keterangan'] = implode(", ",$dx['keterangan']);
		$dx['meninggal'] = implode(", ",$dx['meninggal']);
		return $dx;
	}
}
