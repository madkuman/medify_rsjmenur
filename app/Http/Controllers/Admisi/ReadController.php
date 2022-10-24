<?php

namespace App\Http\Controllers\Admisi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\IGD\Transaksi as IGDTransaksi;
use App\Models\RawatInap\Transaksi as RawatInapTransaksi;
use App\Models\RawatJalan\Transaksi as RawatJalanTransaksi;
use App\Models\Kasus\Diagnosis;
use Carbon\Carbon;
use DB;

class ReadController extends Controller
{
	public function getSepuluhBesarPenyakit($layanan, $start, $end)
	{
		if ($layanan == 1) {
			$list_kasus = IGDTransaksi::where(function($q) use ($start, $end) {
								$q->where('waktu_masuk', '>=', $start)->where('waktu_keluar', '<=', $end);
							})->orWhere(function($q) use ($start, $end) {
								$q->where('waktu_masuk', '>=', $start)->whereNull('waktu_keluar');
							})
							->pluck('kasus_id')->toArray();
		} else if ($layanan == 2) {
			$list_kasus = RawatJalanTransaksi::where(function($q) use ($start, $end) {
								$q->where('waktu_masuk', '>=', $start)->where('waktu_keluar', '<=', $end);
							})->orWhere(function($q) use ($start, $end) {
								$q->where('waktu_masuk', '>=', $start)->whereNull('waktu_keluar');
							})
							->pluck('kasus_id')->toArray();
		} else {
			$list_kasus = RawatInapTransaksi::where(function($q) use ($start, $end) {
								$q->where('waktu_masuk', '>=', $start)->where('waktu_keluar', '<=', $end);
							})->orWhere(function($q) use ($start, $end) {
								$q->where('waktu_masuk', '>=', $start)->whereNull('waktu_keluar');
							})
							->pluck('kasus_id')->toArray();
		}
		
		$query = Diagnosis::whereIn('kasus_id', $list_kasus)
				->groupBy('icd_10')
				->orderBy(DB::raw('count(*)'), 'DESC')
				->with('icd10')
				->get(array(
                	'id', 'icd_10',
                	DB::raw('COUNT(*) as "kasus_count"')
                ));

		for ($i=0; $i < 10; $i++) 
		{ 
			if(!empty($query[$i])) $data[$i]=$query[$i];
			else $data[$i]=[];
		}

		return $data;
	}
}
