<?php

namespace App\Http\Controllers\Esakip\Dashboard;

use App\Models\Esakip\Dokumen;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class PostController extends Controller
{
    public function save(Request $request)
    {
        try{
            $counter =  app('App\Http\Controllers\Esakip\Dashboard\ReadController')->validation($request);
            if(is_string($counter)){
                return json_encode([
                    'number'=>400,
                    'status'=>'Gagal',
                    'ket'=> $counter
                ]);
            }

            DB::connection('esakip')->beginTransaction();
            $esakip =  app('App\Http\Controllers\Esakip\Dashboard\CreateController')->create($request);
            DB::connection('esakip')->commit();
            return json_encode([
                'number'=>200,
                'status'=>'Berhasil',
                'ket'=>'Berhasil, file berhasil di upload'
            ]);

        }catch (\Exception $e)
        {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            DB::connection('esakip')->rollBack();
            return json_encode([
                'number'=>400,
                'status'=>'Gagal',
                'ket'=>'Gagal, file gagal di upload'
            ]);
        }
    }

    public function edit(Request $request)
    {
        try{
            $dokumen =  Dokumen::find($request->id);
            if(!empty($dokumen->verified_at) || !empty($dokumen->verified_admin_at)){
                return json_encode([
                    'number'=>400,
                    'status'=>'Gagal',
                    'ket'=> 'Gagal! File telah di verifikasi'
                ]);
            }

            DB::connection('esakip')->beginTransaction();
            $esakip =  app('App\Http\Controllers\Esakip\Dashboard\EditController')->edit($request);
            DB::connection('esakip')->commit();
            return json_encode([
                'number'=>200,
                'status'=>'Berhasil',
                'ket'=>'Berhasil, file berhasil di ubah'
            ]);

        }catch (\Exception $e)
        {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            DB::connection('esakip')->rollBack();
            return json_encode([
                'number'=>400,
                'status'=>'Gagal',
                'ket'=>'Gagal, file gagal di ubah'
            ]);
        }
    }

    public function delete($id,Request $request)
    {
        try{
            $dokumen =  Dokumen::find($id);
            if(!empty($dokumen->verified_at) || !empty($dokumen->verified_admin_at)){
                return json_encode([
                    'number'=>400,
                    'status'=>'Gagal',
                    'ket'=> 'Gagal! File telah di verifikasi'
                ]);
            }

            DB::connection('esakip')->beginTransaction();
            $esakip =  app('App\Http\Controllers\Esakip\Dashboard\DeleteController')->delete($id);
            DB::connection('esakip')->commit();
            return json_encode([
                'number'=>200,
                'status'=>'Berhasil',
                'ket'=>'Berhasil, file berhasil di hapus'
            ]);

        }catch (\Exception $e)
        {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            DB::connection('esakip')->rollBack();
            return json_encode([
                'number'=>400,
                'status'=>'Gagal',
                'ket'=>'Gagal, file gagal di hapus'
            ]);
        }
    }
}
