<?php

namespace App\Http\Controllers\Eusulan\Pengaturan\UbahUsulan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class PostController extends Controller
{
    public function save(Request $request)
    {
        try{

            DB::connection('eusulan')->beginTransaction();
            app('App\Http\Controllers\Eusulan\Pengaturan\UbahUsulan\CreateController')->create($request);
            DB::connection('eusulan')->commit();
            return json_encode([
                'number'=>200,
                'status'=>'Berhasil!',
                'ket'=>'Data berhasil ditambahkan'
            ]);

        }catch (\Exception $e)
        {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            DB::connection('eusulan')->rollBack();
            return json_encode([
                'number'=>400,
                'status'=>'Gagal!',
                'ket'=>'Data Gagal Ditambahkan'
            ]);
        }
    }

    public function edit(Request $request)
    {
        try{

            DB::connection('eusulan')->beginTransaction();
            app('App\Http\Controllers\Eusulan\Pengaturan\UbahUsulan\EditController')->edit($request);
            DB::connection('eusulan')->commit();
            return json_encode([
                'number'=>200,
                'status'=>'Berhasil!',
                'ket'=>'Berhasil, Data berhasil di ubah'
            ]);

        }catch (\Exception $e)
        {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            DB::connection('eusulan')->rollBack();
            return json_encode([
                'number'=>400,
                'status'=>'Gagal!',
                'ket'=>'Data gagal di ubah'
            ]);
        }
    }

    public function delete($id,Request $request)
    {
        try{

            DB::connection('eusulan')->beginTransaction();
            app('App\Http\Controllers\Eusulan\Pengaturan\UbahUsulan\DeleteController')->delete($id);
            DB::connection('eusulan')->commit();
            return json_encode([
                'number'=>200,
                'status'=>'Berhasil!',
                'ket'=>'Data berhasil di hapus'
            ]);

        }catch (\Exception $e)
        {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            DB::connection('eusulan')->rollBack();
            return json_encode([
                'number'=>400,
                'status'=>'Gagal',
                'ket'=>'Data gagal di hapus'
            ]);
        }
    }
}
