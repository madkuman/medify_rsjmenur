<?php

namespace App\Http\Controllers\Pasien\LaporanV2\Page\RL5410BesarPenyakitRajal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\Diagnosis;
use App\Models\Kasus\ICD10;
use Carbon\Carbon;

class APIController extends Controller
{
    public function getTotalData(Request $request)
    {
    	$start = Carbon::createFromFormat('d-m-Y', $request->datestart)->startOfDay();
		$end = Carbon::createFromFormat('d-m-Y', $request->dateend)->endOfDay();

		$diagnosis = Diagnosis::whereBetween('diagnosis.created_at',[$start,$end])
					->leftJoin('kasus', 'kasus.id', '=', 'diagnosis.kasus_id')
                    ->leftJoin(config('app.db_name') . '_patients.pasien as pasien', 'pasien.id', '=', 'kasus.pasien_id')
                    ->whereNull('pasien.deleted_at')
                    ->whereNotNull('pasien.gender')
                    ->where('tipe_rj','=','1')
                    ->pluck('diagnosis.icd_10')->toArray();
        $array_count_values = array_count_values($diagnosis);
        arsort($array_count_values);
        $array_10 = array_slice(array_keys($array_count_values), 0, 10, true);
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

    	$diagnosis_index = ICD10::find($icd);

		$diagnosis = Diagnosis::selectRaw('count(diagnosis.id) as total, pasien.gender, kasus.is_baru')
					->leftJoin('kasus', 'kasus.id', '=', 'diagnosis.kasus_id')
                    ->leftJoin(config('app.db_name') . '_patients.pasien as pasien', 'pasien.id', '=', 'kasus.pasien_id')
                    ->whereNull('pasien.deleted_at')
                    ->whereNotNull('pasien.gender')
                    ->where('tipe_rj','=','1')
                    ->whereBetween('kasus.created_at',[$start,$end])
                    ->where('diagnosis.icd_10','=',$icd)
                    ->groupBy('pasien.gender')
                    ->groupBy('kasus.is_baru')
                    ->get();

		$array_data = [];
        $kunjungan = 0;
		
        $laki_baru = $diagnosis->where('gender','=',1)->where('is_baru','=',1)->first();
        $pr_baru = $diagnosis->where('gender','=',2)->where('is_baru','=',1)->first();
        
		$new_item = new \StdClass();
        $new_item->no = $data_fetched+1;
        $new_item->kode = $diagnosis_index->code_icd;
        $new_item->deskripsi = $diagnosis_index->long_desc;
		$new_item->laki_baru = $laki_baru->total ?? 0;
		$new_item->pr_baru = $pr_baru->total ?? 0;
		$new_item->laki_baru_pr_baru = ($laki_baru->total ?? 0) + ($pr_baru->total ?? 0);
        
        foreach ($diagnosis as $key => $value) {
            $kunjungan += $value->total;
        }
        $new_item->kunjungan = $kunjungan;
		
		$array_data[] = $new_item;

		return json_encode([
			'status' => 200,
			'data' => $array_data
		]);



    }
}
