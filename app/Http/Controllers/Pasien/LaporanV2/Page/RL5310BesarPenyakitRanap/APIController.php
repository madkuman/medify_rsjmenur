<?php

namespace App\Http\Controllers\Pasien\LaporanV2\Page\RL5310BesarPenyakitRanap;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\Diagnosis;
use App\Models\Kasus\ICD10;
use App\Models\Hospital\MasterStatusPulang;
use Carbon\Carbon;

class APIController extends Controller
{
    public function getTotalData(Request $request)
    {
    	$start = Carbon::createFromFormat('d-m-Y', $request->datestart)->startOfDay();
		$end = Carbon::createFromFormat('d-m-Y', $request->dateend)->endOfDay();

		$diagnosis = Diagnosis::whereBetween('kasus.created_at',[$start,$end])
					->leftJoin('kasus', 'kasus.id', '=', 'diagnosis.kasus_id')
                    ->leftJoin(config('app.db_name') . '_patients.pasien as pasien', 'pasien.id', '=', 'kasus.pasien_id')
                    ->whereNull('pasien.deleted_at')
                    ->whereNotNull('pasien.gender')
                    ->whereNotNull('kasus.krs_status')
                    ->whereNotNull('kasus.krs_at')
                    ->where('tipe_ri','=','1')
                    ->pluck('diagnosis.icd_10')->toArray();
        $array_count_values = array_count_values($diagnosis);
        arsort($array_count_values);
        $array_10 = array_slice(array_keys($array_count_values), 0, $request->jumlah, true);
        $jumlah_array_10 = count($array_10);
        $total = count($diagnosis);

		return json_encode([
			'status' => 200,
			'data' => $total,
			'array_10' => $array_10,
			'jumlah_array_10' => $jumlah_array_10
		]);
    }

    public function getData(Request $request)
    {

    	$start = Carbon::createFromFormat('d-m-Y', $request->datestart)->startOfDay();
		$end = Carbon::createFromFormat('d-m-Y', $request->dateend)->endOfDay();
		$data_fetched = $request->datafetched;
		$icd = $request->icd;

    	$meninggal = MasterStatusPulang::where('slug','=','meninggal')->first();
    	$diagnosis_index = ICD10::find($icd);

		$diagnosis = Diagnosis::selectRaw('count(diagnosis.id) as total, pasien.gender, kasus.krs_status')
					->leftJoin('kasus', 'kasus.id', '=', 'diagnosis.kasus_id')
                    ->leftJoin(config('app.db_name') . '_patients.pasien as pasien', 'pasien.id', '=', 'kasus.pasien_id')
                    ->whereNull('pasien.deleted_at')
                    ->whereNotNull('pasien.gender')
                    ->whereNotNull('kasus.krs_status')
                    ->whereNotNull('kasus.krs_at')
                    ->where('tipe_ri','=','1')
                    ->whereBetween('kasus.created_at',[$start,$end])
                    ->where('diagnosis.icd_10','=',$icd)
                    ->groupBy('pasien.gender')
                    ->groupBy('kasus.krs_status')
                    ->get();

		$array_data = [];
		
        $laki_hidup = $diagnosis->where('gender','=',1)->whereNotIn('krs_status', [$meninggal->id])->first();
        $pr_hidup = $diagnosis->where('gender','=',2)->whereNotIn('krs_status', [$meninggal->id])->first();
        $laki_mati = $diagnosis->where('gender','=',1)->whereIn('krs_status', [$meninggal->id])->first();
        $pr_mati = $diagnosis->where('gender','=',2)->whereIn('krs_status', [$meninggal->id])->first();
        
		$new_item = new \StdClass();
        $new_item->no = $data_fetched+1;
        $new_item->kode = $diagnosis_index->code_icd;
        $new_item->deskripsi = $diagnosis_index->long_desc;
		$new_item->laki_hidup = $laki_hidup->total ?? 0;
		$new_item->pr_hidup = $pr_hidup->total ?? 0;
		$new_item->laki_mati = $laki_mati->total ?? 0;
        $new_item->pr_mati = $pr_mati->total ?? 0;
        $new_item->total = $new_item->laki_hidup + $new_item->pr_hidup + $new_item->laki_mati + $new_item->pr_mati;
		
		$array_data[] = $new_item;

		return json_encode([
			'status' => 200,
			'data' => $array_data
		]);



    }
}
