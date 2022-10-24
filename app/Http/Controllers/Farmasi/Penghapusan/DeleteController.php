<?php

namespace App\Http\Controllers\Farmasi\Penghapusan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Farmasi\Penghapusan;
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
  		$transaction = Penghapusan::find($id);
  		//dd($transaction);
  		foreach($transaction->log as $item)
  		{
  			app('App\Http\Controllers\Farmasi\LogPenghapusan\DeleteController')->deleteLog($item->id, 1);
  		}

  		$transaction->delete();

  		DB::connection('farmasi')->commit();
      return redirect('farmasi/'.$farmasi.'/penghapusan/')
                ->with('status', 1)
                ->with('message', 'Penghapusan berhasil dihapus')
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
