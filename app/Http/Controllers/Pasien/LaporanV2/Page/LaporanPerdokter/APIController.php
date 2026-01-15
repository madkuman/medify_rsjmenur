<?php

namespace App\Http\Controllers\Pasien\LaporanV2\Page\LaporanPerdokter;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\CPPT;
use App\Models\Kasus\Kasus;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class APIController extends Controller
{
    public function getTotalData(Request $request)
    {
		$select = [
			'cppt.id',
			DB::raw("
				CASE
					WHEN kasus.tipe_ri = 1 THEN 'ranap'
					WHEN kasus.tipe_rj = 1 and kasus.tipe_ri= 0 THEN 'rajal'
					WHEN kasus.tipe_igd = 1 and kasus.tipe_ri= 0 THEN 'igd'
					ELSE 'tanpa kasus' 
				END
				as tipe_kasus
			"),
		];
		$total = $this->query($request, $select)
					->get()->count();

		return json_encode([
			'status' => 200,
			'data' => $total
		]);
    }

    public function getData(Request $request)
    {
		$data_fetched = $request->datafetched;
		$limit = $request->limit;

		$select = [
			'cppt.created_by',
			'cppt.created_at',
			'cppt.kasus_id',
			'kasus.krs_at',
			DB::raw("
				CASE
					WHEN kasus.tipe_mc = 1 THEN 'MCU'
					WHEN kasus.tipe_ri = 1 THEN 'Rawat Inap'
					WHEN kasus.tipe_rj = 1 and kasus.tipe_ri= 0 THEN 'Rawat Jalan'
					WHEN kasus.tipe_igd = 1 and kasus.tipe_ri= 0 THEN 'IGD'
					ELSE 'TANPA KASUS' 
				END
				as tipe_kasus
			"),
		];

		$eiger = ['creator','kasus'];

		$data = $this->query($request, $select, $eiger)
				->skip($data_fetched)
				->take($limit)
				->orderBy('cppt.created_by')
				->get();

		$array_data = [];
		foreach($data as $index => $item)
		{
			$new_item = new \StdClass();
			$new_item->no = $data_fetched + $index + 1;
			$new_item->dokter = $item->creator->name ?? '-';
			$new_item->pasien = $item->kasus->pasien->name ?? '';
			$new_item->asuransi = $item->kasus->pembayaran->perusahaan->nama ?? '';
			$new_item->dept = $item->tipe_kasus ?? 'Tanpa Kasus';
			$new_item->lokasi = $item->kasus->lokasi->lokasi->nama ?? '';
			$new_item->tgl_cppt = !empty($item->created_at) ? date('d-m-Y', strtotime($item->created_at)) : '';
			
			$array_data[] = $new_item;
		}

		return json_encode([
			'status' => 200,
			'data' => $array_data
		]);

    }

	function query($request, $select, $eiger = []){
		$start = Carbon::createFromFormat('d-m-Y', $request->datestart)->startOfDay();
		$end = Carbon::createFromFormat('d-m-Y', $request->dateend)->endOfDay();
		$perusahaan_tipe = $request->perusahaan_tipe;

		if(!empty($perusahaan_tipe)){
			$perusahaan_tipe = explode(",", $perusahaan_tipe);
		}

		$query = CPPT::with($eiger)
					->select($select)
					->whereHas('creator', function ($q) {
						$q->from(config('app.db_name') . '.users')
							->where('profesi', 1);
					})
					->join(config('app.db_name').'_kasus.kasus','kasus.id','cppt.kasus_id')
					->whereBetween('kasus.krs_at',[$start,$end])
					->whereNull('cppt.deleted_at')
					// ->whereNull('kasus.deleted_at')
					->when(!empty($perusahaan_tipe), function($q) use ($perusahaan_tipe){
						$q->whereHas('kasus', function($q2) use ($perusahaan_tipe){
							$q2->from(config('app.db_name').'_kasus.kasus')
								->whereHas('pembayaran', function($q2) use ($perusahaan_tipe) {
									$q2->from(config('app.db_name').'_patients.pasien_pembayaran')
										->whereHas('perusahaan',function($q3) use ($perusahaan_tipe) {
											$q3->from(config('app.db_name').'_patients.pembayaran_perusahaan')
												->whereHas('tipe',function($q4) use ($perusahaan_tipe){
													$q4->from(config('app.db_name').'_patients.pembayaran_perusahaan_tipe')
														->whereIn('pembayaran_perusahaan_tipe.slug', $perusahaan_tipe); 
														/* pakai flag_tipe karena di db slug ada yang null */
									});
								});
							});
						});
					});

		return $query;
	}
}
