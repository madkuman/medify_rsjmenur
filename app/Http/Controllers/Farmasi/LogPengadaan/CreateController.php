<?php

namespace App\Http\Controllers\Farmasi\LogPengadaan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Farmasi\Items;
use App\Models\Farmasi\Pengadaan;
use App\Models\Farmasi\LogPengadaan;
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
	public function create($log, $qty = 0, $pengadaan_id = 0, $harga = 0, $diskon = 0, $ppn = 10, $subtotal = 0, $tanggal, $batch, $produsen_id,   $jumlah_besar = 0, $jumlah_kecil = 0, $harga_box = 0)
	{

		$new_log = new LogPengadaan;
		$new_log->item_id = $log->id;
		$new_log->jumlah = $qty;
		$new_log->tanggal = $tanggal;
		$new_log->pengadaan_id = $pengadaan_id;
		$new_log->harga_saat_itu = $harga;
		$new_log->diskon = $diskon;
		$new_log->ppn = $ppn;
		$new_log->subtotal = $harga * $qty;
		$new_log->batch = $batch;
		$new_log->produsen_id = $produsen_id;
		$new_log->jumlah_kecil = $jumlah_kecil;
		$new_log->jumlah_besar = $jumlah_besar;
		$new_log->harga_box = $harga_box;
		$new_log->save();
		
		return $new_log;
	}

}
