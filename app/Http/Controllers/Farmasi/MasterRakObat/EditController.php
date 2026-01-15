<?php

namespace App\Http\Controllers\Farmasi\MasterRakObat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Farmasi\MasterRakObat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EditController extends Controller
{
    public function edit(Request $request, $farmasi)
	{
		DB::connection('farmasi')->beginTransaction();

		try {
            $master_rak_obat = MasterRakObat::find($request->id);
            if(!is_null(MasterRakObat::where('nama', $request->nama)->first()))
            return redirect('/farmasi/'.$farmasi.'/master-rak-obat/'.$master_rak_obat->id)
                    ->with('status', -1)
                    ->with('message', 'Master Rak Obat yang sama telah terdaftar')
                    ->with('title', 'Gagal');

			$master_rak_obat->nama = $request->nama;
			$master_rak_obat->updated_by = Auth::user()->id;
			$master_rak_obat->save();
			DB::connection('farmasi')->commit();
			return redirect('farmasi/'.$farmasi.'/master-rak-obat/'.$master_rak_obat->id)
					->with('status', 1)
					->with('message', 'Master Rak Obat berhasil diubah')
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
