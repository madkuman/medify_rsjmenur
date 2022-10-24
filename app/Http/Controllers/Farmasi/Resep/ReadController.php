<?php

namespace App\Http\Controllers\Farmasi\Resep;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Models\Farmasi\AturanObat;
use App\Models\Farmasi\ItemsFarmasi;

class ReadController extends Controller
{
    public function checkPenggunaanObat(Request $request)
    {
        $list_transaksi = app('App\Http\Controllers\Farmasi\Transaksi\ReadController')->getFromPasienIdForResep($request->pasien_id);
        $now = Carbon::now();
        $retval = 0;
		if (!empty($request->from_farmasi)) {
			$obat_id = ItemsFarmasi::where('id', (int)$request->obat_id)->pluck('item_template_id')->first();
		} else {
			$obat_id = (int)$request->obat_id;
		}
        // dd($list_transaksi[0]->final_detail->resep_detail[0]->obat_detail->item_template_id, (int)$request->obat_id);
		
		foreach ($list_transaksi as $transaksi) {
			if(!empty($transaksi->final_detail)){
				foreach ($transaksi->final_detail->resep_detail as $detail) {
					if (!empty($detail->obat_detail)) {
						if ($detail->obat_detail->item_template_id == $obat_id) {
					    	$usage_per_day = AturanObat::where('nama', $detail->aturan)->pluck('usage_per_day')->first();
					    	$created_date = Carbon::parse($detail->created_at);

					    	if (!empty($usage_per_day)) {
					    		$reorder_date = $created_date->copy()->addDays((int)((int)$detail->jumlah/$usage_per_day));
					    		if ($reorder_date > $now) {
					    			$retval = 1;
					    			break;
					    		}
					    	}
		        		}
					}
	        	}
			}
			if ($retval == 1) break;
        }

		return $retval;
    }
}
