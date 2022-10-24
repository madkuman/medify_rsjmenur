<?php

namespace App\Http\Controllers\Pasien\LaporanV2\Page\DKK5LaporanKunjunganRawatJalanPenderitaBaruLamaP2ptmKeswa;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RawatJalan\Transaksi;
use Carbon\Carbon;

class APIController extends Controller
{
	protected $row_per_load = 2;

	public function getTotalData(Request $request)
	{
		$start = Carbon::createFromFormat('d-m-Y', $request->datestart)->startOfDay();
		$end = Carbon::createFromFormat('d-m-Y', $request->dateend)->endOfDay();

		$_ = config('app.db_name');
		$total = Transaksi::selectRaw('count(transaksi.id) as count')
			->whereBetween('transaksi.waktu_masuk', [$start, $end])
			->where('status','>=','1') #selesai
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


		$transaksi = Transaksi::with('pasien','kasus.diagnosisUtama.icd10')
			->whereBetween('transaksi.waktu_masuk', [$start, $end])
			->where('status','>=','1') #selesai
			->limit($this->row_per_load)
			->offset($this->row_per_load * ($request->page - 1))
			->get();

		$no = 1 + ($this->row_per_load * ($request->page - 1));
		$data = [];
		foreach($transaksi as $transaksi_item){
			$item = [];

			$item[] = $no++;
			$item[] = $transaksi_item->pasien->name ?? '-';
			$item[] = $transaksi_item->pasien->no_identitas ?? '-';
			$item[] = ($transaksi_item->pasien->gender ?? 0) == 1 ? 'L' : 'P';
			$item[] = $transaksi_item->pasien->alamat_detail ?? '-';
			$item[] = $transaksi_item->pasien != null ? Carbon::parse($transaksi_item->pasien->date_of_birth)->format('d/m/Y') : '-';
			$item[] = $transaksi_item->is_pasien_baru == 1 ? 'v' : '';
			$item[] = $transaksi_item->is_pasien_baru == 1 ? '' : 'v';
			$item[] = $transaksi_item->kasus->diagnosisUtama->icd10->code_icd ?? '';
			$item[] = $transaksi_item->kasus->diagnosisUtama->icd10->long_desc ?? '';

			$data[] = $item;
		}

		return json_encode([
			'status' => 200,
			'data' => $data,
			'continue' => $this->row_per_load == count($data),
		]);
	}
}
