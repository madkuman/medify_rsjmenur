<?php

namespace App\Http\Controllers\Farmasi\MasterRakObat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Farmasi\MasterRakObat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DeleteController extends Controller
{
    public function delete(Request $request, $farmasi)
    {
        DB::connection('farmasi')->beginTransaction();

    	try {
    		$master_rak_obat = MasterRakObat::find($request->id);
    		$master_rak_obat->deleted_by = Auth::user()->id;
            $master_rak_obat->save();
    		$master_rak_obat->delete();
            DB::connection('farmasi')->commit();
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
        return redirect('farmasi/'.$farmasi.'/master-rak-obat')
                ->with('message', 'Master Rak Obat berhasil dihapus')
                ->with('status', 1)
                ->with('title', 'Sukses');
    }
}
