<?php

namespace App\Http\Controllers\Kasus\Psikologi\Galeri;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\Kasus\Kasus;

class PostController extends Controller
{
    public function create(Request $req, $nomor_kasus){
        DB::connection("kasus")->beginTransaction();
        try
        {

            $kasus = Kasus::where("nomor_kasus", $nomor_kasus)->first();
            app('App\Http\Controllers\Kasus\Psikologi\Galeri\CreateController')->create($req, $kasus->id);

            $status = 1;
            $message = "Galeri Psikologi berhasil ditambahkan!";
            $title = "Berhasil!";

            DB::connection("kasus")->commit();
            return back()
                ->with("message", $message)
                ->with("title",$title)
                ->with("status", $status);

        } catch (\Exception $e) {
            app("App\Http\Controllers\Error\Handler")->bugsnag($e);
            DB::connection("kasus")->rollback();

            $status = -1;
            $message = "Galeri Psikologi gagal ditambahkan!";
            $title = "Gagal!";

            return back()
                ->with("message", $message)
                ->with("title",$title)
                ->with("status", $status);
        }
    }

    public function delete(Request $req){
        DB::connection("kasus")->beginTransaction();
        try
        {
            app('App\Http\Controllers\Kasus\Psikologi\Galeri\DeleteController')->delete($req);

            $status = 1;
            $message = "Galeri Psikologi berhasil dihapus!";
            $title = "Berhasil!";

            DB::connection("kasus")->commit();
            return back()
                ->with("message", $message)
                ->with("title",$title)
                ->with("status", $status);

        } catch (\Exception $e) {
            app("App\Http\Controllers\Error\Handler")->bugsnag($e);
            DB::connection("kasus")->rollback();

            $status = -1;
            $message = "Galeri Psikologi gagal dihapus!";
            $title = "Gagal!";

            return back()
                ->with("message", $message)
                ->with("title",$title)
                ->with("status", $status);
        }
    }
}
