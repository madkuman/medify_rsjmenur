<?php

namespace App\Http\Controllers\Kasus\Asesmen\ObservasiTransfusiDarah;

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

			$transfusi_darah = [];
			$input = $req->all();
			foreach($input as $key => $val){
				if($key == '_token') continue;
				if($key == 'kasus') continue;
				$transfusi_darah[$key] = $val;
			}

			$alatBantu = new AlatBantu();
			$alatBantu->kasus_id = $kasus->id;
			$alatBantu->type = "Observasi Transfusi Darah";
			$alatBantu->created_by = Auth::user()->id;
			$alatBantu->val = json_encode($transfusi_darah);
			$alatBantu->save();

			$status = 1;
			$message = 'Asesmen Observasi Transfusi Darah berhasil dibuat';
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
				$message = 'Asesmen Observasi Transfusi Darah gagal dibuat!';
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
			$jiwa->delete();

			$status = 1;
			$message = 'Asesmen Observasi Transfusi Darah berhasil dihapus!';
			$title = 'Berhasil!';

			$log = app('App\Http\Controllers\Kasus\Log\CreateController')
			->create($kasus->id,'delete','alat-resume-pulang',$jiwa->id);

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
				$message = 'Asesmen Observasi Transfusi Darah gagal dihapus!';
				$title = 'Error!';

				return back()
                    ->with('message', $message)
                    ->with('title',$title)
                    ->with('status', $status);
			}
		}
	}
}
