<?php

namespace App\Http\Controllers\Kasus\Asesmen\ImplementasiManajerPelayananPasien;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use DB;

class PostController extends Controller
{
    function __construct()
    {
        $this->module_path = 'App\Http\Controllers\Kasus\Asesmen\ImplementasiManajerPelayananPasien';
        $this->read = app($this->module_path . '\ReadController');
    }

    public function delete(Request $req)
    {
        DB::connection('kasus')->beginTransaction();
        try {
            app($this->module_path . '\DeleteController')->delete($req);

            $status = 1;
            $message = $this->read->judul_asesmen . ' berhasil dihapus!';
            $title = 'Berhasil!';

            DB::connection('kasus')->commit();
            return back()
                ->with('message', $message)
                ->with('title', $title)
                ->with('status', $status);
        } catch (\Exception $e) {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            DB::connection('kasus')->rollback();

            $status = -1;
            $message = $this->read->judul_asesmen . ' gagal dihapus!';
            $title = 'Gagal!';

            return back()
                ->with('message', $message)
                ->with('title', $title)
                ->with('status', $status);
        }
    }

    public function save(Request $req, $nomor_kasus)
    {
        DB::connection('kasus')->beginTransaction();
        try {

            $kasus = Kasus::select('id')->where('nomor_kasus', $nomor_kasus)->first();
            if (isset($req->id) && $req->id != 0) {
                app($this->module_path . '\EditController')->edit($req);
                $message = $this->read->judul_asesmen . ' berhasil diperbarui!';
            } else {
                app($this->module_path . '\CreateController')->create($req, $kasus->id);
                $message = $this->read->judul_asesmen . ' berhasil ditambahkan!';
            }

            $status = 1;
            $title = 'Berhasil!';

            DB::connection('kasus')->commit();
            return back()
                ->with('message', $message)
                ->with('title', $title)
                ->with('status', $status);
        } catch (\Exception $e) {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            DB::connection('kasus')->rollback();

            $status = -1;
            $message = $this->read->judul_asesmen . ' gagal diproses!';
            $title = 'Gagal!';

            return back()
                ->with('message', $message)
                ->with('title', $title)
                ->with('status', $status);
        }
    }
}
