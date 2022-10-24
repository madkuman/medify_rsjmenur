<?php

namespace App\Http\Controllers\Pasien\LaporanV2\Page\DKK18LaporanBulananPelayananGeriatri;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Pasien\Pasien;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class APIController extends Controller
{
	protected $row_per_load = 2;

	public function getTotalData(Request $request)
	{
		$start = Carbon::createFromFormat('d-m-Y', $request->datestart)->startOfDay();
		$end = Carbon::createFromFormat('d-m-Y', $request->dateend)->endOfDay();

		$_ = config('app.db_name');
		$total = Pasien::selectRaw('count(distinct pasien.id) as count')
			->join($_ . '_kasus.kasus', 'pasien.id', '=', 'kasus.pasien_id')
			->whereBetween('kasus.created_at', [$start, $end])
			->where(DB::raw("TIMESTAMPDIFF(YEAR, pasien.date_of_birth, CURDATE())"), '>=', 60)
			->get()
			->first()
			->count;

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

		$pasien = Pasien::with([])
			->selectRaw('pasien.*')
			->join($_ . '_kasus.kasus', 'pasien.id', '=', 'kasus.pasien_id')
			->whereBetween('kasus.created_at', [$start, $end])
			->where(DB::raw("TIMESTAMPDIFF(YEAR, pasien.date_of_birth, CURDATE())"), '>=', 60)
			->limit($this->row_per_load)
			->offset($this->row_per_load * ($request->page - 1))
			->groupBy('pasien.id')
			->get();

		$no = 1 + ($this->row_per_load * ($request->page - 1));
		$data = [];
		foreach($pasien as $pasien_item){
			$item = [];

			$item[] = $no++;
			$item[] = $pasien_item->name;
			$item[] = $pasien_item->gender == 1 ? 'v' : '';
			$item[] = $pasien_item->gender == 2 ? 'v' : '';
			$item[] = $pasien_item->age;
			$item[] = $pasien_item->no_identitas;
			$item[] = $pasien_item->alamat_detail;

			$data[] = $item;
		}

		$next_index = $request->current_index + 1;
		return json_encode([
			'status' => 200,
			'data' => $data,
			'continue' => $this->row_per_load == count($data),
		]);
	}
}
