<?php

namespace App\Http\Controllers\Kasus\Asesmen\AsesmenAwalDokterNonJiwa;

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
      app("App\Http\Controllers\Kasus\Asesmen\AsesmenAwalDokterNonJiwa\DeleteController")->delete($req);
      $status = 1;
      $message = "Asesmen Awal Dokter Non Jiwa berhasil dihapus!";
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
      $message = "Asesmen Awal Dokter Non Jiwa gagal dihapus!";
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
        app("App\Http\Controllers\Kasus\Asesmen\AsesmenAwalDokterNonJiwa\EditController")->edit($req);
      } else {
        app("App\Http\Controllers\Kasus\Asesmen\AsesmenAwalDokterNonJiwa\CreateController")->create($req, $kasus->id);
      }
      $status = 1;
      if (isset($req->id) && $req->id != 0) {
        $message = "Asesmen Awal Dokter Non Jiwa berhasil diubah!";
      } else {
        $message = "Asesmen Awal Dokter Non Jiwa berhasil ditambahkan!";
      }
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
      $message = "Asesmen Awal Dokter Non Jiwa gagal ditambahkan!";
      $title = "Gagal!";
      return back()
          ->with("message", $message)
          ->with("title", $title)
          ->with("status", $status);
    }
  }
}
