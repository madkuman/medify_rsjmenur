<?php

namespace App\Http\Controllers\Farmasi\MasterRakObat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Farmasi\MasterRakObat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CreateController extends Controller
{
    public function create(Request $request,$farmasi)
	{
		DB::connection('farmasi')->beginTransaction();

		try {
            if(!is_null(MasterRakObat::where('nama', $request->nama)->first()))
                return redirect('/farmasi/'.$farmasi.'/master-rak-obat')
                    ->with('status', -1)
                    ->with('message', 'Rak Obat yang sama telah terdaftar')
                    ->with('title', 'Gagal');

			$katalog = new MasterRakObat;
			$katalog->nama = $request->nama;
			$katalog->created_by = Auth::user()->id;
			$katalog->save();

			DB::connection('farmasi')->commit();
			return redirect('farmasi/'.$farmasi.'/master-rak-obat')
				->with('status', 1)
				->with('message', 'Rak Obat baru berhasil dibuat')
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
