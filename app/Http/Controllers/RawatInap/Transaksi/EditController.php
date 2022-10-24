<?php

namespace App\Http\Controllers\RawatInap\Transaksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Models\RawatInap\Transaksi;
use Bugsnag;

class EditController extends Controller
{
    public function editKasus($kasus)
    {
        $transaksi = Transaksi::where('kasus_id',$kasus)
        ->where('status',0)->get();
        foreach ($transaksi as $item) 
        {
            $item->status = -1;
            $item->save();
        }
        return 1;
    }

    

    public function editTransaksiRM($transaksi_id,$transaksi_rm_id)
    {
        $transaksi = Transaksi::find($transaksi_id);
        $transaksi->rm_transaksi_id = $transaksi_rm_id;
        $transaksi->save();
        return $transaksi;
    }
}
