<?php

namespace App\Http\Controllers\Farmasi\MasterBahanAktif;

use App\Models\Farmasi\MasterBahanAktif;
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

            if(!is_null(MasterBahanAktif::where('nama', $request->nama)->first()))
                return redirect('/farmasi/'.$farmasi.'/master-bahan-aktif')
                    ->with('status', -1)
                    ->with('message', 'Bahan Aktif yang sama telah terdaftar')
                    ->with('title', 'Gagal');

			$master_bahan_aktif = new MasterBahanAktif();
			$master_bahan_aktif->nama = $request->nama;
			$master_bahan_aktif->created_by = Auth::user()->id;
			$master_bahan_aktif->save();

			DB::connection('farmasi')->commit();
			return redirect('farmasi/'.$farmasi.'/master-bahan-aktif')
				->with('status', 1)
				->with('message', 'Bahan Aktif baru berhasil dibuat')
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
