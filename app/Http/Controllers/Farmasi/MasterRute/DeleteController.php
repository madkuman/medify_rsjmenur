<?php

namespace App\Http\Controllers\Farmasi\MasterRute;

use App\Models\Farmasi\MasterRute;
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
    		$master_rute = MasterRute::find($request->id);
    		$master_rute->deleted_by = Auth::user()->id;
            $master_rute->save();
    		$master_rute->delete();
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
        return redirect('farmasi/'.$farmasi.'/master-rute')
                ->with('message', 'Master Rute berhasil dihapus')
                ->with('status', 1)
                ->with('title', 'Sukses');
    }
}
