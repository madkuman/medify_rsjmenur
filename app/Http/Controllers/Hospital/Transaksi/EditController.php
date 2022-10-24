<?php

namespace App\Http\Controllers\Hospital\Transaksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hospital\TransaksiMasuk;
use App\Models\Hospital\TransaksiMasukDetail;

class EditController extends Controller
{
    	public function edit($id,$local_id)
    	{
            $transaksi_detail = TransaksiMasukDetail::find($id);
            $transaksi_detail->transaksi_lokal_id = $local_id;
            $transaksi_detail->save();

    		return $transaksi_detail;
    	}

        /* SAAT PAKE YANG PENUNJANG DAN CORE
    	private function editUtama($id,$local_id)
    	{
    		$transaksi = TransaksiUtama::find($id);
    		$transaksi->transaksi_lokal_id = $local_id;
    		$transaksi->save();
    		return $transaksi;
    	}

    	private function editPenunjang($id,$local_id)
    	{
    		$transaksi = TransaksiPenunjang::find($id);
    		$transaksi->transaksi_lokal_id = $local_id;
    		$transaksi->save();
    		return $transaksi;
    	}
        */
}
