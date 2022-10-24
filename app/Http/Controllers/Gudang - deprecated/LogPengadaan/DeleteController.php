<?php

namespace App\Http\Controllers\Gudang\LogPengadaan;

use Illuminate\Http\Request;
use App\Models\Gudang\ItemsTemplate;
use App\Models\Gudang\Items;
use App\Models\Gudang\LogPengadaan;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use DB;
use Bugsnag;

class DeleteController extends Controller
{
    public function delete(Request $request)
    {
        //dd($request);
    	$item_id = $request->input('item_id');

        

    	try {
            $item = ItemsTemplate::find($item_id);
            foreach ($item->items_category as $gor) {
                $gor->delete();
            }
    		$suppDeletion = $item->delete();
            
    	} catch (\Exception $e) {
    		
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);

            return redirect()->back()
                        ->with('message', 'Terjadi kesalahan server, Silahkan coba beberapa saat lagi')
                        ->with('status', -1)
                        ->with('title', 'Gagal');
    	}
    	if(empty($suppDeletion)) $request->session()->flash('status', 'Delete Gagal, Item Tidak ditemukan');
        return redirect('gudang/item')
                ->with('message', 'Item berhasil dihapus')
                ->with('status', 1)
                ->with('title', 'Sukses');
    }

    public function deleteLog($item_id)
    {
        $log = LogPengadaan::find($item_id);
        $item = Items::find($log->item_id);
        $deleted = $log->jumlah;
        $item->jumlah -= $log->jumlah;
        $item->save();
        $log->delete();
        return $deleted;
    }
}
