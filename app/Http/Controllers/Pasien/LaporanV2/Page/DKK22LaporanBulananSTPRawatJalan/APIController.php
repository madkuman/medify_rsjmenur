<?php

namespace App\Http\Controllers\Pasien\LaporanV2\Page\DKK22LaporanBulananSTPRawatJalan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use Carbon\Carbon;

class APIController extends Controller
{
	protected $icd_data = [
		[
			'text' => 'Kolera',
			'icd_text' => 'A.00',
			'rule' => [
				'like' => 'A00',
			]
		],
		[
			'text' => 'Diare',
			'icd_text' => 'A.09',
			'rule' => [
				'like' => 'A09',
			]
		],
		[
			'text' => 'Diare berdarah',
			'icd_text' => 'A.03.9, A.06.9',
			'rule' => [
				'like' => ['A03.9', 'A06.9'],
			]
		],
		[
			'text' => 'Tifus perut klinis',
			'icd_text' => 'A.01',
			'rule' => [
				'like' => 'A.01',
				'not like' => ['A01.1', 'A01.2', 'A01.3'],
			]
		],
		[
			'text' => 'Tifus perut Widal (+)',
			'icd_text' => 'A.01.1 - A.01.3',
			'rule' => [
				'like' => ['A01.1', 'A01.2', 'A01.3'],
			]
		],
		[
			'text' => 'TBC paru BTA(+)',
			'icd_text' => 'A.15.0',
			'rule' => [
				'like' => 'A15.0',
			]
		],
		[
			'text' => 'Tersangka TBC paru',
			'icd_text' => 'A.16',
			'rule' => [
				'like' => 'A16',
			]
		],
		[
			'text' => 'Kusta PB',
			'icd_text' => 'A.30.1',
			'rule' => [
				'like' => 'A30.1',
			]
		],
		[
			'text' => 'Kusta MB',
			'icd_text' => 'A.30.5',
			'rule' => [
				'like' => 'A30.5',
			]
		],
		[
			'text' => 'Campak',
			'icd_text' => 'B.05',
			'rule' => [
				'like' => 'B05',
			]
		],
		[
			'text' => 'Difteri',
			'icd_text' => 'A.36',
			'rule' => [
				'like' => 'A36',
			]
		],
		[
			'text' => 'Batuk rejan',
			'icd_text' => 'A.37',
			'rule' => [
				'like' => 'A37',
			]
		],
		[
			'text' => 'Tetanus',
			'icd_text' => 'A.33, A.35',
			'rule' => [
				'like' => ['A33', 'A35'],
			]
		],
		[
			'text' => 'Hepatitis klinis',
			'icd_text' => 'B.15-B.19',
			'rule' => [
				'like' => ['B15', 'B16', 'B17', 'B18', 'B19'],
			]
		],
		[
			'text' => 'Hepatitis HBsAg (+)',
			'icd_text' => 'B16',
			'rule' => [
				'like' => 'B16',
			]
		],
		[
			'text' => 'Malaria klinis',
			'icd_text' => 'B.54',
			'rule' => [
				'like' => 'B54',
			]
		],
		[
			'text' => 'Malaria vivax',
			'icd_text' => 'B.51',
			'rule' => [
				'like' => 'B51',
			]
		],
		[
			'text' => 'Malaria falsiparum',
			'icd_text' => 'B.50',
			'rule' => [
				'like' => 'B50',
			]
		],
		[
			'text' => 'Malaria mix',
			'icd_text' => 'B.50-B.53',
			'rule' => [
				'like' => ['B50', 'B52', 'B53'],
			]
		],
		[
			'text' => 'Demam berdarah dengue',
			'icd_text' => 'A.91',
			'rule' => [
				'like' => 'A91',
			]
		],
		[
			'text' => 'Demam dengue',
			'icd_text' => 'A.90',
			'rule' => [
				'like' => 'A90',
			]
		],
		[
			'text' => 'Pneumonia',
			'icd_text' => 'J.18',
			'rule' => [
				'like' => 'J18',
			]
		],
		[
			'text' => 'Sifilis',
			'icd_text' => 'A.53.9',
			'rule' => [
				'like' => 'A53.9',
			]
		],
		[
			'text' => 'Gonorrhoe',
			'icd_text' => 'A.54',
			'rule' => [
				'like' => 'A54',
			]
		],
		[
			'text' => 'Frambusia',
			'icd_text' => 'A.66',
			'rule' => [
				'like' => 'A66',
			]
		],
		[
			'text' => 'Filariasis',
			'icd_text' => 'B.74',
			'rule' => [
				'like' => 'B74',
			]
		],
		[
			'text' => 'Influensa',
			'icd_text' => 'J10-J.11',
			'rule' => [
				'like' => 'J10', 'J11',
			]
		],
		[
			'text' => 'Ensefalitis',
			'icd_text' => 'G04',
			'rule' => [
				'like' => 'G04',
			]
		],
		[
			'text' => 'Meningitis',
			'icd_text' => 'G.00 - G.03',
			'rule' => [
				'like' => ['G00', 'G01', 'G02', 'G03'],
			]
		],
		[
			'text' => 'Angina Pektoris',
			'icd_text' => 'I.20',
			'rule' => [
				'like' => 'I20',
			]
		],
		[
			'text' => 'Infark Miokard Akut',
			'icd_text' => 'I.21',
			'rule' => [
				'like' => 'I21',
			]
		],
		[
			'text' => 'Infark Miokard Subsekuen',
			'icd_text' => 'I.22',
			'rule' => [
				'like' => 'I22',
			]
		],
		[
			'text' => 'Hipertensi esensial',
			'icd_text' => 'I.10',
			'rule' => [
				'like' => 'I10',
			]
		],
		[
			'text' => 'Jantung Hipertensi',
			'icd_text' => 'I.11',
			'rule' => [
				'like' => 'I11',
			]
		],
		[
			'text' => 'Ginjal Hipertensi',
			'icd_text' => 'I.12',
			'rule' => [
				'like' => 'I12',
			]
		],
		[
			'text' => 'Jantung & Ginjal Hipertensi',
			'icd_text' => 'I.13',
			'rule' => [
				'like' => 'I13',
			]
		],
		[
			'text' => 'Hipertensi Sekunder',
			'icd_text' => 'I.15',
			'rule' => [
				'like' => 'I15',
			]
		],
		[
			'text' => 'DM Bergantung Insulin',
			'icd_text' => 'E.10',
			'rule' => [
				'like' => 'E10',
			]
		],
		[
			'text' => 'DM Tak Bergantung Insulin',
			'icd_text' => 'E.11',
			'rule' => [
				'like' => 'E11',
			]
		],
		[
			'text' => 'DM Berhubungan Malnutrisi',
			'icd_text' => 'E.12',
			'rule' => [
				'like' => 'E12',
			]
		],
		[
			'text' => 'DM YTD Lainnya',
			'icd_text' => 'E.13',
			'rule' => [
				'like' => 'E13',
			]
		],
		[
			'text' => 'DM YTT',
			'icd_text' => 'E.14',
			'rule' => [
				'like' => 'E14',
			]
		],
		[
			'text' => 'Neoplasma Ganas Serviks',
			'icd_text' => 'C.53',
			'rule' => [
				'like' => 'C53',
			]
		],
		[
			'text' => 'Neoplasma Ganas Payudara',
			'icd_text' => 'C.50',
			'rule' => [
				'like' => 'C50',
			]
		],
		[
			'text' => 'Neoplasma Ganas Hati & saluran empedu intrahepatik',
			'icd_text' => 'C.22',
			'rule' => [
				'like' => 'C22',
			]
		],
		[
			'text' => 'Neoplasma Ganas Bronkus & Paru',
			'icd_text' => 'C.34',
			'rule' => [
				'like' => 'C34',
			]
		],
		[
			'text' => 'Paru obstruktif menahun',
			'icd_text' => 'J.44.9',
			'rule' => [
				'like' => 'J44.9',
			]
		],
		[
			'text' => 'Kecelakaan Lalulintas',
			'icd_text' => 'V.89.9',
			'rule' => [
				'like' => 'V89.9',
			]
		],
		[
			'text' => 'Psikosis',
			'icd_text' => 'F29',
			'rule' => [
				'like' => 'F29',
			]
		],
		[
			'text' => 'Stroke',
			'icd_text' => 'I64',
			'rule' => [
				'like' => 'I64',
			]
		],
	];

	public function getTotalData(Request $request)
	{
		$start = Carbon::createFromFormat('d-m-Y', $request->datestart)->startOfDay();
		$end = Carbon::createFromFormat('d-m-Y', $request->dateend)->endOfDay();



		return json_encode([
			'status' => 200,
			'data' => [
				'count' => count($this->icd_data),
			],
		]);
	}

	public function getData(Request $request)
	{
		$start = Carbon::createFromFormat('d-m-Y', $request->datestart)->startOfDay();
		$end = Carbon::createFromFormat('d-m-Y', $request->dateend)->endOfDay();

		$_ = config('app.db_name');

		$icd_data = $this->icd_data[$request->current_index];

		$kasus = Kasus::with([])
			->selectRaw('kasus.*, pasien.date_of_birth, pasien.gender')
			->join($_.'_rawat_jalan.transaksi',function($query){
				$query->on('kasus.id','=','transaksi.kasus_id')
					->whereNull('transaksi.deleted_at')
					->where('transaksi.status', '!=', -1);
			})
			->join($_ . '_patients.pasien', 'kasus.pasien_id', '=', 'pasien.id')
			->join('diagnosis', function($query){
				$query->on('kasus.id', '=', 'diagnosis.kasus_id');
				$query->whereNull('diagnosis.deleted_at');
			})
			->join('icd_10', function ($query) use ($icd_data) {
				$query->on('diagnosis.icd_10', '=', 'icd_10.id');
				foreach ($icd_data['rule'] as $key => $item) {
					if (is_array($item)) {
						$query->where(function($query) use ($key, $item){
							foreach ($item as $k => $v) {
								if ($k == 0 || $key == "not like") {
									$query->where('icd_10.code_icd', $key, '%' . $v . '%');
								} else {
									$query->orWhere('icd_10.code_icd', $key, '%' . $v . '%');
								}
							}
						});
					} else {
						$query->where('icd_10.code_icd', $key, '%' . $item . '%');
					}
				}
			})
			->whereNotNull('transaksi.id')
			->whereBetween('transaksi.waktu_masuk', [$start, $end])
			->whereIn('pasien.gender', [1, 2])
			->groupBy('kasus.id')
			->get();

		$kasus = $kasus->map(function ($row) {
			#set age range
			$date_of_birth = Carbon::parse($row->date_of_birth);
			$diff = $date_of_birth->diff($row->created_at);

			if ($diff->days <= 28) $row->age_range = '0 - 28 hr';
			elseif ($diff->y < 1) $row->age_range = '28 - <1th';
			elseif ($diff->y < 4) $row->age_range = '1 - 4 th';
			elseif ($diff->y < 14) $row->age_range = '5 - 14 th';
			elseif ($diff->y < 24) $row->age_range = '15 - 24 th';
			elseif ($diff->y < 44) $row->age_range = '25 - 44 th';
			elseif ($diff->y < 64) $row->age_range = '45 - 64 th';
			elseif ($diff->y >= 64) $row->age_range = '65 + th';

			return $row;
		});

		$data = [];
		$item = [];

		$item[] = $request->current_index + 1;
		$item[] = $icd_data['text'];
		$item[] = $icd_data['icd_text'];
		$item[] = $kasus->where('age_range', '0 - 28 hr')->count();
		$item[] = $kasus->where('age_range', '28 - <1th')->count();
		$item[] = $kasus->where('age_range', '1 - 4 th')->count();
		$item[] = $kasus->where('age_range', '5 - 14 th')->count();
		$item[] = $kasus->where('age_range', '15 - 24 th')->count();
		$item[] = $kasus->where('age_range', '25 - 44 th')->count();
		$item[] = $kasus->where('age_range', '45 - 64 th')->count();
		$item[] = $kasus->where('age_range', '65 + th')->count();
		$item[] = $kasus->where('gender', '1')->count();
		$item[] = $kasus->where('gender', '2')->count();
		$item[] = $kasus->count();

		$data[] = $item;

		$next_index = $request->current_index + 1;
		return json_encode([
			'status' => 200,
			'data' => $data,
			'current_index' => $next_index,
			'continue' => isset($this->icd_data[$next_index]),
		]);
	}
}
