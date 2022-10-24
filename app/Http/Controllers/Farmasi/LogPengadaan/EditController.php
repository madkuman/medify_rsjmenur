<?php

namespace App\Http\Controllers\Farmasi\LogPengadaan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Farmasi\Items;
use App\Models\Farmasi\ItemsFarmasi;
use App\Models\Farmasi\Pengadaan;
use App\Models\Farmasi\LogPengadaan;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use DB;
use Bugsnag;
use File;
use Image;

class EditController extends Controller
{
	public function edit($log_id, $item_id, $qty = 0, $harga = 0, $diskon = 0, $ppn = 10, $subtotal = 0, $expired = null, $tanggal, $produsen_id, $jumlah_kecil = 0, $jumlah_besar = 0, $harga_box = 0)
	{
		$log = LogPengadaan::find($log_id);
		$item = Items::find($log->item_id);

		$item->jumlah -= $log->jumlah;
		$item->save();

		$new_item = app('App\Http\Controllers\Farmasi\Items\CreateController')->newItem($item_id,$qty,$expired,$item->farmasi_id);

		$log->item_id = $new_item->id;
		$log->jumlah = $qty;
		$log->tanggal = $tanggal;		
		$log->harga_saat_itu = $harga;
		$log->diskon = $diskon;
		$log->ppn = $ppn;
		$log->subtotal = $harga * $qty;
		$log->produsen_id = $produsen_id;
		$log->jumlah_kecil = $jumlah_kecil;
		$log->jumlah_besar = $jumlah_besar;
		$log->harga_box = $harga_box;
		$log->save();
		
		return $log->subtotal;
		
	}

}
