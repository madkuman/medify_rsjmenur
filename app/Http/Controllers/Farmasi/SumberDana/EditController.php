<?php

namespace App\Http\Controllers\Farmasi\SumberDana;

use App\Models\Farmasi\SumberDana;
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
            $sumber_dana = SumberDana::find($request->id);
            if(!is_null(SumberDana::where('nama', $request->nama)->first()))
            return redirect('/farmasi/'.$farmasi.'/sumber-dana/'.$sumber_dana->id)
                    ->with('status', -1)
                    ->with('message', 'Sumber Dana yang sama telah terdaftar')
                    ->with('title', 'Gagal');

			$sumber_dana->nama = $request->nama;
            $sumber_dana->kategori_id = $request->kategori_id;
			$sumber_dana->updated_by = Auth::user()->id;
			$sumber_dana->save();
			DB::connection('farmasi')->commit();
			return redirect('farmasi/'.$farmasi.'/sumber-dana/'.$sumber_dana->id)
						->with('status', 1)
						->with('message', 'Sumber Dana berhasil diubah')
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
