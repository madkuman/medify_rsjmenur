<?php

namespace App\Http\Controllers\Gudang\Distribusi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Gudang\Distribusi;
use App\Models\Farmasi\Distribusi as FarmasiDistribusi;
use Illuminate\Http\Response;
use DB;
use Auth;
use Bugsnag;

class DeleteController extends Controller
{
  public function delete(Request $request)
  {
  	$id = $request->input('id');

  	

  	try {
  		$transaction = Distribusi::find($id);
      if (!empty($transaction->transaksi_ptr)) {
        $farmasi = FarmasiDistribusi::find($transaction->transaksi_ptr);
        $farmasi->status = -2;
        $farmasi->save();
      }
  		//dd($transaction);
  		foreach($transaction->log as $item)
  		{
  			app('App\Http\Controllers\Gudang\LogDistribusi\DeleteController')->deleteLog($item->id, 1);
  		}

  		$transaction->delete();

  		
      return redirect('gudang/distribusi/')
                ->with('status', 1)
                ->with('message', 'Distribusi berhasil dihapus')
                ->with('title', 'Sukses');
  	} catch (\Exception $e) {
  		
      app('App\Http\Controllers\Error\Handler')->bugsnag($e);
  		return redirect()->back()
                ->with('message', 'Terjadi kesalahan server, Silahkan coba beberapa saat lagi')
                ->with('status', -1)
                ->with('title', 'Gagal');
  	}
  }
}
