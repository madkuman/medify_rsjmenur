<?php

namespace App\Http\Controllers\Kasus\Tagihan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Tagihan;
use App\Models\Kasus\TagihanDetail;

class ReadController extends Controller
{
    	public function get($kasus_id)
    	{
    		$tagihan = Tagihan::with(['detail_descending.lokasi','detail_descending.sep','detail_descending.creator', 'detail_descending.sep', 'piutang.kasir'])->where('kasus_id',$kasus_id)->orderBy('created_at', 'desc')->get();
    		return $tagihan;
    	}

    	public function getOKTagihan($transaksi_ok)
    	{
    		$tagihan = TagihanDetail::where('transaksi_kamar_operasi_id',$transaksi_ok)->get();
    		return $tagihan;
    	}

        public function getId($tagihan_id)
        {
            $tagihan = Tagihan::with(['detail_descending.lokasi','detail_descending.sep','detail_descending.creator', 'detail_descending.sep', 'piutang.kasir'])->where('id',$tagihan_id)->first();
            return $tagihan;
        }
}
