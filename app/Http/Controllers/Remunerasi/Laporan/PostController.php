<?php

namespace App\Http\Controllers\Remunerasi\Laporan;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class PostController extends Controller
{
    public function create(Request $request){

        DB::connection('remunerasi')->beginTransaction();
        try{

            $data = app('App\Http\Controllers\Remunerasi\Laporan\CreateController')->create($request);
            if($data['status'] == 1){
                DB::connection('remunerasi')->commit();
                $msg = $data['message'];
                $status = 1;
                $title = 'Berhasil';
            }else{
                $msg = $data['message'];
                $status = -1;
                $title = 'Gagal';
                DB::connection('remunerasi')->rollBack();
            }

        }catch(\Exception $e){

            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            DB::connection('remunerasi')->rollBack();

            $msg = 'Terjadi Kesalahan Server';
            $status = -1;
            $title = 'Gagal';

        }

        return redirect()->back()
            ->with('message', $msg)
            ->with('status', $status)
            ->with('title', $title);
    }
}
