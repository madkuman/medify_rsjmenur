<?php

namespace App\Http\Controllers\Kasus\Diagnosis;

use App\Models\Kasus\CPPT;
use App\Models\Kasus\Diagnosis;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\ICD10;
use App\Models\Kasus\ViewDiagnosisUserTotal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\Pasien\Pasien;

class ReadController extends Controller
{
	public function fetchAllDiagnosis($kasusId) {
		$dx = ['utama','komplikasi','sekunder'];
		$diagnosis = Diagnosis::where('kasus_id', $kasusId)->with(['creator', 'icd10','clinical_pathway'])->orderByRaw('FIELD (type, "utama","komplikasi","sekunder")')->get();

		return $diagnosis;
	}

	public function searchDiagnosisByKeyword($keyword) {
		$keyword = preg_replace("/[^[:alnum:][:space:]]/u", '', $keyword);
		$icd = ICD10::search($keyword)->get();
		return $icd;

	}

    public function searchByCodeICD($code_icd, $return) {
        $icd = ICD10::where('code_icd',$code_icd)->first();
        if(!empty($icd)) return $icd->$return;
        else null;

    }

	public function DiagnosisList(Request $request){

		$search = preg_replace("/[^[:alnum:][:space:][.\][,\]]/u", '', $request->get('keyword'));
		$search = str_replace(['[', ']'], '', $search);
        if(!empty($search))
            $diagnosis = ICD10::search($search)->paginate(50);
        else
            $diagnosis = ICD10::orderBy('id', 'desc')->paginate(10);
        return json_encode($diagnosis);
	}

	public function getDiagnosisByKasus($kasus_id){

		$diagnosis = Diagnosis::with('icd10')->where('kasus_id',$kasus_id)->where('utama',1)->first();
		
		if (empty($diagnosis)) {
			$diagnosis = Diagnosis::with('icd10')->where('kasus_id',$kasus_id)->first();
		}

		return $diagnosis;
	}

	public function fetchSuggestDiagnosis()
	{
		$diagnosis = ViewDiagnosisUserTotal::where('user_id',Auth::user()->id)->orderBy('total','desc')->take(10)->get();
		return $diagnosis;
	}

	public function historiDiagnosis($nomor_kasus)
	{	
		$pasien_id = Kasus::where('nomor_kasus',$nomor_kasus)->pluck('pasien_id')->first();
		$pasien = Pasien::find($pasien_id);
		$all_kasus = Kasus::where('pasien_id',$pasien_id)->pluck('id')->toArray();
		$diagnosis = Diagnosis::whereIn('kasus_id', $all_kasus)->with(['creator', 'icd10'])->orderBy('utama','desc')->orderBy('kasus_id','desc')->get();
		// dd($diagnosis);
		$data['diagnosiss'] = [];
		$data['pasien'] = $pasien;
		foreach ($diagnosis as $value) 
		{	
			if(empty($data['diagnosiss'][$value->kasus_id]))
			{
				$data['diagnosiss'][$value->kasus_id] = [];
				array_push($data['diagnosiss'][$value->kasus_id],$value);	
			}
			else
			{
				array_push($data['diagnosiss'][$value->kasus_id],$value);
			}
		}
		// dd($data);
		return view('kasus.datamedis.content.diagnosis.histori',$data);
	}

    public function hasDiagnosis($kasus_id,$code_icd)
    {
        $icd10 = ICD10::where('code_icd',$code_icd)->first();
        $diagnosis = Diagnosis::where('kasus_id',$kasus_id)->where('icd_10',$icd10->id)->get();

        if(count($diagnosis) > 0) return 1;
        else return 0;
    }
}
