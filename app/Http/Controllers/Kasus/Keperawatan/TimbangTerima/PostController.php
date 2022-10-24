<?php

namespace App\Http\Controllers\Kasus\Keperawatan\TimbangTerima;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\TimbangTerima;
use DB, Auth;

class PostController extends Controller
{
	
	public function save($nomorKasus, Request $request) 
    {
        DB::connection('kasus')->beginTransaction();
        try
        {
            // dd($request->all());
        	$kasus = Kasus::where('nomor_kasus', $nomorKasus)->first();

            $timbang = TimbangTerima::find($request->id);
            if(!isset($timbang)){
                $timbang = new TimbangTerima;
                $timbang->created_by = Auth::user()->id;
                $message = 'Timbang terima baru berhasil dibuat!';
            }else{
                $timbang->updated_by = Auth::user()->id;
                $message = 'Timbang terima baru berhasil di update!';
            }
            
            $timbang->kasus_id = $kasus->id;
            $timbang->subjective = $request->subjective;
            $timbang->objective = $request->objective;
            $timbang->assessment = $request->assessment;
            $timbang->plan = $request->plan;
            $timbang->ppa = $request->ppa;
            $timbang->evaluasi = $request->evaluasi;
            $timbang->save();

            $status = 1;
            $title = 'Berhasil!';


            $log = app('App\Http\Controllers\Kasus\Log\CreateController')
            ->create($kasus->id,'create','AsesmenAwal',$timbang->id,$kasus->id);

            DB::connection('kasus')->commit();
            return redirect('/kasus/'.$nomorKasus.'/keperawatan/timbang-terima')
            ->with('message', $message)
            ->with('active_nav','AsesmenAwal')
            ->with('title',$title)
            ->with('status', $status);
        } catch (\Exception $e) {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            DB::connection('kasus')->rollback();

            $status = -1;
            $message = 'Timbang terima gagal dibuat!';
            $title = 'Gagal!';

            return redirect('/kasus/'.$nomorKasus.'/keperawatan/timbang-terima')
            ->with('message', $message)
            ->with('active_nav','AsesmenAwal')
            ->with('title',$title)
            ->with('status', $status);
        }
    }

    public function delete(Request $request, $nomor_kasus)
    {
        DB::connection('kasus')->beginTransaction();
        DB::connection('mysql')->beginTransaction();
        //dd($request);
        try
        {
            $timbang = TimbangTerima::find($request->id);
            
            $kasus = Kasus::where('id',$timbang->kasus_id)->first();
            $log = app('App\Http\Controllers\Kasus\Log\CreateController')
            ->create($kasus->id,'delete','timbang terima',$timbang->id);
            $timbang->delete();

            $status = 1;
            $message = 'Timbang terima berhasil dihapus!';
            $title = 'Berhasil!';

            DB::connection('kasus')->commit();
            DB::connection('mysql')->commit();
            return redirect('/kasus/'.$kasus->nomor_kasus.'/keperawatan/timbang-terima')
            ->with('active_nav','timbang')
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
