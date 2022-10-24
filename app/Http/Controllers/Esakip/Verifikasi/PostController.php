<?php

namespace App\Http\Controllers\Esakip\Verifikasi;

use App\Models\Esakip\Dokumen;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class PostController extends Controller
{
    public function verifikasi($id,Request $request)
    {
        try{
            DB::connection('esakip')->beginTransaction();
            $data = app('App\Http\Controllers\Esakip\Verifikasi\EditController')->verifikasi($id);
            $content = '';
            if(!empty($data->verified_at)) $content .= '<span class="badge badge-primary">Sudah Terverifikasi Atasan</span><br>';
            else $content .= '<span class="badge badge-warning">Belum Terverifikasi Atasan</span><br>';
            if(!empty($data->verified_admin_at)) $content .= '<span class="badge badge-primary">Sudah Terverifikasi Admin</span> ';
            else $content .= '<span class="badge badge-warning">Belum Terverifikasi Admin</span>';
            DB::connection('esakip')->commit();
            return json_encode([
                'number'=>200,
                'status'=>'Berhasil',
                'ket'=>'Berhasil, file berhasil di verifikasi',
                'content'=> $content,
            ]);

        }catch (\Exception $e)
        {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            DB::connection('esakip')->rollBack();
            return json_encode([
                'number'=>400,
                'status'=>'Gagal',
                'ket'=>'Gagal, file gagal di verifikasi'
            ]);
        }
    }

    public function batalVerifikasi($id,Request $request)
    {
        try{
            DB::connection('esakip')->beginTransaction();
            $data = app('App\Http\Controllers\Esakip\Verifikasi\EditController')->batalVerifikasi($id);
            $content = '';
            if(!empty($data->verified_at)) $content .= '<span class="badge badge-primary">Sudah Terverifikasi Atasan</span><br> ';
            else $content .= '<span class="badge badge-warning">Belum Terverifikasi Atasan</span><br>';
            if(!empty($data->verified_admin_at)) $content .= '<span class="badge badge-primary">Sudah Terverifikasi Admin</span> ';
            else $content .= '<span class="badge badge-warning">Belum Terverifikasi Admin</span>';
            DB::connection('esakip')->commit();
            return json_encode([
                'number'=>200,
                'status'=>'Berhasil',
                'ket'=>'Berhasil, batal verifikasi berhasil',
                'content'=>$content,
            ]);

        }catch (\Exception $e)
        {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            DB::connection('esakip')->rollBack();
            return json_encode([
                'number'=>400,
                'status'=>'Gagal',
                'ket'=>'Gagal, batal verifikasi gagal'
            ]);
        }
    }
}
