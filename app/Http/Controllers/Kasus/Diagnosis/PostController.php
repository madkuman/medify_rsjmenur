<?php

namespace App\Http\Controllers\Kasus\Diagnosis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Diagnosis;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\ICD10;
use DB;
use Bugsnag;
use Auth;

class PostController extends Controller
{
	public function delete(Request $request)
	{
		DB::connection('kasus')->beginTransaction();
		DB::connection('mysql')->beginTransaction();
		try
		{
			$diagnosis = Diagnosis::find($request->id);
			$kasusId = $diagnosis->kasus_id;
			$diagnosis->delete();

			$status = 1;
			$message = 'Diagnosis berhasil dihapus!';
			$title = 'Berhasil!';
			$nomorKasus = Kasus::where('id',$kasusId)->first();

			$log = app('App\Http\Controllers\Kasus\Log\CreateController')
			->create($kasusId,'delete','diagnosis',$diagnosis->id);


			DB::connection('kasus')->commit();
			DB::connection('mysql')->commit();
			return redirect('/kasus/'.$nomorKasus->nomor_kasus.'/datamedis/diagnosis')
			->with('active_nav','diagnosis')
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);

		} catch (\Exception $e) {

			app('App\Http\Controllers\Error\Handler')->bugsnag($e);

			DB::connection('kasus')->rollback();
			DB::connection('mysql')->rollback();
			
		}
	}


	public function toggleUtama(Request $request)
	{
		DB::connection('kasus')->beginTransaction();
		DB::connection('mysql')->beginTransaction();
		try
		{
			$diagnosis = Diagnosis::find($request->diagnosis_id);
			$diagnosis->utama = $diagnosis->utama == 1 ? 0 : 1;
			$diagnosis->save();

			$kasusId = $diagnosis->kasus_id;

			$kasus = Kasus::find($kasusId);
			if($diagnosis->utama == 1)
			{
				$kasus->judul_kasus = $diagnosis->icd10->long_desc;
				$kasus->judul_kasus_changed = 1;
				$kasus->save();
			}
			$status = 1;
			$message = 'Diagnosis berhasil diubah!';
			$title = 'Berhasil!';


			$log = app('App\Http\Controllers\Kasus\Log\CreateController')
			->create($kasusId,'edit','diagnosis',$diagnosis->id);


			DB::connection('kasus')->commit();
			DB::connection('mysql')->commit();
			return redirect('/kasus/'.$kasus->nomor_kasus.'/datamedis/diagnosis')
			->with('active_nav','diagnosis')
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);

		} catch (\Exception $e) {
			
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);

			DB::connection('kasus')->rollback();
			DB::connection('mysql')->rollback();
			
		}
	}

	public function fromCPPTtoDiagnosis($kasus_id, $assessment)
	{
		if(Auth::user()->profesi != 1) return 0;
		$dx_new = explode("\n", $assessment);
		foreach($dx_new as $item)
		{
			$code_icd_temp = explode(" - ", $item);
			$code_icd = $code_icd_temp[0];

			$icd10 = ICD10::where('code_icd',$code_icd)->first();
			if(!empty($icd10->id))
			{
				$diagnosis = Diagnosis::where('kasus_id',$kasus_id)->where('icd_10',$icd10->id)->get();
				if(count($diagnosis) == 0)
				{
					$kasus = Kasus::find($kasus_id);
					$diagnosis = new Diagnosis;
					$diagnosis->kasus_id = $kasus_id;
					$diagnosis->utama = 0;
					$diagnosis->type = 'sekunder';
					$diagnosis->icd_10 = $icd10->id;
					$diagnosis->created_by = Auth::user()->id;
					$diagnosis->lokasi_id = $kasus->lokasi->lokasi_id;
					$diagnosis->save();
				}
			}
		}
	}

	public function updateType($id, $diagnosis_id, $type)
	{
		DB::connection('kasus')->beginTransaction();
		DB::connection('mysql')->beginTransaction();
		try
		{
			$diagnosis = Diagnosis::find($diagnosis_id);
		
			$diagnosis->type = $type;

			if ($type == 'utama') {
				$diagnosis_lainnya = Diagnosis::where('kasus_id', $diagnosis->kasus_id)->where('id', '!=', $diagnosis_id)->where('type', '!=', 'sekunder')->update(['type' => 'komplikasi', 'utama' => 0]);

				$diagnosis->utama = 1;
			}else{
				if ($type == 'sekunder') {
					$diagnosis_lainnya = Diagnosis::where('kasus_id', $diagnosis->kasus_id)->where('id', '!=', $diagnosis_id)->where('type', 'sekunder')->update(['type' => 'komplikasi']);
				}	

				$diagnosis->utama = 0;
			}

			$diagnosis->save();

			$kasusId = $diagnosis->kasus_id;

			$kasus = Kasus::find($kasusId);
			if($diagnosis->utama == 1)
			{
				$kasus->judul_kasus = $diagnosis->icd10->long_desc;
				$kasus->judul_kasus_changed = 1;
				$kasus->save();
			}
			$status = 1;
			$message = 'Diagnosis berhasil diubah!';
			$title = 'Berhasil!';


			$log = app('App\Http\Controllers\Kasus\Log\CreateController')
			->create($kasusId,'edit','diagnosis',$diagnosis->id);


			DB::connection('kasus')->commit();
			DB::connection('mysql')->commit();
			return redirect('/kasus/'.$kasus->nomor_kasus.'/datamedis/diagnosis')
			->with('active_nav','diagnosis')
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);

		} catch (\Exception $e) {
			
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);

			DB::connection('kasus')->rollback();
			DB::connection('mysql')->rollback();
			
		}
	}

	public function updateKankerStadium(Request $request, $nomor_kasus)
	{
		DB::connection('kasus')->beginTransaction();
		try
		{
			$diagnosis = Diagnosis::find($request->id);
			$diagnosis->kanker_stadium = $request->stadium;
			$diagnosis->save();

			$status = 1;
			$message = 'Diagnosis berhasil diubah!';
			$title = 'Berhasil!';

			$log = app('App\Http\Controllers\Kasus\Log\CreateController')
			->create($diagnosis->kasus_id,'edit','diagnosis',$diagnosis->id);

			DB::connection('kasus')->commit();

			return back()
			->with('active_nav','diagnosis')
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);

		} catch (\Exception $e) {
			
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);

			DB::connection('kasus')->rollback();
			
		}
	}
}
