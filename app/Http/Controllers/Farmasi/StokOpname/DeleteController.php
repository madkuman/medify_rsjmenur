<?php

namespace App\Http\Controllers\Farmasi\StokOpname;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Farmasi\StokOpname;
use App\Models\Farmasi\Penghapusan;
use App\Models\Farmasi\Distribusi;
use Illuminate\Http\Response;
use DB;
use Auth;
use Bugsnag;

class DeleteController extends Controller
{
  public function delete(Request $request, $farmasi)
  {
    //dd($request);
  	$id = $request->input('id');

  	DB::connection('farmasi')->beginTransaction();

  	try {
  		$transaction = StokOpname::find($id);
  		//dd($transaction);
      if($transaction->status)
      {
        if($transaction->penghapusan)
        {
          $penghapusan = Penghapusan::find($transaction->penghapusan->id);
          foreach($penghapusan->log as $item)
          {
            app('App\Http\Controllers\Farmasi\LogPenghapusan\DeleteController')->deleteLog($item->id, 1);
          }
          $penghapusan->delete();
        }

        if($transaction->distribusi)
        {
          $distribusi = Distribusi::find($transaction->distribusi->id);
          foreach($distribusi->log as $rec)
          {
            app('App\Http\Controllers\Farmasi\LogDistribusi\DeleteController')->deleteLog($rec->id, 1);
          }
          $distribusi->delete();
        }
      }

  		$transaction->delete();

  		DB::connection('farmasi')->commit();
      return redirect('farmasi/'.$farmasi.'/stokopname/')
                ->with('status', 1)
                ->with('message', 'Stok Opname berhasil dihapus')
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
