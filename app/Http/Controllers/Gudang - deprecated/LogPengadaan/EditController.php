<?php

namespace App\Http\Controllers\Gudang\LogPengadaan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Gudang\Items;
use App\Models\Gudang\ItemsTemplate;
use App\Models\Gudang\Pengadaan;
use App\Models\Gudang\LogPengadaan;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use DB;
use Bugsnag;
use File;
use Image;

class EditController extends Controller
{
	public function edit($log_id, $item_id, $qty = 0, $harga = 0, $diskon = 0, $ppn = 10, $subtotal = 0, $expired = null, $tanggal,$batch='')
	{
		$log = LogPengadaan::find($log_id);
		$item = Items::find($log->item_id);

		$item->jumlah -= $log->jumlah;
		$item->save();

		$new_item = app('App\Http\Controllers\Gudang\Items\CreateController')->newItem($item_id,$qty,$expired);

		$log->item_id = $new_item->id;
		$log->jumlah = $qty;
		$log->tanggal = $tanggal;		

		$items = ItemsTemplate::find($new_item->item_template_id);
		if($harga) 
		{
			$items->harga = $harga;
			$items->save();
		}
		$log->harga_saat_itu = $items->harga;
		$log->diskon = $diskon;
		$log->ppn = $ppn;
		$new_log->subtotal = (float)$items->harga * (float)$qty * (100-$diskon)/100;
		$log->batch = $batch;
		$log->save();
		
		return $log->subtotal;
		
	}

}
