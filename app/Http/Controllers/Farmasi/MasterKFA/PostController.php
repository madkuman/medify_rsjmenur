<?php

namespace App\Http\Controllers\Farmasi\MasterKFA;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Farmasi\MasterKFA;
use DB;
use Auth;

class PostController extends Controller
{
    public function form(Request $request, $farmasi)
    {
        DB::connection('farmasi')->beginTransaction();
        try {
            $farm = session('farmasi');
            $id = $request->id;

            if ($id) {
                $data = MasterKFA::find($id);
                $data->kode = $request->kode;
                $data->nama = $request->nama;
                $data->parent_id = $request->parent_id;
                $data->updated_by = Auth::user()->id;
                $data->save();

                $message = "Berhasil mengubah data";
            } else {
                $data = new MasterKFA;
                $data->kode = $request->kode;
                $data->nama = $request->nama;
                $data->parent_id = $request->parent_id;
                $data->created_by = Auth::user()->id;
                $data->save();

                $message = "Berhasil menambah data baru";
            }

            DB::connection('farmasi')->commit();

            $status = 1;
            $title = 'Berhasil!';
        } catch (\Exception $e) {
            DB::connection('farmasi')->rollback();

            app('App\Http\Controllers\Error\Handler')->bugsnag($e);

            $status = -1;
            $message = "Gagal menyimpan data. Error Server";
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

            $data = MasterKFA::find($id);
            $data->deleted_by = Auth::user()->id;
            $data->save();
            $data->delete();

            DB::connection('farmasi')->commit();

            $status = 1;
            $title = 'Berhasil!';
            $message = "Berhasil menghapus data";
        } catch (\Exception $e) {
            DB::connection('farmasi')->rollback();

            app('App\Http\Controllers\Error\Handler')->bugsnag($e);

            $status = -1;
            $message = "Gagal menghapus data. Error Server";
            $title = 'Gagal!';
        }

        return back()
            ->with('status', $status)
            ->with('message', $message)
            ->with('title', $title);
    }
}
