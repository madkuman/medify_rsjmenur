<?php

namespace App\Http\Controllers\Farmasi\PenghapusanJenis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Farmasi\PenghapusanJenis;
use DB;
use Auth;

class PostController extends Controller
{
    public function save(Request $request, $farmasi)
    {
        DB::connection('farmasi')->beginTransaction();
        try {
            $farm = session('farmasi');
            $id = $request->id;
            $nama = $request->nama;

            if ($id != 0) {
                $data = PenghapusanJenis::find($id);
                $data->nama = $nama;
                $data->created_by = Auth::user()->id;
                $data->save();

                $message = "Berhasil mengubah master penghapusan jenis";
            } else {
                $data = new PenghapusanJenis;
                $data->nama = $nama;
                $data->created_by = Auth::user()->id;
                $data->save();

                $message = "Berhasil menambah master penghapusan jenis baru";
            }

            DB::connection('farmasi')->commit();

            $status = 1;            
            $title = 'Berhasil!';
        } catch (\Exception $e) {
            DB::connection('farmasi')->rollback();

            app('App\Http\Controllers\Error\Handler')->bugsnag($e);

            $status = -1;
            $message = "Gagal menyimpan master penghapusan jenis";
            $title = 'Gagal!';        
        }

        return back()
        ->with('status', $status)
        ->with('message', $message)
        ->with('title', $title);

    }

    public function delete(Request $request, $farmasi)
    {
        DB::connection('farmasi')->beginTransaction();
        try {
            $farm = session('farmasi');
                $id = $request->id;
                $data = PenghapusanJenis::find($id);
                $data->deleted_by = Auth::user()->id;
                $data->save();
                $data->delete();
            

            DB::connection('farmasi')->commit();

            $status = 1;            
            $message = "Berhasil menghapus master penghapusan jenis";
            $title = 'Berhasil!';

        } catch (\Exception $e) {
            DB::connection('farmasi')->rollback();

            app('App\Http\Controllers\Error\Handler')->bugsnag($e);

            $status = -1;
            $message = "Gagal menghapus master penghapusan jenis";
            $title = 'Gagal!';
        }
        
        return back()
        ->with('status', $status)
        ->with('message', $message)
        ->with('title', $title);
    }
}
