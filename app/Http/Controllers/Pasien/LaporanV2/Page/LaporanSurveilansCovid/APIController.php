<?php

namespace App\Http\Controllers\Pasien\LaporanV2\Page\LaporanSurveilansCovid;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\RawatJalan\Transaksi;
use Carbon\Carbon;

class APIController extends Controller
{
    public function getTotalData(Request $request)
    {
		$start = Carbon::createFromFormat('d-m-Y', $request->datestart)->startOfDay();
		$end = Carbon::createFromFormat('d-m-Y', $request->dateend)->endOfDay();

		$callback_asesmen = function($q){
			$q->whereIn('presentase', [1, 4]);
		};

		$kasus = Kasus::with([
				'pengawasan_covid',
				'pasien',
				'diagnosisUtama.icd10',
				'diagnosisTambahan.icd10',
				'admin',
				'lokasi.lokasi'
			])->whereHas('pengawasan_covid', $callback_asesmen)->whereBetween('created_at', [$start, $end])->get();
		$kasus = $kasus->filter(function($val, $key){
			return isset($val->pengawasan_covid->presentase);	
		});

		$kasus_infeksius = Transaksi::with([
						'kasus.diagnosisUtama.icd10',
						'kasus.diagnosisTambahan.icd10',
						'kasus.admin',
						'kasus.lokasi.lokasi',
						'kasus.pasien'
					])
					->where('poliklinik_id', 83)
					->whereIn('status', [1,2])
					->whereNotIn('kasus_id', $kasus->pluck('id'))
					->whereBetween('ordered_at', [$start, $end])
					->get()->pluck('kasus');
		$data = $kasus->merge($kasus_infeksius);

		$total = count($data);


		return json_encode([
			'status' => 200,
			'data' => $total
		]);
    }

    public function getData(Request $request)
    {
    	$start = Carbon::createFromFormat('d-m-Y', $request->datestart)->startOfDay();
		$end = Carbon::createFromFormat('d-m-Y', $request->dateend)->endOfDay();
		$data_fetched = $request->datafetched;
		$limit = $request->limit;

		$callback_asesmen = function($q){
			$q->whereIn('presentase', [1, 4]);
		};
		$kasus = Kasus::with([
				'pengawasan_covid',
				'pasien',
				'diagnosisUtama.icd10',
				'diagnosisTambahan.icd10',
				'admin',
				'lokasi.lokasi'
			])->whereHas('pengawasan_covid', $callback_asesmen)->whereBetween('created_at', [$start, $end])->get();
		$kasus = $kasus->filter(function($val, $key){
			return isset($val->pengawasan_covid->presentase);	
		});

		$kasus_infeksius = Transaksi::with([
						'kasus.diagnosisUtama.icd10',
						'kasus.diagnosisTambahan.icd10',
						'kasus.admin',
						'kasus.lokasi.lokasi',
						'kasus.pasien'
					])
					->where('poliklinik_id', 83)
					->whereIn('status', [1,2])
					->whereNotIn('kasus_id', $kasus->pluck('id'))
					->whereBetween('ordered_at', [$start, $end])
					->get()->pluck('kasus');
		$data = $kasus->merge($kasus_infeksius)->sortBy('id')->slice($data_fetched, $limit);

		$array_data = [];
		foreach($data as $index => $item)
		{
			$keterangan = '';
			$val = json_decode($item->pengawasan_covid->val ?? null);

			$new_item = new \StdClass();
			$new_item->no = $index+1;
			$new_item->no_rm = $item->pasien->no_rm ?? '';
			$new_item->nama = $item->pasien->name ?? '';
			$new_item->age = $item->pasien->age ?? '';
			$new_item->address = $item->pasien->address ?? '';
			$new_item->no_hp = $item->pasien->phone ?? '';
			$new_item->lokasi = $item->lokasi->lokasi->nama ?? '';
			$new_item->diagnosisUtama = $item->diagnosisUtama->icd10->long_desc ?? '';
			
			$diag_array = $item->diagnosisTambahan ? $item->diagnosisTambahan->map(function ($diag, $key) {
			    return $diag->icd10->long_desc ?? '-';
			}) : [];
			$diag_array = empty($diag_array) ? [] : $diag_array->toArray();
			$diag_tambahan = implode(', ', $diag_array);
			
			$new_item->diagnosisTambahan = $diag_tambahan == '' ? '-' : $diag_tambahan;
			$new_item->dpjp = $item->admin->user->name ?? '';
			$new_item->krs_status = $item->krs_status ?? '';
			$new_item->krs_at = indonesian_date($item->krs_at) ?? '-';
			$new_item->covid_status = isset($item->covid_status->status) ? $item->covid_status->status : '-';
			
			if(isset($val)){
				$keterangan = implode('; ', array_filter([
						($val->demam ? "demam" : null),
						($val->bapil ? "batuk/pilek/nyeri tenggorokan" : null),
						($val->nafas ? "sesak nafas/pneumonia" : null),
						($val->kontak ? "riwayat kontak dengan pasien covid-19" : null),
						($val->negara ? "pernah berkunjug ke negara ".implode(', ', $val->negara) : null),
						($val->daerah ? "pernah berkunjug ke daerah ".implode(', ', $val->daerah) : null),
						(isset($val->swab) && $val->swab == 1 ? ($val->hasil_swab == 1 ? "Tes Swab Positif" : "Tes Swab Negatif") : null)
					]));
			}

			$new_item->keterangan = $keterangan;
			
			$array_data[] = $new_item;
		}




		return json_encode([
			'status' => 200,
			'data' => $array_data
		]);



    }
}
