<?php

namespace App\Http\Controllers\Urikkes\TransaksiDetail;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Urikkes\TransaksiDetail;

class CreateController extends Controller
{
    	public function create($transaksi_id,$tarif_id,$paket_id)
    	{
    		$detail = new TransaksiDetail;
    		$detail->transaksi_id = $transaksi_id;
    		$detail->tarif_id = $tarif_id;
    		$detail->paket_id = $paket_id;
    		$detail->save();
    		return $detail;
    	}
}
