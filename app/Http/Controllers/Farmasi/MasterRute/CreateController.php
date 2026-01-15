<?php

namespace App\Http\Controllers\Farmasi\MasterRute;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Farmasi\MasterRute;
use DB;
use Auth;

class CreateController extends Controller
{
    public function create(Request $request,$farmasi)
	{

		DB::connection('farmasi')->beginTransaction();

		try{

            if(!is_null(MasterRute::where('nama', $request->nama)->first()))
                return redirect('/farmasi/'.$farmasi.'/master-rute')
                    ->with('status', -1)
                    ->with('message', 'Rute yang sama telah terdaftar')
                    ->with('title', 'Gagal');

			$katalog = new MasterRute();
			$katalog->nama = $request->nama;
			$katalog->created_by = Auth::user()->id;
			$katalog->save();

			DB::connection('farmasi')->commit();
			return redirect('farmasi/'.$farmasi.'/master-rute')
				->with('status', 1)
				->with('message', 'Rute baru berhasil dibuat')
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
