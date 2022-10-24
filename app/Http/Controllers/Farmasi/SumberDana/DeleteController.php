<?php

namespace App\Http\Controllers\Farmasi\SumberDana;

use App\Models\Farmasi\SumberDana;
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
    		$sumber_dana = SumberDana::find($request->id);
    		$sumber_dana->deleted_by = Auth::user()->id;
            $sumber_dana->save();
    		$sumber_dana->delete();
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
        return redirect('farmasi/'.$farmasi.'/sumber-dana')
                ->with('message', 'Sumber Dana berhasil dihapus')
                ->with('status', 1)
                ->with('title', 'Sukses');
    }
}
