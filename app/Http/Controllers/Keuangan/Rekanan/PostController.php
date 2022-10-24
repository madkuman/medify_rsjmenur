<?php

namespace App\Http\Controllers\Keuangan\Rekanan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class PostController extends Controller
{
    public function submit(Request $request)
    {
        
        if ($request->has('id'))
            $id = $request->id;
        else
            $id = NULL;

        $nama = $request->nama;
        $npwp = $request->npwp;
        $jabatan = $request->jabatan;
        $direktur = $request->direktur;
        $alamat = $request->alamat;

        try {
            DB::connection('keuangan')->beginTransaction();
            if(is_null($id)){
                $transaksi = app('App\Http\Controllers\Keuangan\Perusahaan\CreateController')
                            ->create($nama,$npwp,$jabatan,$direktur,$alamat);
            	$message = 'Berhasil Menambah Rekanan';
            }
            else{
                $transaksi = app('App\Http\Controllers\Keuangan\Perusahaan\EditController')
                            ->update($id,$nama,$npwp,$jabatan,$direktur,$alamat);
            	$message = 'Berhasil Mengubah Rekanan';
            }
            $status = 1;
            $title = 'Berhasil';

            DB::connection('keuangan')->commit();
        } catch (\Exception $e) {
            DB::connection('keuangan')->rollback();
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
        }

        return redirect('keuangan/pengaturan/rekanan')
        ->with('message', $message)
        ->with('title',$title)
        ->with('status', $status);
    }
}
