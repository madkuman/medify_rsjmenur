<?php

namespace App\Http\Controllers\Pasien\LaporanV2\Page\LaporanKunjunganUnitTindakan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\CPPT;
use App\Models\UnitTindakan\Transaksi;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class APIController extends Controller
{
    public function getTotalData(Request $request)
    {
		$select = ['id'];
		$total = $this->query($request, $select)->get()->count();

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
			'*',
		];
		$eiger = ['kasus','pasien'];

		$data = $this->query($request, $select, $eiger)
				->skip($data_fetched)
				->take($limit)
				->get();

		$array_data = [];
		foreach($data as $index => $item)
		{
			$new_item = new \StdClass();
			$new_item->no = $data_fetched + $index + 1;
			$new_item->nomor_kasus = $item->kasus->nomor_kasus ?? 'TANPA KASUS';
			$new_item->no_rm = $item->kasus->pasien->no_rm ?? ($item->pasien->no_rm ?? '');
			$new_item->pasien = $item->kasus->pasien->name ?? ($item->pasien->name ?? '');
			$new_item->jenis_kelamin = $item->kasus->pasien->jenis_kelamin ?? ($item->pasien->jenis_kelamin ?? '');
			$new_item->usia = $item->kasus->pasien->age ?? ($item->pasien->age ?? '');
			$new_item->tgl_pemeriksaan = !empty($item->created_at) ? date('d-m-Y', strtotime($item->created_at)) : '';
			$new_item->dpjp = $item->kasus->dpjp->user->name ?? '';
			$new_item->diagnosa = ($item->kasus->diagnosisUtama->icd10->icd10 ?? '') .' - '.  ($item->kasus->diagnosisUtama->icd10->long_desc ?? '');
			$new_item->lokasi = $item->kasus->lokasi->lokasi->nama ?? '';
			
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
		$unit_tindakan = $request->unit_tindakan;

		if(!empty($unit_tindakan)){
			$unit_tindakan = explode(",", $unit_tindakan);
		}

		$query = Transaksi::with($eiger)
					->select($select)
					->whereBetween('created_at',[$start,$end])
					->when(!empty($unit_tindakan), function($q) use ($unit_tindakan){
						$q->whereIn('unit_tindakan_id', $unit_tindakan);
					})
					->orderby('created_at', 'desc');
		return $query;
	}
}
