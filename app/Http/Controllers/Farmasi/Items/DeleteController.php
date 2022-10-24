<?php

namespace App\Http\Controllers\Farmasi\Items;

use Illuminate\Http\Request;
use App\Models\Farmasi\ItemsTemplate;
use App\Models\Farmasi\ItemsFarmasi;
use App\Models\Farmasi\Items;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use DB;
use Bugsnag;

class DeleteController extends Controller
{
    public function delete(Request $request, $farmasi)
    {
        //dd($request);
        DB::connection('farmasi')->beginTransaction();

    	$item_id = $request->input('item_id');
    	try {
    		ItemsTemplate::find($item_id)->delete();
            ItemsFarmasi::where('item_template_id', $item_id)->delete();

            DB::connection('farmasi')->commit();
    	} catch (\Exception $e) {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
            DB::connection('farmasi')->rollBack();

            return redirect()->back()
                        ->with('message', 'Terjadi kesalahan server, Silahkan coba beberapa saat lagi')
                        ->with('status', -1)
                        ->with('title', 'Gagal');
    	}
        return redirect('farmasi/'.$farmasi.'/item')
                ->with('message', 'Item berhasil dihapus')
                ->with('status', 1)
                ->with('title', 'Sukses');
    }

    public function deleteLog($item_id)
    {
        $log = Items::find($item_id);
        $log->delete();    
    }
}
