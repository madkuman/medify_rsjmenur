<?php

namespace App\Http\Controllers\Farmasi\LogPenghapusan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Farmasi\LogPenghapusan;
use App\Models\Farmasi\Items;
use App\Models\Farmasi\Penghapusan;
use Carbon\Carbon;
use DB;
use Bugsnag;

class CreateController extends Controller
{
  	public function createLog($item, $qty = 0, $penghapusan_id)
	{
		$log = Items::find($item);
		if(!$log) return 0;
		$new_log = new LogPenghapusan;
		$new_log->item_id = $log->id;
		$new_log->penghapusan_id = $penghapusan_id;
		$new_log->jumlah = $qty;
		$new_log->subtotal = $log->detail_item->item_detail->harga * $qty;
		$log->jumlah -= $qty;
		$new_log->jumlah_setelah_penghapusan = $log->jumlah;
		
		$log->save();
		$new_log->save();

		return $new_log;
	}
}
