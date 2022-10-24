<?php

namespace App\Http\Controllers\Pasien\LaporanV2\Page\RL34Kebidanan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use Carbon\Carbon;
use App\Models\Hospital\MasterSIRSKegiatanKebidanan;
use App\Models\Kasus\Diagnosis;
use App\Models\Kasus\Tindakan;
use App\Models\Hospital\SIRSKegiatanKebidananICD9;
use App\Models\Hospital\SIRSKegiatanKebidananICD10;
use App\Models\Hospital\MasterStatusPulang;

class APIController extends Controller
{
    public function getTotalData(Request $request)
    {
		$total = MasterSIRSKegiatanKebidanan::count('id');
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
		$meninggal = MasterStatusPulang::where('slug','=','meninggal')->first();

		$all_spesialisasi = MasterSIRSKegiatanKebidanan::skip($data_fetched)->take($limit)->get();
		$diagnosis = Diagnosis::select('kasus.id as kasus_id', 'icd_10.code_icd as code_icd', 'rujuk_ke_tabel.id as rujuk_ke_id', 'asal_rujuk_tabel.tipe as asal_rujuk_tipe', 'kasus.krs_status as krs_status')
					->leftJoin('kasus','kasus.id','=','diagnosis.kasus_id')
					->leftJoin('icd_10','icd_10.id','=','diagnosis.icd_10')
					->leftJoin(config('app.db_name') . '_patients.asal_rujukan as rujuk_ke_tabel', 'rujuk_ke_tabel.id', '=', 'kasus.krs_keterangan')
					->leftJoin(config('app.db_name') . '_patients.asal_rujukan as asal_rujuk_tabel', 'asal_rujuk_tabel.id', '=', 'kasus.asal_rujukan_id')
					->whereBetween('kasus.created_at',[$start,$end])
					->get();

		$tindakan = Tindakan::select('kasus.id as kasus_id', 'icd_9.code_icd as code_icd', 'rujuk_ke_tabel.id as rujuk_ke_id', 'asal_rujuk_tabel.tipe as asal_rujuk_tipe',  'kasus.krs_status as krs_status')
					->leftJoin('kasus','kasus.id','=','tindakan.kasus_id')
					->leftJoin('icd_9','icd_9.id','=','tindakan.icd_9')
					->leftJoin(config('app.db_name') . '_patients.asal_rujukan as rujuk_ke_tabel', 'rujuk_ke_tabel.id', '=', 'kasus.krs_keterangan')
					->leftJoin(config('app.db_name') . '_patients.asal_rujukan as asal_rujuk_tabel', 'asal_rujuk_tabel.id', '=', 'kasus.asal_rujukan_id')
					->whereBetween('kasus.created_at',[$start,$end])
					->get();

		$array_data = [];
		
		// TIPE ASAL RUJUKAN =
		// 1 = RS
		// 2 = PUSKESMAS
		// 3 = DOKTER PINGGIR JALAN (FASKES)
		// 4 = KLINIK (FASKES)
		// 5 = KLINIK (FASKES)

		foreach($all_spesialisasi as $index => $spesialisasi)
		{
			$list_icd9 = SIRSKegiatanKebidananICD9::where('sirs_kegiatan_kebidanan_icd9.sirs_id','=',$spesialisasi->id)
							->leftJoin(config('app.db_name') . '_kasus.icd_9 as icd_9', 'icd_9.id', '=', 'sirs_kegiatan_kebidanan_icd9.tindakan_id')
							->pluck('code_icd')->toArray();

			$list_icd10 = SIRSKegiatanKebidananICD10::where('sirs_kegiatan_kebidanan_icd10.sirs_id','=',$spesialisasi->id)
							->leftJoin(config('app.db_name') . '_kasus.icd_10 as icd_10', 'icd_10.id', '=', 'sirs_kegiatan_kebidanan_icd10.diagnosis_id')
							->pluck('code_icd')->toArray();

			$new_item = new \StdClass();
			$new_item->no = $data_fetched + $index + 1;
			$new_item->nama = $spesialisasi->nama;

			$d_count = $diagnosis->where('asal_rujuk_tipe','=', 1)->whereIn('code_icd', $list_icd10)->unique('kasus_id')->pluck('kasus_id')->toArray();
			$t_count = $tindakan->where('asal_rujuk_tipe','=', 1)->whereIn('code_icd', $list_icd9)->unique('kasus_id')->pluck('kasus_id')->toArray();
			$new_item->rm_rumah_sakit = count(array_unique(array_merge($d_count, $t_count)));
			
			$d_count = $diagnosis->where('asal_rujuk_tipe','=', 3)->whereIn('code_icd', $list_icd10)->unique('kasus_id')->pluck('kasus_id')->toArray();
			$t_count = $tindakan->where('asal_rujuk_tipe','=', 3)->whereIn('code_icd', $list_icd9)->unique('kasus_id')->pluck('kasus_id')->toArray();
			$new_item->rm_bidan = count(array_unique(array_merge($d_count, $t_count)));
			
			$d_count = $diagnosis->where('asal_rujuk_tipe','=', 2)->whereIn('code_icd', $list_icd10)->unique('kasus_id')->pluck('kasus_id')->toArray();
			$t_count = $tindakan->where('asal_rujuk_tipe','=', 2)->whereIn('code_icd', $list_icd9)->unique('kasus_id')->pluck('kasus_id')->toArray();
			$new_item->rm_puskesmas = count(array_unique(array_merge($d_count, $t_count)));
			
			$d_count = $diagnosis->where('asal_rujuk_tipe','>', 3)->whereIn('code_icd', $list_icd10)->unique('kasus_id')->pluck('kasus_id')->toArray();
			$t_count = $tindakan->where('asal_rujuk_tipe','>', 3)->whereIn('code_icd', $list_icd9)->unique('kasus_id')->pluck('kasus_id')->toArray();
			$new_item->rm_faskes_lainnya = count(array_unique(array_merge($d_count, $t_count)));
			
			$d_count = $diagnosis->where('asal_rujuk_tipe','!=', null)->whereIn('code_icd', $list_icd10)->where('krs_status','!=',$meninggal->id)->unique('kasus_id')->pluck('kasus_id')->toArray();
			$t_count = $tindakan->where('asal_rujuk_tipe','!=', null)->whereIn('code_icd', $list_icd9)->where('krs_status','!=',$meninggal->id)->unique('kasus_id')->pluck('kasus_id')->toArray();
			$new_item->rm_hidup = count(array_unique(array_merge($d_count, $t_count)));
			
			$d_count = $diagnosis->where('asal_rujuk_tipe','!=', null)->whereIn('code_icd', $list_icd10)->where('krs_status','=',$meninggal->id)->unique('kasus_id')->pluck('kasus_id')->toArray();
			$t_count = $tindakan->where('asal_rujuk_tipe','!=', null)->whereIn('code_icd', $list_icd9)->where('krs_status','=',$meninggal->id)->unique('kasus_id')->pluck('kasus_id')->toArray();
			$new_item->rm_mati = count(array_unique(array_merge($d_count, $t_count)));
			
			$new_item->rm_total = $new_item->rm_hidup + $new_item->rm_mati;
			
			$d_count = $diagnosis->where('asal_rujuk_tipe','!=', null)->whereIn('code_icd', $list_icd10)->where('krs_status','!=',$meninggal->id)->unique('kasus_id')->pluck('kasus_id')->toArray();
			$t_count = $tindakan->where('asal_rujuk_tipe','!=', null)->whereIn('code_icd', $list_icd9)->where('krs_status','!=',$meninggal->id)->unique('kasus_id')->pluck('kasus_id')->toArray();
			$new_item->rnm_hidup = count(array_unique(array_merge($d_count, $t_count)));
			
			$d_count = $diagnosis->where('asal_rujuk_tipe','!=', null)->whereIn('code_icd', $list_icd10)->where('krs_status','=',$meninggal->id)->unique('kasus_id')->pluck('kasus_id')->toArray();
			$t_count = $tindakan->where('asal_rujuk_tipe','!=', null)->whereIn('code_icd', $list_icd9)->where('krs_status','=',$meninggal->id)->unique('kasus_id')->pluck('kasus_id')->toArray();
			$new_item->rnm_mati = count(array_unique(array_merge($d_count, $t_count)));
			
			$new_item->rnm_total = $new_item->rnm_hidup + $new_item->rnm_mati;
			
			$d_count = $diagnosis->where('asal_rujuk_tipe','=', null)->whereIn('code_icd', $list_icd10)->where('krs_status','!=',$meninggal->id)->unique('kasus_id')->pluck('kasus_id')->toArray();
			$t_count = $tindakan->where('asal_rujuk_tipe','=', null)->whereIn('code_icd', $list_icd9)->where('krs_status','!=',$meninggal->id)->unique('kasus_id')->pluck('kasus_id')->toArray();
			$new_item->nr_hidup = count(array_unique(array_merge($d_count, $t_count)));
			
			$d_count = $diagnosis->where('asal_rujuk_tipe','=', null)->whereIn('code_icd', $list_icd10)->where('krs_status','=',$meninggal->id)->unique('kasus_id')->pluck('kasus_id')->toArray();
			$t_count = $tindakan->where('asal_rujuk_tipe','=', null)->whereIn('code_icd', $list_icd9)->where('krs_status','=',$meninggal->id)->unique('kasus_id')->pluck('kasus_id')->toArray();
			$new_item->nr_mati = count(array_unique(array_merge($d_count, $t_count)));
			
			$new_item->nr_total = $new_item->nr_hidup + $new_item->nr_mati;
			
			$d_count = $diagnosis->where('rujuk_ke_id','!=', null)->whereIn('code_icd', $list_icd10)->unique('kasus_id')->pluck('kasus_id')->toArray();
			$t_count = $tindakan->where('rujuk_ke_id','!=', null)->whereIn('code_icd', $list_icd9)->unique('kasus_id')->pluck('kasus_id')->toArray();
			$new_item->dirujuk = count(array_unique(array_merge($d_count, $t_count)));


			$array_data[] = $new_item;
		}




		return json_encode([
			'status' => 200,
			'data' => $array_data
		]);



    }
}
