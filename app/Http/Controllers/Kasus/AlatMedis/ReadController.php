<?php

namespace App\Http\Controllers\Kasus\AlatMedis;

use DB;
use Illuminate\Http\Request;
use App\Models\Kasus\ItemAlatMedis;
use App\Http\Controllers\Controller;
use App\Models\AlatMedis\ItemsTemplate;
use App\Models\Kasus\TransaksiAlatMedis;

class ReadController extends Controller
{
    public function cekKetersediaan($request)
    {
    	$index=0;

        $count_items = ItemAlatMedis::select(DB::raw('items_template_id, count(*) as jumlah'))->whereIn('items_template_id', $request['items_template_id'])->where('status', 0)->groupBy('items_template_id')->get();

    	foreach ($request['items_template_id'] as $key => $value) {
            if(empty($jumlah_permintaan[$value])){
                $jumlah_permintaan[$value] = $request['jumlah'][$index];  
            }else{
                $jumlah_permintaan[$value] += $request['jumlah'][$index];
            }

            $count_item = $count_items->firstWhere('items_template_id', $value)->jumlah;

    		if($count_item<$jumlah_permintaan[$value]){
    			$data = ItemsTemplate::select('name')->find($value)->name;
    		}else{
    			$data = null;
    		}
    		$index++;
    	}

    	return $data;
    }

    public function itemDigunakan($request)
    {
        $items = ItemAlatMedis::select(DB::raw('items.id as item_id, transaksi.id as transaksi_id')) 
                                ->join('transaksi', 'items.id', '=', 'transaksi.item_id')
                                ->where('items_template_id', $request['items_template_id'])   
                                ->where('kasus_id', $request['kasus_id'])
                                ->where('transaksi.status', 0)
                                ->limit($request['jumlah_pengembalian'])
                                ->get();

        return $items;
    }

    public function cariItemId($request)
    {
        $items = ItemAlatMedis::select('id', 'items_template_id')->whereIn('items_template_id', $request['items_template_id'])->where('status', 0)->get();

        $items_id = [];

        foreach ($request['items_template_id'] as $key => $value) {
            $chunk = $items->where('items_template_id', $value)->slice(0,$request['jumlah'][$key]);
            
            foreach ($chunk as $per_item) {
                array_push($items_id, $per_item->id);
            }
        }

        return $items_id;
    }
}
