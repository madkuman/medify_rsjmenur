<?php

namespace App\Http\Controllers\Remunerasi\Denda;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Remunerasi\Absensi;
use App\Models\Remunerasi\Denda;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Auth;
use DB;
use Bugsnag;


class PostController extends Controller
{

    public function store(Request $request){

        DB::connection('remunerasi')->beginTransaction();
        try{        
            if($request->id == null or $request->id == 0){
                $executeData = app('App\Http\Controllers\Remunerasi\Denda\CreateController')->create($request);
            }else{
                $executeData = app('App\Http\Controllers\Remunerasi\Denda\EditController')->update($request);
            }
                if ($executeData > 0){
                    DB::connection('remunerasi')->commit(); 
                    $msg = 'Sukses menyimpan data';
                    $status = 1;
                    $title = 'Sukses';
                }else{
                    DB::connection('remunerasi')->rollback(); 
                    $msg = 'Gagal, data pada periode yang dipilih sudah ada, ';
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
}