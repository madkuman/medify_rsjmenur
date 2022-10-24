<?php

namespace App\Http\Controllers\CSSD\Paket;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\KamarOperasi\Paket;
use App\Models\CSSD\Alkes;
use App\Models\CSSD\AlkesSatuan;

class ReadController extends Controller
{
    public function getPaket($slug)
	{
		$paket = Paket::where('slug', $slug)->with('paket_item')->first();
		
		if(!empty($paket->id)){
			foreach ($paket->paket_item as $key => $item) {
				$alkes = Alkes::with(['stok_siap_pakai'])->find($item->item_id);
				if(count($alkes->stok_siap_pakai) < $item->jumlah){
					$diff = $item->jumlah - count($alkes->stok_siap_pakai);
					if (empty($data['error'])) {
						$data['error'] = $alkes->nama.": Kurang ".$diff."<br>";
					} else {
						$data['error'] .= $alkes->nama.": Kurang ".$diff."<br>";
					}
				}
				else {
					$data['success'] = AlkesSatuan::with('alkes')->where('item_template_id', $item->item_id)->whereNull('ok_transaksi_id')->take($item->jumlah)->get();
				}
			}
		
			return json_encode($data);
		}
		else
			return 0;
	}
}
