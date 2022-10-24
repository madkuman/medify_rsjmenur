<?php

namespace App\Http\Controllers\Urikkes\Transaksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Urikkes\Transaksi;
use Carbon\Carbon;

class ReadController extends Controller
{
	public function getTransaksi($date)
	{
		if(empty($date)){
			return Transaksi::with(['pasien_detail', 'transaksi_detail.tarif'])->whereDate('ordered_at', Carbon::today())->orderBy('ordered_at')->get();
		}else{
			$carbonDate = Carbon::createFromFormat('d-m-Y', $date)->toDateString();
			// dd(Carbon::today(), $carbonDate);
			return Transaksi::with(['pasien_detail', 'transaksi_detail.tarif'])->whereDate('ordered_at', $carbonDate)->orderBy('ordered_at')->get();
		}
	}

	public function getTransaksiRange($start,$end)
	{
		return Transaksi::with(['pasien_detail', 'transaksi_detail.tarif'])->whereBetween('ordered_at', [$start,$end])->orderBy('id','desc')->get();
	}

	public function getSingleKasus($kasus_id)
	{
		return Transaksi::with(['pasien_detail'])->where('kasus_id', $kasus_id)->first();
	}
}
