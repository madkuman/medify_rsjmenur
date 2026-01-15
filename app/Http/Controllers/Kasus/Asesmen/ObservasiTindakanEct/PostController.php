<?php

namespace App\Http\Controllers\Kasus\Asesmen\ObservasiTindakanEct;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\AlatBantu;
use App\Models\Kasus\Kasus;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function create($nomor_kasus, Request $req)
	{	
		try {
			DB::connection('kasus')->beginTransaction();
			$kasus = Kasus::where('nomor_kasus',$nomor_kasus)->first();

			$ect = [];
			$input = $req->all();
			foreach($input as $key => $val){
				if($key == '_token') continue;
				if($key == 'kasus') continue;
				$ect[$key] = $val == "on" ? 'Ya' : $val ;
			}

			$alatBantu = new AlatBantu();
			$alatBantu->kasus_id = $kasus->id;
			$alatBantu->type = "Observasi Tindakan ECT";
			$alatBantu->created_by = Auth::user()->id;
			$alatBantu->val = json_encode($ect);
			$alatBantu->save();

			$status = 1;
			$message = 'Asesmen Observasi Tindakan ECT berhasil dibuat';
			$title = 'Berhasil!';

			DB::connection('kasus')->commit();
			return back()
                ->with('message', $message)
                ->with('title',$title)
                ->with('status', $status);

		} catch (Exception $e) {

			DB::connection('kasus')->rollback();
			if(config('app.env') != 'production')
			{
				app('App\Http\Controllers\Error\Handler')->bugsnag($e);
			}
			else
			{
				$status = -1;
				$message = 'Asesmen Observasi Tindakan ECT gagal dibuat!';
				$title = 'Error!';

				return back()
                    ->with('message', $message)
                    ->with('title',$title)
                    ->with('status', $status);
			}
		}
	}


    public function delete($nomor_kasus,Request $request)
	{
		DB::connection('kasus')->beginTransaction();
		try
		{	
			$kasus = Kasus::where('nomor_kasus',$nomor_kasus)->first();
			$id = $request->id;
			$jiwa = AlatBantu::find($id);
			$jiwa->deleted_by = Auth::user()->id;
			$jiwa->save();
			$jiwa->delete();

			$status = 1;
			$message = 'Asesmen Observasi Tindakan ECT berhasil dihapus!';
			$title = 'Berhasil!';

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
				$message = 'Asesmen Keperawatan Jiwa gagal dihapus!';
				$title = 'Error!';

				return back()
                    ->with('message', $message)
                    ->with('title',$title)
                    ->with('status', $status);
			}
		}
	}


	public function edit($nomor_kasus, Request $req)
	{	
		try {
			DB::connection('kasus')->beginTransaction();
			$kasus = Kasus::where('nomor_kasus',$nomor_kasus)->first();

			$ect = [];
			$input = $req->all();
			foreach($input as $key => $val){
				if($key == '_token') continue;
				if($key == 'kasus') continue;
				if($key == 'id') continue;
				$ect[$key] = $val == "on" ? 'Ya' : $val ;
			}

			$alatBantu = AlatBantu::find($req->id);
			$alatBantu->kasus_id = $kasus->id;
			$alatBantu->type = "Observasi Tindakan ECT";
			$alatBantu->updated_by = Auth::user()->id;
			$alatBantu->val = json_encode($ect);
			$alatBantu->save();

			$status = 1;
			$message = 'Asesmen Observasi Tindakan ECT berhasil diedit';
			$title = 'Berhasil!';


			DB::connection('kasus')->commit();
			return back()
                ->with('message', $message)
                ->with('title',$title)
                ->with('status', $status);

		} catch (Exception $e) {

			DB::connection('kasus')->rollback();
			if(config('app.env') != 'production')
			{
				app('App\Http\Controllers\Error\Handler')->bugsnag($e);
			}
			else
			{
				$status = -1;
				$message = 'Asesmen Observasi Tindakan ECT gagal diedit!';
				$title = 'Error!';

				return back()
                    ->with('message', $message)
                    ->with('title',$title)
                    ->with('status', $status);
			}
		}
	}

}
