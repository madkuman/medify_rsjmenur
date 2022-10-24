<?php

namespace App\Http\Controllers\Farmasi\SumberDana;

use App\Models\Farmasi\SumberDana;
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

            if(!is_null(SumberDana::where('nama', $request->nama)->first()))
                return redirect('/farmasi/'.$farmasi.'/sumber-dana')
                    ->with('status', -1)
                    ->with('message', 'Sumber Dana yang sama telah terdaftar')
                    ->with('title', 'Gagal');

			$sumber_dana = new SumberDana();
			$sumber_dana->nama = $request->nama;
			$sumber_dana->kategori_id = $request->kategori_id;
			$sumber_dana->created_by = Auth::user()->id;
			$sumber_dana->save();

			DB::connection('farmasi')->commit();
			return redirect('farmasi/'.$farmasi.'/sumber-dana')
				->with('status', 1)
				->with('message', 'Sumber Dana baru berhasil dibuat')
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
