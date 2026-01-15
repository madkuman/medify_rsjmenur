<?php

namespace App\Http\Controllers\Farmasi\MasterJenisInteraksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Farmasi\MasterJenisInteraksi;
use DB;
use Auth;

class DeleteController extends Controller
{
    public function delete(Request $request, $farmasi)
    {
        //dd($request);
        DB::connection('farmasi')->beginTransaction();

    	try {
    		$katalog = MasterJenisInteraksi::find($request->id);
    		$katalog->deleted_by = Auth::user()->id;
            $katalog->save();
    		$katalog->delete();
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
        return redirect('farmasi/'.$farmasi.'/master-jenis-interaksi')
                ->with('message', 'Jenis Interaksi berhasil dihapus')
                ->with('status', 1)
                ->with('title', 'Sukses');
    }
}
