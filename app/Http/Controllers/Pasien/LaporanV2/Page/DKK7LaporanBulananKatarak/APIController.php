<?php

namespace App\Http\Controllers\Pasien\LaporanV2\Page\DKK7LaporanBulananKatarak;

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

		$kasus = Kasus::with([])
			->selectRaw('pasien_id')
			->join('diagnosis',function($query){
				$query->on('kasus.id','=','diagnosis.kasus_id')
					->whereNull('diagnosis.deleted_at');
			})
			->join('icd_10','diagnosis.icd_10','=','icd_10.id')
			->where(function($query){
				$query->where('icd_10.code_icd','like','%H25%')
				->orWhere('icd_10.code_icd','like','%H26%')
				->orWhere('icd_10.code_icd','like','%H27%')
				->orWhere('icd_10.code_icd','like','%H28%');
			})
			->whereBetween('kasus.created_at',[$start, $end])
			->groupBy('pasien_id')
			->get();

		return json_encode([
			'status' => 200,
			'data' => [
				'count' => $kasus->count(),
			],
		]);
	}

	public function getData(Request $request)
	{
		$start = Carbon::createFromFormat('d-m-Y', $request->datestart)->startOfDay();
		$end = Carbon::createFromFormat('d-m-Y', $request->dateend)->endOfDay();
		
		$_ = config('app.db_name');

		$kasus = Kasus::with('pasien')
			->selectRaw('kasus.pasien_id, group_concat(icd_10.code_icd separator ", ") as icd_10, count(pasca.id) as jumlah_operasi, max(pasca.tanggal_operasi) as tanggal_operasi')
			->join('diagnosis',function($query){
				$query->on('kasus.id','=','diagnosis.kasus_id')
					->whereNull('diagnosis.deleted_at');
			})
			->join('icd_10','diagnosis.icd_10','=','icd_10.id')
			->leftJoin($_.'_kamar_operasi.transaksi',function($query){
				$query->on('transaksi.kasus_id','=','kasus.id')
					->where('transaksi.status','=',1);
			})
			->leftJoin($_.'_kamar_operasi.pasca','transaksi.hasil_id','=','pasca.id')
			->where(function($query){
				$query->where('icd_10.code_icd','like','%H25%')
					->orWhere('icd_10.code_icd','like','%H26%')
					->orWhere('icd_10.code_icd','like','%H27%')
					->orWhere('icd_10.code_icd','like','%H28%');
			})
			->limit($this->row_per_load)
			->whereBetween('kasus.created_at',[$start, $end])
			->offset($this->row_per_load * ($request->page - 1))
			->groupBy('kasus.pasien_id')
			->get();

		$data = [];
		$no = 1 + ($this->row_per_load * ($request->page - 1));
		foreach($kasus as $item){
			if($item->pasien == null) continue;

			if($item->tanggal_operasi != '') $tanggal_operasi = Carbon::parse($item->tanggal_operasi);

			$data[] = [
				#harus urut sesuai di datatable :D
				$no++,
				$item->pasien->name ?? 'pasien tidak ditemukan',
				$item->pasien->no_identitas ?? '-',
				$item->pasien->alamat_detail ?? '-',
				$item->pasien->gender == 1 ? $item->pasien->getAgeYear($item->created_at) : '',
				$item->pasien->gender == 2 ? $item->pasien->getAgeYear($item->created_at) : '',
				$item->icd_10,
				$item->jumlah_operasi != 0 ? 'v' : '',
				$item->jumlah_operasi == 0 ? 'v' : '',
				isset($tanggal_operasi) ? $tanggal_operasi->format('d-m-Y') : '',
			];
		}

		return json_encode([
			'status' => 200,
			'data' => $data,
			'continue' => $this->row_per_load == count($data),
		]);
	}
}
