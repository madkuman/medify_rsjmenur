<?php

namespace App\Http\Controllers\Farmasi\Distribusi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Farmasi\Distribusi;
use Illuminate\Http\Response;
use DB;
use Auth;
use Bugsnag;

class DeleteController extends Controller
{
  public function delete(Request $request)
  {
    //dd($request);
  	$id = $request->input('id');
    $farm = $request->input('farmasi');

  	DB::connection('farmasi')->beginTransaction();

  	try {
  		$transaction = Distribusi::find($id);
      $tujuan = Distribusi::find($transaction->transaksi_ptr);
      $tujuan->status = -2;
      $tujuan->save();
  		//dd($transaction);

      foreach($transaction->log as $rec)
      {
        app('App\Http\Controllers\Farmasi\LogDistribusi\DeleteController')->deleteLog($rec->id, 1);
      }
      /*foreach($transaction->log as $item)
      {
        app('App\Http\Controllers\Farmasi\Items\DeleteController')->deleteLog($item->id);
      }*/

  		$transaction->delete();

  		DB::connection('farmasi')->commit();
      return redirect('farmasi/'.$farm.'/distribusi/')
                ->with('status', 1)
                ->with('message', 'Distribusi berhasil dihapus')
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
