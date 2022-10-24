<?php

namespace App\Http\Controllers\Pasien\LaporanV2\Page\RL314Rujukan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use Carbon\Carbon;
use App\Models\Hospital\MasterSIRSSpesialisasiRujukan;
use App\Models\Kasus\Diagnosis;
use App\Models\Hospital\SIRSSpesialisasiRujukanICD10;

class APIController extends Controller
{
    public function getTotalData(Request $request)
    {
		$total = MasterSIRSSpesialisasiRujukan::count('id');
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

		$all_spesialisasi = MasterSIRSSpesialisasiRujukan::skip($data_fetched)->take($limit)->get();
		$kasus = Diagnosis::select('kasus.id as kasus_id', 'diagnosis.icd_10 as icd_10', 'rujuk_ke_tabel.tipe as rujuk_ke_tipe', 'rujuk_ke_tabel.id as rujuk_ke_id', 'asal_rujuk_tabel.tipe as asal_rujuk_tipe', 'asal_rujuk_tabel.id as asal_rujuk_id', 'asal_rujuk_tabel.nama as asal_rujuk_nama')
					->leftJoin('kasus','kasus.id','=','diagnosis.kasus_id')
					->leftJoin(config('app.db_name') . '_patients.asal_rujukan as rujuk_ke_tabel', 'rujuk_ke_tabel.id', '=', 'kasus.krs_keterangan')
					->leftJoin(config('app.db_name') . '_patients.asal_rujukan as asal_rujuk_tabel', 'asal_rujuk_tabel.id', '=', 'kasus.asal_rujukan_id')
					->whereBetween('kasus.created_at',[$start,$end]);

		$array_data = [];
		
		// TIPE ASAL RUJUKAN =
		// 1 = RS
		// 2 = PUSKESMAS
		// 3 = DOKTER PINGGIR JALAN (FASKES)
		// 4 = KLINIK (FASKES)
		// 5 = KLINIK (FASKES)

		foreach($all_spesialisasi as $index => $spesialisasi)
		{
			$list_icd = SIRSSpesialisasiRujukanICD10::where('sirs_id','=',$spesialisasi->id)->pluck('diagnosis_id')->toArray();

			$new_item = new \StdClass();
			$new_item->no = $data_fetched + $index + 1;
			$new_item->nama = $spesialisasi->nama;

			$new_item->dari_puskesmas = $kasus->get()->where('asal_rujuk_tipe','=', 2)->whereIn('icd_10', $list_icd)->unique('kasus_id')->count();
			$new_item->dari_faskes = $kasus->get()->where('asal_rujuk_tipe','>', 2)->whereIn('icd_10', $list_icd)->unique('kasus_id')->count();
			$new_item->dari_rs = $kasus->get()->where('asal_rujuk_tipe','=', 1)->whereIn('icd_10', $list_icd)->unique('kasus_id')->count();

			$new_item->ke_puskesmas = $kasus->get()->where('rujuk_ke_tipe','=', 2)->whereIn('icd_10', $list_icd)->unique('kasus_id')->count();
			$new_item->ke_faskes = $kasus->get()->where('rujuk_ke_tipe','>', 2)->whereIn('icd_10', $list_icd)->unique('kasus_id')->count();
			$new_item->ke_rs = $kasus->get()->where('rujuk_ke_tipe','=', 1)->whereIn('icd_10', $list_icd)->unique('kasus_id')->count();

			$new_item->rujuk_dirujuk = $kasus->get()->where('asal_rujuk_nama','!=', "null")->where('rujuk_ke_id','!=', null)->whereIn('icd_10', $list_icd)->unique('kasus_id')->count();
			$new_item->tidak_rujuk_dirujuk = $kasus->get()->where('asal_rujuk_nama','=', "null")->where('rujuk_ke_id','!=', null)->whereIn('icd_10', $list_icd)->unique('kasus_id')->count();
			$new_item->diterima_kembali = $kasus->whereRaw('rujuk_ke_tabel.id = asal_rujuk_tabel.id')->get()->whereIn('icd_10', $list_icd)->unique('kasus_id')->count();

			$array_data[] = $new_item;
		}




		return json_encode([
			'status' => 200,
			'data' => $array_data
		]);



    }
}
