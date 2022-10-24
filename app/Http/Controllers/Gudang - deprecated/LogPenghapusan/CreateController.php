<?php

namespace App\Http\Controllers\Gudang\LogPenghapusan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Gudang\LogPenghapusan;
use App\Models\Gudang\Items;
use App\Models\Gudang\Penghapusan;
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
		$log->jumlah -= $qty;
		
		$log->save();
		$new_log->save();

		return 1;
	}
}
