<?php

namespace App\Http\Controllers\CSSD\TransaksiDetail;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CSSD\TransaksiDetail;

class CreateController extends Controller
{
    public function create($data)
    {   
        if(is_null($data['alkes_id'])) return;
        $count_alkes = count($data['alkes_id']);
        // if($count_alkes < 0) return; //kalau ga ada lgsng return;
        for($i = 0;$i<$count_alkes;$i++)
        {
            $jumlah_alkes_satuan = $data['alkes_jumlah'][$i];

            for($j = 0;$j<$jumlah_alkes_satuan;$j++)
            {
                $detail = new TransaksiDetail;
                $detail->transaksi_id = $data['transaksi_id'];
                $detail->item_template_id = $data['alkes_id'][$i];
                $detail->save();
            }
        }
    }

    public function createSingle($transaksi_id,$alkes_id,$alkes_satuan_id,$extra=0)
    {
        $detail = new TransaksiDetail;
        $detail->transaksi_id = $transaksi_id;
        $detail->item_template_id = $alkes_id;
        $detail->alkes_satuan_id = $alkes_satuan_id;
        $detail->extra = $extra;
        $detail->save();
    }
}
