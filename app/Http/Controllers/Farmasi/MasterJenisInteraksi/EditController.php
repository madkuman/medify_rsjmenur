<?php

namespace App\Http\Controllers\Farmasi\MasterJenisInteraksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Farmasi\MasterJenisInteraksi;
use DB;
use Auth;

class EditController extends Controller
{
    public function edit(Request $request, $farmasi)
	{

		DB::connection('farmasi')->beginTransaction();
		
		try {
            $jenis_interaksi = MasterJenisInteraksi::find($request->id);
            if(!is_null(MasterJenisInteraksi::where('nama', $request->nama)->first()))
            return redirect('/farmasi/'.$farmasi.'/master-jenis-interaksi/'.$jenis_interaksi->id)
                    ->with('status', -1)
                    ->with('message', 'Jenis Interaksi yang sama telah terdaftar')
                    ->with('title', 'Gagal');

			$jenis_interaksi->nama = $request->nama;
			$jenis_interaksi->updated_by = Auth::user()->id;
			$jenis_interaksi->save();
			DB::connection('farmasi')->commit();
			return redirect('farmasi/'.$farmasi.'/master-jenis-interaksi/'.$jenis_interaksi->id)
						->with('status', 1)
						->with('message', 'Jenis Interaksi berhasil diubah')
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
