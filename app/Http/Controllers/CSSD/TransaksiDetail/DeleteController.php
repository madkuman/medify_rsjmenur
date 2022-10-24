<?php

namespace App\Http\Controllers\CSSD\TransaksiDetail;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CSSD\TransaksiDetail;

class DeleteController extends Controller
{
    	public function deletePengirimanAlkes($transaksi_id)
    	{
    		$alkes_id = TransaksiDetail::where('transaksi_id',$transaksi_id)->pluck('alkes_satuan_id');
    		$alkes_satuan = app('App\Http\Controllers\CSSD\AlkesSatuan\EditController')->deleteKirimanAlkes($transaksi_id,$alkes_id);
    		$delete = TransaksiDetail::where('transaksi_id',$transaksi_id)->delete();
    		return 1;

    	}

    	public function deletePengembalianAlkes($transaksi_id)
    	{
    		$alkes_satuan_id = TransaksiDetail::where('transaksi_id',$transaksi_id)->pluck('alkes_satuan_id');
    		$alkes_satuan = app('App\Http\Controllers\CSSD\AlkesSatuan\EditController')->revertOkTransaksiIDtoLastLog($transaksi_id,$alkes_satuan_id);
    		$delete = TransaksiDetail::where('transaksi_id',$transaksi_id)->delete();
    		return 1;

    	}
}
