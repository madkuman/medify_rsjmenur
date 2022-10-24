<?php

namespace App\Http\Controllers\Kasus\Keperawatan\RencanaAsuhan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Keperawatan;
use App\Models\Kasus\Kasus;
use DB;
use Bugsnag;

class DeleteController extends Controller
{
  public function destroy($nomor_kasus, $id)
  {
    DB::connection('keperawatan')->beginTransaction();
    DB::connection('kasus')->beginTransaction();
    try
    {

      $kasus = Kasus::where('nomor_kasus', $nomor_kasus)->first();
      $kasus_asuhan = Keperawatan::findOrFail($id);
      $kasus_asuhan->delete();

      $status = 1;
      $message = 'Rencana Asuhan Keperawatan baru berhasil dihapus!';
      $title = 'Berhasil!';

      $log = app('App\Http\Controllers\Kasus\Log\CreateController')
      ->create($kasus->id,'delete','keperawatan',$kasus_asuhan->id,$kasus->id);

      DB::connection('keperawatan')->commit();
      DB::connection('kasus')->commit();

      return back()
      ->with('message', $message)
      ->with('title',$title)
      ->with('status', $status);

    } catch(\Exception $e) {

      DB::connection('keperawatan')->rollback();
      DB::connection('kasus')->rollback();
      
      app('App\Http\Controllers\Error\Handler')->bugsnag($e);


      $status = -1;
      $message = 'Rencana Asuhan Keperawatan gagal berhasil dihapus!';
      $title = 'Error!';
      return back()
      ->with('message', $message)
      ->with('title',$title)
      ->with('status', $status);
    }
  }
}
