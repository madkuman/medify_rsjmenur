<?php

namespace App\Http\Controllers\Kasus\Lokasi;

use App\Models\Kasus\CPPT;
use App\Models\Kasus\Diagnosis;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\Lokasi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use DB;
use Bugsnag;

class CreateController extends Controller
{
    public function createNewLokasi(Request $request) {

        DB::connection('kasus')->beginTransaction();
        DB::connection('mysql')->beginTransaction();
        try
        {
            $nomorKasus = $request->input('nomor-kasus');
            $kasusId = Kasus::where('nomor_kasus', $nomorKasus)->pluck('id')->first();

            $lokasi = new Lokasi();
            $lokasi->kasus_id = $kasusId;
            $lokasi->lokasi = $request->input('lokasi');
            $lokasi->alasan = $request->input('alasan');
            $lokasi->created_by = Auth::user()->id;
            $lokasi->save();

            $status = 1;
            $message = 'Pasien berhasil dipindahkan!';
            $title = 'Berhasil!';


            $log = app('App\Http\Controllers\Kasus\Log\CreateController')
            ->create($kasusId,'create','lokasi',$lokasi->id);

            DB::connection('kasus')->commit();
            DB::connection('mysql')->commit();
            return back()
            ->with('active_nav','lokasi')
            ->with('message', $message)
            ->with('title',$title)
            ->with('status', $status);

        } catch (\Exception $e) {
           
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);

            DB::connection('kasus')->rollback();
            DB::connection('mysql')->rollback();
            
        }
    }
}
