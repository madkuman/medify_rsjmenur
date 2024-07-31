<?php

namespace App\Http\Controllers\Farmasi\MasterSatuanKekuatan;

use App\Models\Farmasi\MasterSatuanKekuatan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Auth;

class EditController extends Controller
{
    public function edit(Request $request, $farmasi)
	{

		DB::connection('farmasi')->beginTransaction();
		
		try {
            $satuan_kekuatan = MasterSatuanKekuatan::find($request->id);
            if(!is_null(MasterSatuanKekuatan::where('nama', $request->nama)->first()))
            return redirect('/farmasi/'.$farmasi.'/master-satuan-kekuatan/'.$satuan_kekuatan->id)
                    ->with('status', -1)
                    ->with('message', 'Satuan Kekuatan yang sama telah terdaftar')
                    ->with('title', 'Gagal');

			$satuan_kekuatan->nama = $request->nama;
			$satuan_kekuatan->updated_by = Auth::user()->id;
			$satuan_kekuatan->save();
			DB::connection('farmasi')->commit();
			return redirect('farmasi/'.$farmasi.'/master-satuan-kekuatan/'.$satuan_kekuatan->id)
						->with('status', 1)
						->with('message', 'Satuan Kekuatan berhasil diubah')
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
