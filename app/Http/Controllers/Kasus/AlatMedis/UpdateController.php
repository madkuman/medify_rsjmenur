<?php

namespace App\Http\Controllers\Kasus\AlatMedis;

use Auth;
use Illuminate\Http\Request;
use App\Models\Kasus\ItemAlatMedis;
use App\Http\Controllers\Controller;
use App\Models\Kasus\TransaksiAlatMedis;

class UpdateController extends Controller
{
    public function gunakanBarang($request, $items_id)
    {
        ItemAlatMedis::whereIn('id', $items_id)
                        ->update([
                            'location' =>  $request['lokasi'],
                            'status'   => 1
                        ]);

    }

    public function selesaiGunakanBarang($items)
    {
        $item_id      = [];
        $transaksi_id = [];

        foreach ($items as $per_item) {
            array_push($item_id, $per_item->item_id);
            array_push($transaksi_id, $per_item->transaksi_id);
        }

        ItemAlatMedis::whereIn('id', $item_id)
                        ->update([
                            'location' => '-',
                            'status'   => 0
                        ]);

        TransaksiAlatMedis::whereIn('id', $transaksi_id)
                        ->update([
                            'status'   => 1
                        ]);
        
    }
}
