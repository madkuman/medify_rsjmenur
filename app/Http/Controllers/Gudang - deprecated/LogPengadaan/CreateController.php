<?php

namespace App\Http\Controllers\Gudang\LogPengadaan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Gudang\ItemsTemplate;
use App\Models\Gudang\Items;
use App\Models\Gudang\Pengadaan;
use App\Models\Gudang\LogPengadaan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;
use Carbon\Carbon;
use DB;
use Bugsnag;
use File;
use Image;
use DateTime;
use Auth;

class CreateController extends Controller
{
	public function create($log, $qty = 0, $pengadaan_id = 0, $harga = 0, $diskon = 0, $ppn = 10, $subtotal = 0, $tanggal, $batch="")
	{
		$pengadaan = Pengadaan::find($pengadaan_id);
		$new_log = new LogPengadaan;
		$new_log->item_id = $log->id;
		$new_log->jumlah = $qty;
		$new_log->tanggal = $tanggal;
		$new_log->batch = $batch;
		$new_log->pengadaan_id = $pengadaan_id;

		$items = ItemsTemplate::withTrashed()->find($log->item_template_id);
		// dd($new_log, $items, $log);
		if($harga && $items) 
		{
			$items->harga = $harga;
			$items->save();
		}
		$new_log->harga_saat_itu = $items->harga;
		$new_log->diskon = $diskon;
		$new_log->ppn = $ppn;
		// dd($qty, $items);
		$new_log->subtotal = (float)$items->harga * (float)$qty * (100-$diskon)/100;
		$new_log->save();
		
		return $new_log->subtotal;
	}

}
