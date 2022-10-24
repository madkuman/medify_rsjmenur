<?php

namespace App\Http\Controllers\Gudang\LogDistribusi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Gudang\LogDistribusi;
use App\Models\Gudang\Items;
use DB;
use Bugsnag;

class DeleteController extends Controller
{
    public function deleteLog($item_id, $stok = 0)
    {
		$log = LogDistribusi::find($item_id);
		if($stok) {
            $item = Items::find($log->item_id);
            if($log->detail_distribusi->tipe == -1) $item->jumlah += $log->jumlah;
            else $item->jumlah -= $log->jumlah;
            $item->save();
        }
    	$log->delete();
    }
}
