<?php

namespace App\Http\Controllers\Gudang\Penghapusan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Gudang\Penghapusan;
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

  	

  	try {
  		$transaction = Penghapusan::find($id);
  		//dd($transaction);
  		foreach($transaction->log as $item)
  		{
  			app('App\Http\Controllers\Gudang\LogPenghapusan\DeleteController')->deleteLog($item->id, 1);
  		}

  		$transaction->delete();

  		
      return redirect('gudang/penghapusan/')
                ->with('status', 1)
                ->with('message', 'Penghapusan berhasil dihapus')
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
