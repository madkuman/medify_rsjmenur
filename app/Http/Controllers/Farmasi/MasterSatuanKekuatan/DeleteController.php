<?php

namespace App\Http\Controllers\Farmasi\MasterSatuanKekuatan;

use App\Models\Farmasi\MasterSatuanKekuatan;
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
    		$satuan_kekuatan = MasterSatuanKekuatan::find($request->id);
    		$satuan_kekuatan->deleted_by = Auth::user()->id;
            $satuan_kekuatan->save();
    		$satuan_kekuatan->delete();
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
        return redirect('farmasi/'.$farmasi.'/master-satuan-kekuatan')
                ->with('message', 'Satuan Kekuatan berhasil dihapus')
                ->with('status', 1)
                ->with('title', 'Sukses');
    }
}
