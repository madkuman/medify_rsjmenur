<?php

namespace App\Http\Controllers\Farmasi\MasterBahanAktif;

use App\Models\Farmasi\MasterBahanAktif;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Auth;

class DeleteController extends Controller
{
    public function delete(Request $request, $farmasi)
    {
        //dd($request);
        DB::connection('farmasi')->beginTransaction();

    	try {
    		$master_bahan_aktif = MasterBahanAktif::find($request->id);
    		$master_bahan_aktif->deleted_by = Auth::user()->id;
            $master_bahan_aktif->save();
    		$master_bahan_aktif->delete();
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
        return redirect('farmasi/'.$farmasi.'/master-bahan-aktif')
                ->with('message', 'Bahan Aktif berhasil dihapus')
                ->with('status', 1)
                ->with('title', 'Sukses');
    }
}
