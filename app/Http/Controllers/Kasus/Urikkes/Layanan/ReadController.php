<?php

namespace App\Http\Controllers\Kasus\Urikkes\Layanan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Keuangan\Tarif;
use App\Models\Urikkes\Transaksi as TransaksiUrikkes;
use App\Models\Urikkes\TransaksiDetail;


class ReadController extends Controller
{
	public function get($kasus_id){
		$transaksi =  TransaksiUrikkes::where('kasus_id',$kasus_id)->first();
		if(isset($transaksi)){
			$layanan = TransaksiDetail::where('transaksi_id',$transaksi->id)->orderBy('paket_id')->get();
			return $layanan;
		}else{
			return [];
		}
	}
}
