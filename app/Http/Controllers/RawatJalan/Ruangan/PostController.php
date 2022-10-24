<?php

namespace App\Http\Controllers\RawatJalan\Ruangan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RawatJalan\Ruangan;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function create(Request $request)
    {
        DB::connection('rawatjalan')->beginTransaction();
        try {
            $result = app('App\Http\Controllers\RawatJalan\Ruangan\CreateController')->create($request);
            DB::connection('rawatjalan')->commit();
            $status = $result['status'];
            $message = $result['message'];
            $title = $result['title'];
        } catch (\Exception $e) {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            DB::connection('rawatjalan')->rollback();
            $status = -1;
            $message = 'Gagal menambahkan ruangan';
            $title = 'Gagal!';
        }
        return redirect('rawatjalan/ruangan')
        ->with('message', $message)
        ->with('title',$title)
        ->with('status', $status);
    }

    public function delete(Request $request)
    {
        DB::connection('rawatjalan')->beginTransaction();
        try {
            $ruangan = Ruangan::find($request->id_ruangan);
            $ruangan->delete();
            
            DB::connection('rawatjalan')->commit();
            
            $status = 1;
            $title = 'Berhasil!';
            $message = 'Berhasil menghapus ruangan';
        } catch (\Exception $e) {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            DB::connection('rawatjalan')->rollback();
            $status = -1;
            $message = 'Gagal menghapus ruangan';
            $title = 'Gagal!';
        }
        return redirect('rawatjalan/ruangan')
        ->with('message', $message)
        ->with('title',$title)
        ->with('status', $status);
    }
}
