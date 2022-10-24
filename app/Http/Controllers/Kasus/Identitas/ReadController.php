<?php

namespace App\Http\Controllers\Kasus\Identitas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\Tindakan;
use App\Models\Kasus\Diagnosis;
use App\Models\Kasus\Identitas;
use App\Models\RawatInap\Transaksi;
use DB;

class ReadController extends Controller
{
	public function getMutuKetepatan($start, $end, $jenis)
	{
		$kasus = Kasus::whereBetween(DB::raw('DATE(created_at)'), array($start, $end));
		if($jenis == 'Cabut Gigi Salah')
			$kasus = $kasus->whereHas('tindakan_icd9.icd9', function($q){
				$q->whereIn('code_icd', ['23.1', '23.19']); 
			});
		else if($jenis == 'Trauma Bur Gigi')
			$kasus = $kasus->whereHas('tindakan_icd9.icd9', function($q){
				$q->whereIn('code_icd', ['23.2', '23.71']);
				});
		return $kasus->with('lokasi', 'pasien', 'identitas')->get();
	}

	public function getMutuCWD($start, $end)
	{
		$kasus_id = $this->getMutuTransaksiRanap($start, $end);
		$filtered_kasus_id = Tindakan::whereIn('kasus_id', $kasus_id)->whereHas('icd9', function($q){
							$q->whereIn('code_icd', ['20.41', '20.42', '19.52', '18.6']);
							})->get(['kasus_id'])->pluck('kasus_id');
		$kasus = Kasus::whereIn('id', $filtered_kasus_id);
		return $kasus->with('lokasi', 'pasien')->get();
	}

	public function getMutuLaring($start, $end)
	{
		$kasus_id = $this->getMutuTransaksiRanap($start, $end);
		$filtered_kasus_id = Tindakan::whereIn('kasus_id', $kasus_id)->whereHas('icd9', function($q){
							$q->whereIn('code_icd', ['30.01', '31.43', '30.09']);
							})->get(['kasus_id'])->pluck('kasus_id');
		$kasus = Kasus::whereIn('id', $filtered_kasus_id);
		return $kasus->with('lokasi', 'pasien')->get();
	}

	public function getMutuSeptoplasti($start, $end)
	{
		$kasus_id = $this->getMutuTransaksiRanap($start, $end);
		$filtered_kasus_id = Tindakan::whereIn('kasus_id', $kasus_id)->whereHas('icd9', function($q){
							$q->whereIn('code_icd', ['21.5', '21.88']);
							})->get(['kasus_id'])->pluck('kasus_id');
		$kasus = Kasus::whereIn('id', $filtered_kasus_id);
		return $kasus->with('lokasi', 'pasien')->get();
	}

	public function getMutuSinusitis($start, $end)
	{
		$kasus_id = $this->getMutuTransaksiRanap($start, $end);
		$filtered_kasus_id = Tindakan::whereIn('kasus_id', $kasus_id)->whereHas('icd9', function($q){
							$q->whereIn('code_icd', ['22.60', '22.63', '22.64']);
							})->get(['kasus_id'])->pluck('kasus_id');

		//AMBIL KASUS_ID YANG PUNYA DIAGNOSIS
		$filtered_diagnosis = Diagnosis::whereIn('kasus_id', $kasus_id)->whereHas('icd10', function($q){
								$q->where('code_icd', 'LIKE', '%J32.%');
							})->get(['kasus_id'])->pluck('kasus_id');
		$kasus = Kasus::whereIn('id', $filtered_kasus_id);
		return[
			'result' => $kasus->with('lokasi', 'pasien')->get(),
			'kasus_benar' => $filtered_diagnosis
		];
	}

	private function getMutuTransaksiRanap($start, $end)
	{
		$date_param = [$start, $end];
		$kasus_id = Transaksi::where(function($q) use(&$date_param){
						$q->whereBetween(DB::raw('DATE(kedatangan_at)'), $date_param)->whereBetween(DB::raw('DATE(waktu_keluar)'), $date_param);
					})->orWhere(function($q) use(&$date_param){
						$q->whereBetween(DB::raw('DATE(kedatangan_at)'), $date_param)->where(DB::raw('DATE(waktu_keluar)'), '>', $date_param[1]);
					})->orWhere(function($q) use(&$date_param){
						$q->whereBetween(DB::raw('DATE(waktu_keluar)'), $date_param)->where(DB::raw('DATE(kedatangan_at)'), '<', $date_param[0]);
					})->distinct()->get(['kasus_id'])->pluck('kasus_id');
		return $kasus_id;
	}
}