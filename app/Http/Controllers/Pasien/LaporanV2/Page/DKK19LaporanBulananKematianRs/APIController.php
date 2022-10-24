<?php

namespace App\Http\Controllers\Pasien\LaporanV2\Page\DKK19LaporanBulananKematianRs;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use Carbon\Carbon;

class APIController extends Controller
{
	protected $row_per_load = 2;

	public function getTotalData(Request $request)
	{
		$start = Carbon::createFromFormat('d-m-Y', $request->datestart)->startOfDay();
		$end = Carbon::createFromFormat('d-m-Y', $request->dateend)->endOfDay();

		$total = Kasus::with([])
			->whereBetween('kasus.created_at',[$start, $end])
			->where('kasus.krs_status',3)->count();

		return json_encode([
			'status' => 200,
			'data' => [
				'count' => $total,
			],
		]);
	}

	public function getData(Request $request)
	{
		$start = Carbon::createFromFormat('d-m-Y', $request->datestart)->startOfDay();
		$end = Carbon::createFromFormat('d-m-Y', $request->dateend)->endOfDay();

		$_ = config('app.db_name');

		$kasus = Kasus::with('pasien')
			->selectRaw('kasus.*')
			->whereBetween('kasus.created_at',[$start, $end])
			->where('kasus.krs_status',3)
			->limit($this->row_per_load)
			->offset($this->row_per_load * ($request->page - 1))
			->get();

		$data = [];
		$no = 1 + ($this->row_per_load * ($request->page - 1));
 		foreach($kasus as $kasus_item){
			if($kasus_item->pasien == null) continue;
			$item = [];
			$item[] = $no++;
			$item[] = $kasus_item->pasien->name ?? '-';
			$item[] = $kasus_item->pasien->no_identitas ?? '-';
			$item[] = $kasus_item->pasien->no_rm ?? '-';
			$item[] = ($kasus_item->pasien->gender ?? 0) == 1 ? ($kasus_item->pasien->age) : '';
			$item[] = ($kasus_item->pasien->gender ?? 0) == 2 ? ($kasus_item->pasien->age) : '';
			$item[] = $kasus_item->attr_mrs_at->format('Y-m-d H:i:s') ?? '-';
			$item[] = $kasus_item->diagnosisUtama->icd10->code_icd ?? '-';
			$item[] = $kasus_item->diagnosisUtama->icd10->long_desc ?? '-';
			$item[] = $kasus_item->diagnosisUtama->icd10->long_desc ?? '-';
			$item[] = $kasus_item->pasien->death_at ?? '-';
			$data[] = $item;
		 }

		return json_encode([
			'status' => 200,
			'data' => $data,
			'continue' => $this->row_per_load == count($data),
		]);
	}
}
