<?php

namespace App\Http\Controllers\Farmasi\LogDistribusi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Farmasi\LogDistribusi;
use App\Models\Farmasi\Items;
use App\Models\Farmasi\ItemsFarmasi;
use App\Models\Farmasi\Distribusi;
use Carbon\Carbon;
use DB;
use Bugsnag;

class CreateController extends Controller
{


	public function createDraft($item_id, $qty=0, $distribusi_id, $client=0)
	{
		$draft = new LogDistribusi;
		$draft->item_farmasi_id = $item_id;
		$draft->jumlah = $qty;
		$draft->distribusi_id = $distribusi_id;
		$draft->jenis = 0;
		$draft->tipe = 1;
		$draft->save();
	}

	public function createLogMasuk($log, $qty = 0, $distribusi_id = 0, $alasan = null)
	{
		$distribusi = Distribusi::find($distribusi_id);

		$new_log = new LogDistribusi;
		$new_log->item_id = $log->id;
		$new_log->jumlah = $qty;
		$new_log->jenis = 1;
		$new_log->alasan_ditolak = $alasan;
		$new_log->tipe = 1;
		$new_log->distribusi_id = $distribusi_id;
		$new_log->subtotal = $log->detail_item->item_detail->harga * $qty;
		$new_log->jumlah_setelah_distribusi = $log->jumlah;
		$new_log->save();
		
		return $new_log->subtotal;
	}


  	public function createLogKeluarTanpaMengurangi($item_farmasi, $qty = 0, $distribusi_id)
	{
		$total = 0;
		$booked_items_id = [];
		while($qty)
		{

			$log = Items::where('item_farmasi_id',$item_farmasi)
					->where('jumlah','>',0)
					->where('kadaluarsa', '>' , Carbon::today())
					->whereNotIn('id', $booked_items_id)
					->orderBy('kadaluarsa')
					->first();
			if(!$log) return 0;
			array_push($booked_items_id, $log->id);
			$jumlah = $log->jumlah;
			$new_log = new LogDistribusi;
			$new_log->jenis = 1;
			$new_log->tipe = -1;
			$new_log->item_id = $log->id;
			$new_log->distribusi_id = $distribusi_id;

			if($jumlah >= $qty)
			{
				$jumlah -= $qty;
				$new_log->jumlah = $qty;
				$qty = 0;
			}
			else
			{
				$qty -= $jumlah;
				$new_log->jumlah = $jumlah;
				$jumlah = 0;
			}

			$new_log->subtotal = $new_log->jumlah * $log->detail_item->item_detail->harga;
			$total += $new_log->subtotal;
			
			// $log->save();
			$new_log->save();
		}

		return $total;
	}

	public function createLogKeluar($item, $qty = 0, $distribusi_id)
	{
		$log = Items::find($item);
		if(!$log) return 0;
		$new_log = new LogDistribusi;
		$new_log->item_id = $log->id;
		$new_log->distribusi_id = $distribusi_id;
		$new_log->jumlah = $qty;
		$new_log->jenis = 1;
		$new_log->tipe = -1;
		$new_log->subtotal = $new_log->jumlah * $log->detail_item->item_detail->harga;
		$log->jumlah -= $qty;
		
		$log->save();
		$new_log->save();

		return $new_log->subtotal;
	}







	public function createForeignDraft($item_id, $qty=0, $distribusi_id, $farmasi_id)
	{
		$item = ItemsFarmasi::where('item_template_id', $item_id)->where('farmasi_id', $farmasi_id)->first();
		$draft = new LogDistribusi;
		if($item) $draft->item_id = $item->id;
		$draft->item_src = $item_id;
		$draft->jumlah = $qty;
		$draft->distribusi_id = $distribusi_id;
		$draft->jenis = 0;
		$draft->save();
	}

	public function createRetur($item, $qty = 0, $distribusi_id)
	{
		$log = Items::find($item);
		if(!$log) return 0;
		$new_log = new LogDistribusi;
		$new_log->item_id = $log->id;
		$new_log->jenis = 1;
		$new_log->distribusi_id = $distribusi_id;
		$new_log->jumlah = $qty;
		$new_log->subtotal = $new_log->jumlah * $log->detail_item->item_detail->harga;
		$log->jumlah_sedia -= $qty;
		
		$log->save();
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

    public function createFixLogKeluar($log_id, $jumlah,$alasan)
    {
        //set to draft
        $log = LogDistribusi::find($log_id);
        $log->jenis = 0;
        $log->alasan_ditolak = $alasan;
        $log->save();

        $new_log = new LogDistribusi;
        $new_log->distribusi_id = $log->distribusi_id;
        $new_log->item_farmasi_id = $log->item_farmasi_id;
        $new_log->item_id = $log->item_id;
        $new_log->jenis = 1;
        $new_log->jumlah = $jumlah;
        $new_log->jumlah_setelah_distribusi = $jumlah;
        $new_log->subtotal = $log->detail_item->detail_item->harga * $jumlah;
        $new_log->tipe = $log->tipe;
        $new_log->alasan_ditolak = $alasan;
        $new_log->save();
    }
}
