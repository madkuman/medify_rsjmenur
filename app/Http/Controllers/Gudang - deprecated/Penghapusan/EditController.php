<?php

namespace App\Http\Controllers\Gudang\Penghapusan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Gudang\Penghapusan;
use Illuminate\Http\Response;
use Carbon\Carbon;
use DB;
use Auth;
use Bugsnag;

class EditController extends Controller
{
    public function edit(Request $request)
    {   
        //dd($request);
        $id = $request->input('id');
        $description = $request->input('keterangan');
        $template = $request->input('template');
        $items = $request->input('barang');
        $qty = $request->input('jumlah');

        

        try
        {
            $transaction = Penghapusan::find($id);
            $transaction->keterangan = $description;
            $transaction->save();

            foreach($transaction->log as $log)
            {
                app('App\Http\Controllers\Gudang\LogPenghapusan\DeleteController')->deleteLog($log->id, 1);
            }
            
            $i = 0;
            foreach($items as $item)
            {
                if(is_numeric($item))
                {
                    if(!is_null($qty[$i])) {
                        app('App\Http\Controllers\Gudang\LogPenghapusan\CreateController')->createLog($item,$qty[$i],$transaction->id);
                    }
                }
                $i++;
            }

            
            return redirect('gudang/penghapusan/'.$transaction->slug)
                    ->with('status', 1)
                      ->with('message', 'Penghapusan berhasil diubah')
                        ->with('title', 'Sukses');
        }
        catch (\Exception $e) 
        {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
                        

            return redirect()->back()
                        ->with('message', 'Terjadi kesalahan server, Silahkan coba beberapa saat lagi')
                        ->with('status', -1)
                        ->with('title', 'Gagal');
        }
    }
}
