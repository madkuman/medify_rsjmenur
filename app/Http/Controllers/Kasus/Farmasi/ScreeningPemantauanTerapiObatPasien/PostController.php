<?php

namespace App\Http\Controllers\Kasus\Farmasi\ScreeningPemantauanTerapiObatPasien;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\AlatBantu;
use App\Models\Kasus\Kasus;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function create(Request $request, $nomor_kasus)
	{	
		try {
			DB::connection('kasus')->beginTransaction();
			$kasus = Kasus::where('nomor_kasus', $nomor_kasus)->first();

			$terapi_pasien = [];
			$input = $request->all();

            foreach($input as $key => $val){
				if($key == '_token') continue;
				if($key == 'kasus') continue;
				$terapi_pasien[$key] = $val;
			}

			$alatBantu = new AlatBantu();
			$alatBantu->kasus_id = $kasus->id;
			$alatBantu->type = "Screening Pemantauan Terapi Obat Pasien";
			$alatBantu->created_by = Auth::user()->id;
			$alatBantu->val = json_encode($terapi_pasien);
			$alatBantu->save();

			$status = 1;
			$message = 'Screening Pemantauan Terapi Obat Pasien berhasil dibuat';
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
				$message = 'Screening Pemantauan Terapi Obat Pasien gagal dibuat!';
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
			$terapi_pasien = AlatBantu::find($id);
			$terapi_pasien->delete();

			$status = 1;
			$message = 'Screening Pemantauan Terapi Obat Pasien berhasil dihapus!';
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
				$message = 'Screening Pemantauan Terapi Obat Pasien gagal dihapus!';
				$title = 'Error!';

				return back()
                    ->with('message', $message)
                    ->with('title',$title)
                    ->with('status', $status);
			}
		}
	}


}
