<?php

namespace App\Http\Controllers\Farmasi\Katalog;

use App\Models\Farmasi\Katalog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Auth;

class CreateController extends Controller
{
    public function create(Request $request,$farmasi)
	{

		DB::connection('farmasi')->beginTransaction();

		try{

            if(!is_null(Katalog::where('nama', $request->nama)->first()))
                return redirect('/farmasi/'.$farmasi.'/katalog')
                    ->with('status', -1)
                    ->with('message', 'Katalog yang sama telah terdaftar')
                    ->with('title', 'Gagal');

			$katalog = new Katalog();
			$katalog->nama = $request->nama;
			$katalog->created_by = Auth::user()->id;
			$katalog->save();

			DB::connection('farmasi')->commit();
			return redirect('farmasi/'.$farmasi.'/katalog')
				->with('status', 1)
				->with('message', 'Katalog baru berhasil dibuat')
				->with('title', 'Sukses');
		}
		catch (\Exception $e) 
		{
			app('App\Http\Controllers\Error\Handler')->bugsnag($e);
    		DB::connection('farmasi')->rollBack();

	     	return redirect()->back()
	      				->with('message', 'Terjadi kesalahan server, Silahkan coba beberapa saat lagi')
	      				->with('status', -1)
                		->with('title', 'Gagal');
		}
	}
}
