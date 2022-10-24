<?php

namespace App\Http\Controllers\RawatJalan\MasterTv;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RawatJalan\MasterTv;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function create(Request $request)
    {
        DB::connection('rawatjalan')->beginTransaction();
        try {
            app('App\Http\Controllers\RawatJalan\MasterTv\CreateController')->create($request);
            DB::connection('rawatjalan')->commit();
            
            $message = 'Berhasil membuat screen TV';
            if ($request->id) $message = 'Berhasil memperbarui screen TV';
            $status = 1;
            $title = 'Berhasil!';
        } catch (\Exception $e) {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            DB::connection('rawatjalan')->rollback();
            $status = -1;
            $message = 'Gagal membuat screen TV';
            if ($request->id) $message = 'Berhasil memperbarui screen TV';
            $title = 'Gagal!';
        }
        return redirect('rawatjalan/screen-tv')
        ->with('message', $message)
        ->with('title',$title)
        ->with('status', $status);
    }

    public function hapus(Request $request)
    {
        DB::connection('rawatjalan')->beginTransaction();
        try {
            $tv = MasterTv::find($request->screen_id);
            $tv->delete();

            DB::connection('rawatjalan')->commit();
            
            $status = 1;
            $message = 'Berhasil menghapus screen TV';
            $title = 'Berhasil!';
        } catch (\Exception $e) {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            DB::connection('rawatjalan')->rollback();
            $status = -1;
            $message = 'Gagal menghapus screen TV';
            $title = 'Gagal!';
        }
        return redirect('rawatjalan/screen-tv')
        ->with('message', $message)
        ->with('title',$title)
        ->with('status', $status);
    }

    public function getDetail($id)
    {
        $tv = MasterTv::find($id);
        $return['id'] = $tv->id;
        $return['nama'] = $tv->nama;
        $return['level_id'] = $tv->antrian_level;
        $return['ruangan_id'] = $tv->ruangan;
        return json_encode($return);
    }
}
