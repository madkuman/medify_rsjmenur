<?php

namespace App\Http\Controllers\Urikkes\Pengaturan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Urikkes\Paket;
use App\Models\Urikkes\DokterUrikkes;
use App\Models\Urikkes\PaketTarif;
use DB;

class PostController extends Controller
{
    public function dokterSave(Request $request)
    {

        $id = $request->dokter_id;
        try {
            DB::connection('urikkes')->beginTransaction();   
        
            if($id != 0)
                $dokter = DokterUrikkes::find($id);
            else
                $dokter = new DokterUrikkes;
            $dokter->nama = $request->nama;
            $dokter->sebagai = $request->sebagai;
            $dokter->keterangan = $request->keterangan;
            $dokter->save();

            DB::connection('urikkes')->commit();
            return redirect(url('urikkes/pengaturan/dokter'));
        } catch (Exception $e) {
            DB::connection('urikkes')->rollBack();
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
        }
    }
    public function dokterDelete(Request $request)
    {
        $id = $request->dokter_id;
        try {
            DB::connection('urikkes')->beginTransaction();   
        
            $dokter = DokterUrikkes::find($id);
            $dokter->delete();
            DB::connection('urikkes')->commit();
        } catch (Exception $e) {
            DB::connection('urikkes')->rollBack();
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
        }   
    }
	public function simpan(Request $request)
    {
        try {
            DB::connection('urikkes')->beginTransaction();
            
            $paket = app('App\Http\Controllers\Urikkes\Paket\CreateController')->create($request);
            
            DB::connection('urikkes')->commit();
            return $paket->id;
        } catch (Exception $e) {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            DB::connection('urikkes')->rollBack();
        }
    }    

    public function hapus(Request $request)
    {
    	$id = $request->paket_id;
    	try {
    		DB::connection('urikkes')->beginTransaction();
    		$paket = Paket::find($id);
    		$paket->delete();
    		DB::connection('urikkes')->commit();
   		} catch (Exception $e) {
    		DB::connection('urikkes')->rollBack();
    	}
    }
}
