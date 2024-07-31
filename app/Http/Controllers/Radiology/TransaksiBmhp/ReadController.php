<?php

namespace App\Http\Controllers\Radiology\TransaksiBmhp;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Farmasi\ItemsTemplate;
use App\Models\Radiology\TransaksiBmhp;

class ReadController extends Controller
{
    public function getDatabyTransaksi($transaksi_id){
        $data = TransaksiBmhp::where('transaksi_id',$transaksi_id)->get();
        return $data;
    }

    public function getJoinedDatabyTransaksi($transaksi_id)
    {
        $item_masters = app('App\Http\Controllers\Farmasi\ItemTemplate\ReadController')->getItemKategori('radiologi');
        $item_current = app('App\Http\Controllers\Radiology\TransaksiBmhp\ReadController')->getDatabyTransaksi($transaksi_id);

        $item_masters = $item_masters->pluck('id')->toArray();
        $item_current = $item_current->pluck('item_template_id')->toArray();
        $all_items = array_unique(array_merge($item_masters, $item_current));

        $all_item_formed = [];
        foreach($all_items as $item_temp)
        {
            $temp = new \stdClass();
            $temp->id = $item_temp;
            $temp->nama = ItemsTemplate::find($item_temp)->nama ?? '';
            $temp->jumlah = TransaksiBmhp::where('transaksi_id',$transaksi_id)->where('item_template_id',$item_temp)->first()->jumlah ?? 0;
            $all_item_formed[] = $temp;
        }

        return $all_item_formed;
    }
}
