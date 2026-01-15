<?php

namespace App\Http\Controllers\Kasus\Asesmen\AsesmenPendidikanPasienDanKeluarga;

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
            app("App\Http\Controllers\Kasus\Asesmen\AsesmenPendidikanPasienDanKeluarga\DeleteController")->delete($req);

            $status = 1;
            $message = "Asesmen Pendidikan Pasien dan Keluarga berhasil dihapus!";
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
            $message = "Asesmen Pendidikan Pasien dan Keluarga gagal dihapus!";
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

            $kasus = Kasus::where("nomor_kasus", $nomor_kasus)->first();
            if (isset($req->id) && $req->id != 0) {
                app("App\Http\Controllers\Kasus\Asesmen\AsesmenPendidikanPasienDanKeluarga\EditController")->edit($req);
            } else {
                app("App\Http\Controllers\Kasus\Asesmen\AsesmenPendidikanPasienDanKeluarga\CreateController")->create($req, $kasus->id);
            }


            $status = 1;
            $message = "Asesmen Pendidikan Pasien dan Keluarga berhasil ditambahkan!";
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
            $message = "Asesmen Pendidikan Pasien dan Keluarga gagal ditambahkan!";
            $title = "Gagal!";

            return back()
                ->with("message", $message)
                ->with("title", $title)
                ->with("status", $status);
        }
    }

    public function lembarSave(Request $req, $nomor_kasus)
    {
        DB::connection("kasus")->beginTransaction();
        try {
            $kasus = Kasus::where("nomor_kasus", $nomor_kasus)->first();
            if (isset($req->id) && $req->id != 0) {
                app("App\Http\Controllers\Kasus\Asesmen\LembarKomunikasiInformasiDanEdukasiPasienDanKeluarga\EditController")->edit($req);
                $message = "Data berhasil diubah!";
            } else {
                app("App\Http\Controllers\Kasus\Asesmen\LembarKomunikasiInformasiDanEdukasiPasienDanKeluarga\CreateController")->create($req, $kasus->id);
                $message = "Data berhasil ditambahkan!";
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
            $message = "Data gagal ditambahkan!";
            $title = "Gagal!";

            return back()
                ->with("message", $message)
                ->with("title", $title)
                ->with("status", $status);
        }
    }

    public function lembarDelete(Request $req)
    {
        DB::connection("kasus")->beginTransaction();
        try {
            app("App\Http\Controllers\Kasus\Asesmen\LembarKomunikasiInformasiDanEdukasiPasienDanKeluarga\DeleteController")->delete($req);

            $status = 1;
            $message = "Data berhasil dihapus!";
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
            $message = "Data gagal dihapus!";
            $title = "Gagal!";

            return back()
                ->with("message", $message)
                ->with("title", $title)
                ->with("status", $status);
        }
    }
}
