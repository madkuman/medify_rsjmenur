<?php

namespace App\Http\Controllers\Farmasi\Katalog;

use App\Models\Farmasi\Katalog;
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
            $katalog = Katalog::find($request->id);
            if(!is_null(Katalog::where('nama', $request->nama)->first()))
            return redirect('/farmasi/'.$farmasi.'/katalog/'.$katalog->id)
                    ->with('status', -1)
                    ->with('message', 'Katalog yang sama telah terdaftar')
                    ->with('title', 'Gagal');

			$katalog->nama = $request->nama;
			$katalog->updated_by = Auth::user()->id;
			$katalog->save();
			DB::connection('farmasi')->commit();
			return redirect('farmasi/'.$farmasi.'/katalog/'.$katalog->id)
						->with('status', 1)
						->with('message', 'Katalog berhasil diubah')
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
