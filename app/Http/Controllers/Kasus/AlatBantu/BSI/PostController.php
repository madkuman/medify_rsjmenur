<?php

namespace App\Http\Controllers\Kasus\AlatBantu\BSI;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\AlatBantu;
use App\Models\Kasus\Kasus;
use Auth;
use DB;

class PostController extends Controller
{	

	public function create($nomor_kasus, Request $request)
    	{
		$kasus = Kasus::where('nomor_kasus',$nomor_kasus)->first();
		
		$input = $request->all();
		$count = 0;
		foreach($input as $key => $val){
			if($key == '_token') continue;
			if($key == 'lokasi_id') continue;
            if($key == 'kasus') continue;
			$bsi[$key] = $val;
			if($val == 1) $count++;
		}
		$bsi['skor'] = $count;


		$alatBantu = new AlatBantu;
		$alatBantu->kasus_id = $kasus->id;
		$alatBantu->type = 'bsi';
		$alatBantu->lokasi_id = $request->lokasi_id;
		$alatBantu->parent_id = $request->parent_id;
		$alatBantu->val = json_encode($bsi);
		$alatBantu->created_by = Auth::user()->id;
		$alatBantu->save();


		$status = 1;
		$message = 'Form BSI berhasil dibuat';
		$title = 'Berhasil!';



		$log = app('App\Http\Controllers\Kasus\Log\CreateController')
		->create($kasus->id,'create','alat-bsi',$alatBantu->id);


		return back()
		->with('message', $message)
		->with('title',$title)
		->with('status', $status);
    	}


    	public function createAudit($nomor_kasus, Request $request)
    	{
		$kasus = Kasus::where('nomor_kasus',$nomor_kasus)->first();
		
		$input = $request->all();
		$count = 0;
		foreach($input as $key => $val){
			if($key == '_token') continue;
			if($key == 'lokasi_id') continue;
			$isk[$key] = $val;
			if($val) $count++;
		}
		$isk['skor'] = $count;


		$alatBantu = new AlatBantu;
		$alatBantu->kasus_id = $kasus->id;
		$alatBantu->type = 'bsi-audit';
		$alatBantu->lokasi_id = $request->lokasi_id;
		$alatBantu->val = json_encode($isk);
		$alatBantu->created_by = Auth::user()->id;
		$alatBantu->save();


		$status = 1;
		$message = 'Form Audit BSI berhasil dibuat';
		$title = 'Berhasil!';



		$log = app('App\Http\Controllers\Kasus\Log\CreateController')
		->create($kasus->id,'create','alat-bsi-audit',$alatBantu->id);


		return redirect('kasus/'.$nomor_kasus.'/alat-bantu/bsi#tab-audit')
		->with('message', $message)
		->with('title',$title)
		->with('status', $status);
    	}
    	
    	public function editMaster($nomor_kasus, Request $request)
    	{
    		$kasus = Kasus::where('nomor_kasus',$nomor_kasus)->first();
    		$input = $request->all();
    		$count = 0;
    		if(!empty($input['lokasi_lainnya'])) $input['lokasi'] = '';
    		if(!empty($input['nomor_lainnya'])) $input['nomor'] = '';

    		foreach($input as $key => $val){
    			if($key == '_token') continue;
    			$bsi[$key] = $val;
    		}
    		
			if(empty($request->id)) $master_bsi = new AlatBantu;
			else $master_bsi = AlatBantu::find($request->id);

    		$master_bsi->kasus_id = $kasus->id;
    		$master_bsi->type = 'master-bsi';
			$master_bsi->lokasi_id = $request->lokasi_id;
    		$master_bsi->val = json_encode($bsi);
    		$master_bsi->created_by = Auth::user()->id;
    		$master_bsi->save();


    		$status = 1;
    		$message = 'Form BSI berhasil dibuat';
    		$title = 'Berhasil!';



    		$log = app('App\Http\Controllers\Kasus\Log\CreateController')
    		->create($kasus->id,'edit','alat-master-bsi',$master_bsi->id);


    		return back()
    		->with('message', $message)
    		->with('title',$title)
    		->with('status', $status);
    	}

    	public function delete($nomor_kasus, Request $request)
    	{
    		DB::connection('kasus')->beginTransaction();
		try
		{
			$kasus = Kasus::where('nomor_kasus',$nomor_kasus)->first();
			$id = $request->id;
			$bsi = AlatBantu::find($id);
			$bsi->delete();

			$status = 1;
			$message = 'Skor BSI berhasil dihapus!';
			$title = 'Berhasil!';

			$log = app('App\Http\Controllers\Kasus\Log\CreateController')
			->create($kasus->id,'delete','alat-bsi',$bsi->id);

			DB::connection('kasus')->commit();

			return back()
			->with('message', $message)
			->with('title',$title)
			->with('status', $status);

		}
		catch (\Exception $e) {


			DB::connection('kasus')->rollback();
			if(config('app.env') != 'production')
			{
				
				app('App\Http\Controllers\Error\Handler')->bugsnag($e);
			}
			else
			{

				$status = -1;
				$message = 'Skor BSI gagal dihapus!';
				$title = 'Error!';

				return back()
				->with('message', $message)
				->with('title',$title)
				->with('status', $status);
			}
		}
    	}
}
