<?php

namespace App\Http\Controllers\Farmasi\Pengadaan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Farmasi\Pengadaan;
use App\Models\Keuangan\PO;
use App\Models\Keuangan\Utang;
use Illuminate\Http\Response;
use DB;
use Auth;
use Bugsnag;

class DeleteController extends Controller
{
  public function delete(Request $request, $farmasi)
  {
  	$id = $request->input('id');

  	DB::connection('farmasi')->beginTransaction();

  	try {
  		$transaction = Pengadaan::find($id);
  		//dd($transaction);
  		foreach($transaction->log as $item)
  		{
  			app('App\Http\Controllers\Farmasi\LogPengadaan\DeleteController')->deleteLog($item->id);
  		}

  		$transaction->delete();

  		DB::connection('farmasi')->commit();
      return redirect('farmasi/'.$farmasi.'/pengadaan/')
                ->with('status', 1)
                ->with('message', 'Pengadaan berhasil dihapus')
                ->with('title', 'Sukses');
  	} catch (\Exception $e) {
  		app('App\Http\Controllers\Error\Handler')->bugsnag($e);
      DB::connection('farmasi')->rollBack();
  		return redirect()->back()
                ->with('message', 'Terjadi kesalahan server, Silahkan coba beberapa saat lagi')
                ->with('status', -1)
                ->with('title', 'Gagal');
  	}
  }
}
