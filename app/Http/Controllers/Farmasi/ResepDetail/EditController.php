<?php

namespace App\Http\Controllers\Farmasi\ResepDetail;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Farmasi\ResepDetail;
use App\Models\Farmasi\RacikanDetail;
use App\Models\Farmasi\Items;
use App\Models\Farmasi\LogTransaksi;
use Carbon\Carbon;
use DB;
use Bugsnag;

class EditController extends Controller
{
  	public function payment($resep_id,$laba,$tagihan, $farm = null, $request = null)
	{
		if ($request == null) {
			$request = request();
		}
		//dd($distribusi_id);
		$i=0;
		$resep = ResepDetail::where('resep_id', $resep_id)->get();
		foreach ($resep as $detail) {
			$detail->laba = $laba[$i] ?? 0;
			$detail->embalase = $request->embalase[$i] ?? 0;
			if($detail->tipe) 
			{
				$subtotal = $this->payRacikan($detail->id,$laba[$i]);
				if(is_string($subtotal)) return 'Stok Tidak Tersedia';
				if($detail->jumlah == 0){
				    $detail->harga = 0;
                }else{
				    $detail->harga = round($subtotal/$detail->jumlah);
                }
				$detail->subtotal = $detail->harga*$detail->jumlah;
				$qty=0;
			}
			else
			{
				if(!isset($detail->obat_detail->item_detail)) return 'Stok Tidak Tersedia';
				$detail->harga = round($detail->obat_detail->item_detail->harga*(100 + $detail->laba)/100);
				$detail->subtotal = ceil($detail->harga*$detail->jumlah);
				$qty = $detail->jumlah;
			}
			$detail->subtotal += $detail->embalase;
			if ($detail->jumlah != 0) {
				$detail->harga = $detail->subtotal / $detail->jumlah;
			} else {
				$detail->harga = 0;
			}
			$detail->save();
			$i++;

	 		while($qty)
			{
				$log = Items::where('item_farmasi_id',$detail->obat_id)->where('jumlah','>',0)->where('kadaluarsa', '>' , Carbon::today()->toDateTimeString())->orderBy('kadaluarsa')->get();
			
				if(count($log) == 0){
					if(isset($farm->stok_kurang_confirm)){
						$items = Items::where('item_farmasi_id',$detail->obat_id)->where('kadaluarsa', '>' , Carbon::today()->toDateTimeString())->orderBy('updated_at', 'desc')->get();
						if(count($items) != 0){
							$items[0]->jumlah = -$qty;
							$items[0]->save();

							$new_log = new LogTransaksi;
							$new_log->item_id = $items[0]->id;
							$new_log->jumlah = $qty;
							$new_log->resep_detail_id = $detail->id;
							$new_log->save();
							$qty = 0;
							continue;
						}else{
							$today = Carbon::today()->format('d/m/Y');
							// $today = str_replace("-", "/", $today);
							$items = app('App\Http\Controllers\Farmasi\Items\CreateController')->newItem($detail->obat_id, -$qty, $today, $farm->id, 0);
							$new_log = new LogTransaksi;
							$new_log->item_id = $items->id;
							$new_log->jumlah = $qty;
							$new_log->resep_detail_id = $detail->id;
							$new_log->save();
							$qty = 0;
							continue;
						}
					}else{
						return 'Stok Tidak Tersedia';
					}
				} 
				$new_log = new LogTransaksi;
				$new_log->item_id = $log[0]->id;
				$new_log->resep_detail_id = $detail->id;

				if($log[0]->jumlah >= $qty)
				{
					$log[0]->jumlah -= $qty;
					$new_log->jumlah = $qty;
					$qty = 0;
				}
				else
				{
					if(count($log) == 1 && isset($farm->stok_kurang_confirm)){
						$new_log->jumlah = $qty;
						$log[0]->jumlah -= $qty;
						$qty = 0;
					}else{
						$qty -= $log[0]->jumlah;
						$new_log->jumlah = $log[0]->jumlah;
						$log[0]->jumlah = 0;
					}

				}
				
				$log[0]->save();
				$new_log->save();
			}
            if($tagihan){
                $tagihanKasus =  $this->insertTagihanKasus($detail);
                $detail->kasus_tagihan_detail_id = $tagihanKasus->id;
                $detail->save();
            }
		}

		return 1;
	}

	public function payRacikan($resep_detail_id,$laba)
	{
		//dd($distribusi_id);
		$i=0;
		$subtotal=0;
		$racikan = RacikanDetail::where('resep_detail_id', $resep_detail_id)->get();
		foreach ($racikan as $detail) {
			$detail->laba = $laba;
			$detail->harga = $detail->obat_detail->item_detail->harga*(100 + $detail->laba)/100;
			$detail->subtotal = $detail->harga*$detail->jumlah;
			$detail->save();
			$i++;
			$subtotal += $detail->subtotal;

			$qty = $detail->jumlah;
	 		while($qty)
			{
				$log = Items::where('item_farmasi_id',$detail->obat_id)->where('jumlah','>',0)->where('kadaluarsa', '>' , Carbon::today()->toDateTimeString())->orderBy('kadaluarsa')->first();
				if(!$log) return 'Stok Tidak Tersedia';
				$new_log = new LogTransaksi;
				$new_log->item_id = $log->id;
				$new_log->resep_detail_id = $resep_detail_id;

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
				
				$log->save();
				$new_log->save();
			}
		}

		return $subtotal;
	}

	private function insertTagihanKasus($detail)
	{
	    //$tagihan = app('App\Http\Controllers\Kasus\Tagihan\CreateController')->create($detail->resep_detail->transaksi_detail->kasus_id);

	    $data = array();
	    $data['tarif_id'] = null;
	    $data['tarif_tipe_id'] = 1;
	    $data['tarif_kelas'] = 0;
	    $data['kasus_id'] = $detail->resep_detail->transaksi_detail->kasus_id;
	    $data['sep_id'] = $detail->resep_detail->transaksi_detail->sep_id;
	    $data['lokasi'] = $detail->resep_detail->owner_detail->lokasi_id;
	    $data['desc'] = $detail->nama_obat;
		$data['qty'] = $detail->jumlah;
	    $data['unit_price'] = $detail->harga;
		
		$farmasi = session('farmasi', null);
		if ($farmasi == null) {
			$farmasi = $detail->resep_detail->transaksi_detail->owner_detail;
		}
		$transaksi_obat = $detail->resep_detail->transaksi_detail;
		if ($farmasi->perharian && (($transaksi_obat->pembayaran_detail->perusahaan->tipe->slug ?? 'tunai') == 'bpjs')) {
			if (isset($detail->hari7)) {
				$data['qty'] = $detail->hari7;
			}
		}
	    $data['nominal'] = $detail->subtotal;
	    $data['daftar_harga_id'] = 0;
	    
	    $tagihan_detail = app('App\Http\Controllers\Kasus\TagihanDetail\CreateController')->create($data);
	    return $tagihan_detail;
	}

	public function retur($id, $potongan = 0, $jumlah = 0, $old_jumlah = 0)
	{
		$log = LogTransaksi::find($id);
		$log->jumlah_retur = $jumlah;
		$log->potongan = $potongan;
		$subtotal = $log->detail_resep->harga * $jumlah;
		$subtotal -= $subtotal * $potongan / 100; 
		$log->subtotal_retur = $subtotal;
		$log->save();

		$item = Items::find($log->item_id);
		$item->jumlah = $item->jumlah - $old_jumlah + $jumlah;
		$item->save();

		return $subtotal;
	}

	public function createRetur($id,$potongan,$jumlah = 0,$resep_detail_id)
    {
        $log_lama = LogTransaksi::find($id);
        $log = new LogTransaksi;
        $log->jumlah = 0;
        $log->resep_detail_id = $resep_detail_id;
        $log->item_id = $log_lama->item_id;
        $log->jumlah_retur = $jumlah;
        $log->potongan = $potongan;
        $subtotal = $log_lama->detail_resep->harga * $jumlah;
        $subtotal -= $subtotal * $potongan / 100;
        $log->subtotal_retur = $subtotal;
        $log->save();

        $item = Items::find($log_lama->item_id);
        $item->jumlah += $jumlah;
        $item->save();

        return $subtotal;
    }
}
