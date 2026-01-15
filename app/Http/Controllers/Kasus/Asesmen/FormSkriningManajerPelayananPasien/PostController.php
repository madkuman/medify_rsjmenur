<?php

namespace App\Http\Controllers\Kasus\Asesmen\FormSkriningManajerPelayananPasien;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Models\Kasus\Kasus;

class PostController extends Controller
{
    public function delete(Request $req)
    {
        DB::connection("kasus")->beginTransaction();
        try {
            app("App\Http\Controllers\Kasus\Asesmen\FormSkriningManajerPelayananPasien\DeleteController")->delete($req);

            $status = 1;
            $message = "Form Skrining Manajer Pelayanan Pasien berhasil dihapus!";
            $title = "Berhasil!";

            DB::connection("kasus")->commit();
            return back()
                ->with("message", $message)
                ->with("title", $title)
                ->with("status", $status);
        } catch (\Exception $e) {
            app("App\Http\Controllers\Error\Handler")->bugsnag($e);
            DB::connection("kasus")->rollback();

            $status = -1;
            $message = "Form Skrining Manajer Pelayanan Pasien gagal dihapus!";
            $title = "Gagal!";

            return back()
                ->with("message", $message)
                ->with("title", $title)
                ->with("status", $status);
        }
    }

    public function save(Request $req, $nomor_kasus)
    {
        DB::connection("kasus")->beginTransaction();
        try {

            $kasus = Kasus::select('id')->where("nomor_kasus", $nomor_kasus)->first();
            if (isset($req->id) && $req->id != 0) {
                app("App\Http\Controllers\Kasus\Asesmen\FormSkriningManajerPelayananPasien\EditController")->edit($req);
                $message = "Form Skrining Manajer Pelayanan Pasien berhasil diperbarui!";
            } else {
                app("App\Http\Controllers\Kasus\Asesmen\FormSkriningManajerPelayananPasien\CreateController")->create($req, $kasus->id);
                $message = "Form Skrining Manajer Pelayanan Pasien berhasil ditambahkan!";
            }

            $status = 1;
            $title = "Berhasil!";

            DB::connection("kasus")->commit();
            return back()
                ->with("message", $message)
                ->with("title", $title)
                ->with("status", $status);
        } catch (\Exception $e) {
            app("App\Http\Controllers\Error\Handler")->bugsnag($e);
            DB::connection("kasus")->rollback();

            $status = -1;
            $message = "Form Skrining Manajer Pelayanan Pasien gagal ditambahkan!";
            $title = "Gagal!";

            return back()
                ->with("message", $message)
                ->with("title", $title)
                ->with("status", $status);
        }
    }
}
