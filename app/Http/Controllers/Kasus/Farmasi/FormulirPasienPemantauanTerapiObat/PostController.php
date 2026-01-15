<?php

namespace App\Http\Controllers\Kasus\Farmasi\FormulirPasienPemantauanTerapiObat;

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

			$terapi = [];
			$input = $req->all();
			foreach($input as $key => $val){
				if($key == '_token') continue;
				if($key == 'kasus') continue;
				if($key == 'id') continue;
				$terapi[$key] = $val == "on" ? 'Ya' : $val ;
			}

			$alatBantu = new AlatBantu;
			$alatBantu->kasus_id = $kasus->id;
			$alatBantu->type = "Formulir Pasien Pemantauan Terapi Obat";
			$alatBantu->created_by = Auth::user()->id;
			$alatBantu->val = json_encode($terapi);
			$alatBantu->save();

			$status = 1;
			$message = 'Formulir Pasien Pemantauan Terapi Obat berhasil dibuat';
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
				$message = 'Formulir Pasien Pemantauan Terapi Obat gagal dibuat!';
				$title = 'Error!';

				return back()
                    ->with('message', $message)
                    ->with('title',$title)
                    ->with('status', $status);
			}
		}
	}
}
