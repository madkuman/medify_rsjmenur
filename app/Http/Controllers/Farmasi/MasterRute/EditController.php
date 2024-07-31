<?php

namespace App\Http\Controllers\Farmasi\MasterRute;

use App\Models\Farmasi\MasterRute;
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
            $master_rute = MasterRute::find($request->id);
            if(!is_null(MasterRute::where('nama', $request->nama)->first()))
            return redirect('/farmasi/'.$farmasi.'/master-rute/'.$master_rute->id)
                    ->with('status', -1)
                    ->with('message', 'Master Rute yang sama telah terdaftar')
                    ->with('title', 'Gagal');

			$master_rute->nama = $request->nama;
			$master_rute->updated_by = Auth::user()->id;
			$master_rute->save();
			DB::connection('farmasi')->commit();
			return redirect('farmasi/'.$farmasi.'/master-rute/'.$master_rute->id)
						->with('status', 1)
						->with('message', 'Master Rute berhasil diubah')
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
