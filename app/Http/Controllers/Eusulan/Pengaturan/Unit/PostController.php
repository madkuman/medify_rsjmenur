<?php

namespace App\Http\Controllers\Eusulan\Pengaturan\Unit;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class PostController extends Controller
{
    public function save(Request $request)
    {
        try{

            DB::connection('eusulan')->beginTransaction();
            app('App\Http\Controllers\Eusulan\Pengaturan\Unit\CreateController')->create($request);
            DB::connection('eusulan')->commit();
            return json_encode([
                'number'=>200,
                'status'=>'Berhasil!',
                'ket'=>'Unit berhasil ditambahkan'
            ]);

        }catch (\Exception $e)
        {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            DB::connection('eusulan')->rollBack();
            return json_encode([
                'number'=>400,
                'status'=>'Gagal!',
                'ket'=>'Unit Gagal Ditambahkan'
            ]);
        }
    }

    public function edit(Request $request)
    {
        try{

            DB::connection('eusulan')->beginTransaction();
            app('App\Http\Controllers\Eusulan\Pengaturan\Unit\EditController')->edit($request);
            DB::connection('eusulan')->commit();
            return json_encode([
                'number'=>200,
                'status'=>'Berhasil!',
                'ket'=>'Berhasil, Unit berhasil di ubah'
            ]);

        }catch (\Exception $e)
        {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            DB::connection('eusulan')->rollBack();
            return json_encode([
                'number'=>400,
                'status'=>'Gagal!',
                'ket'=>'Unit gagal di ubah'
            ]);
        }
    }

    public function delete($id,Request $request)
    {
        try{

            DB::connection('eusulan')->beginTransaction();
            app('App\Http\Controllers\Eusulan\Pengaturan\Unit\DeleteController')->delete($id);
            DB::connection('eusulan')->commit();
            return json_encode([
                'number'=>200,
                'status'=>'Berhasil!',
                'ket'=>'Unit berhasil di hapus'
            ]);

        }catch (\Exception $e)
        {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            DB::connection('eusulan')->rollBack();
            return json_encode([
                'number'=>400,
                'status'=>'Gagal',
                'ket'=>'Unit gagal di hapus'
            ]);
        }
    }
}
