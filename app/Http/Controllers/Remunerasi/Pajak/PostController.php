<?php

namespace App\Http\Controllers\Remunerasi\Pajak;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\Pegawai;
use App\Models\Remunerasi\Pajak;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Auth;
use DB;
use Bugsnag;


class PostController extends Controller
{

    public function create(Request $request){

        DB::connection('remunerasi')->beginTransaction();
        try{
            $beban_kerja =app('App\Http\Controllers\Remunerasi\BebanKerja\ReadController')->getByTanggal(substr($request->bulan_tahun,3));
            $resiko_kerja=app('App\Http\Controllers\Remunerasi\ResikoKerja\ReadController')->getByTanggal(substr($request->bulan_tahun,3));
            if(count($beban_kerja) == 0 || count($resiko_kerja) == 0){
                if(count($beban_kerja) == 0 && count($resiko_kerja) == 0){
                    $msg = 'Gagal, data beban kerja dan resiko kerja belum tersedia';
                }elseif (count($beban_kerja) == 0){
                    $msg = 'Gagal, data beban kerja belum tersedia';
                }else{
                    $msg = 'Gagal, data resiko kerja belum tersedia';
                }
                $status = -1;
                $title = 'Gagal';

                return redirect()->back()
                    ->with('message', $msg)
                    ->with('status', $status)
                    ->with('title', $title);
            }

            $executeData = app('App\Http\Controllers\Remunerasi\Pajak\CreateController')->create($request);
               
                if ($executeData > 0){
                    DB::connection('remunerasi')->commit(); 
                    $msg = 'Sukses menyimpan data';
                    $status = 1;
                    $title = 'Sukses';
                }else{
                    DB::connection('remunerasi')->rollback(); 
                    $msg = 'Gagal, data sudah ada, ';
                    $status = -1;
                    $title = 'Gagal';
                }

        }catch(\Exception $e){

            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
                DB::connection('remunerasi')->rollBack();

            $msg = 'Gagal menyimpan data';
            $status = -1;
            $title = 'Gagal';
        
        }

        return redirect()->back()
            ->with('message', $msg)
            ->with('status', $status)
            ->with('title', $title);
    }

    public function update(Request $request){

        DB::connection('remunerasi')->beginTransaction();
        try{    
            app('App\Http\Controllers\Remunerasi\Pajak\EditController')->update($request);
                DB::connection('remunerasi')->commit();    

            $msg = 'Sukses update data';
            $status = 1;
            $title = 'Sukses';

        }catch(\Exception $e){
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
                DB::connection('remunerasi')->rollBack();

            $msg = 'Gagal update data';
            $status = -1;
            $title = 'Gagal';
        }

        return redirect()->back()
                ->with('message', $msg)
                ->with('status', $status)
                ->with('title', $title);
    }
}