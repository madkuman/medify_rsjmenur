<?php

namespace App\Http\Controllers\RawatInap\Pengaturan\Foto;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RawatInap\Foto;
use Auth;
use DB;
use Bugsnag;

class DeleteController extends Controller
{
    public function delete(Request $request)
    {
        DB::connection('rawatinap')->beginTransaction();
        try
        {
            $foto_id = $request->foto_id;

            $foto = Foto::find($foto_id);
            $foto->delete();
            
            $filename = public_path().'/'.$foto->foto_ori;
            \File::delete($filename);
            $file300 = public_path().'/'.$foto->foto_thumb;
            \File::delete($file300);

            $status = 1;
            $message = 'Foto Berhasil di Hapus.';
            $title = 'Berhasil!';

        
            DB::connection('rawatinap')->commit();
            return back()
            ->with('message', $message)
            ->with('title',$title)
            ->with('status', $status);

        } catch (\Exception $e) {
           
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);

            DB::connection('rawatinap')->rollback();
            
        }
    }
}
