<?php

namespace App\Http\Controllers\Gudang\LogPenghapusan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Gudang\LogPenghapusan;
use App\Models\Gudang\Items;
use DB;
use Bugsnag;

class DeleteController extends Controller
{
    public function deleteLog($item_id, $stok = 0)
    {
        $log = LogPenghapusan::find($item_id);
        if($stok) {
            $item = Items::find($log->item_id);
            $item->jumlah += $log->jumlah;
            $item->save();
        }
        $log->delete();
    }
}
