<?php

namespace App\Http\Controllers\Gudang\LogDistribusi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Gudang\LogDistribusi;
use App\Models\Gudang\Items;
use App\Models\Gudang\Distribusi;
use Carbon\Carbon;
use DB;
use Bugsnag;

class CreateController extends Controller
{
  	public function createLog($item, $qty = 0, $distribusi_id)
	{
		$total = 0;
		while($qty)
		{
			$log = Items::where('item_template_id',$item)->where('jumlah','>',0)->where('kadaluarsa', '>' , Carbon::today())->orderBy('kadaluarsa')->first();
			if(!$log) return 0;
			$new_log = new LogDistribusi;
			$new_log->item_id = $log->id;
			$new_log->distribusi_id = $distribusi_id;
			$new_log->jenis = 1;
			$new_log->tipe = -1;

			if($log->jumlah >= $qty)
			{
				$log->jumlah -= $qty;
				$new_log->jumlah = $qty;
				$qty = 0;
			}
			else
			{
				$qty -= $log->jumlah;
				$new_log->jumlah = $log->jumlah;
				$log->jumlah = 0;
			}

			$new_log->subtotal = $new_log->jumlah * $log->detail_item->harga;
			$total += $new_log->subtotal;
			
			$log->save();
			$new_log->save();
		}

		return $total;
	}

	public function createLogFix($item, $qty = 0, $distribusi_id)
	{
		$log = Items::find($item);
		if(!$log) return 0;
		$new_log = new LogDistribusi;
		$new_log->item_id = $log->id;
		$new_log->distribusi_id = $distribusi_id;
		$new_log->jumlah = $qty;
		$new_log->jenis = 1;
		$new_log->tipe = -1;
		$new_log->subtotal = $new_log->jumlah * $log->detail_item->harga;
		$log->jumlah -= $qty;
		
		$log->save();
		$new_log->save();

		return $new_log->subtotal;
	}

	public function createLogMasuk($item, $qty = 0, $distribusi_id)
	{
		$log = Items::find($item);
		if(!$log) return 0;
		$new_log = new LogDistribusi;
		$new_log->item_id = $log->id;
		$new_log->distribusi_id = $distribusi_id;
		$new_log->jumlah = $qty;
		$new_log->jenis = 1;
		$new_log->tipe = 1;
		$new_log->subtotal = $new_log->jumlah * $log->detail_item->harga;
		$new_log->save();

		return $new_log->subtotal;
	}

	public function createDraftRetur($item_id, $qty=0, $distribusi_id)
	{
		$draft = new LogDistribusi;
		$draft->item_id = $item_id;
		$draft->jumlah = $qty;
		$draft->distribusi_id = $distribusi_id;
		$draft->jenis = 0;
		$draft->save();	
	
		return $draft;
	}
}
