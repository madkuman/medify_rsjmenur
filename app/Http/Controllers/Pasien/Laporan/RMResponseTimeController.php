<?php

namespace App\Http\Controllers\Pasien\Laporan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RekamMedis\Transaksi;
use Carbon\Carbon;

class RMResponseTimeController extends Controller
{
	public function get($start, $end)
	{
		$transaksi = Transaksi::whereBetween('created_at',array($start,$end))->where('jenis',1)->where('status','!=','-1')->whereNotNull('sender_confirmed_at')->get();
		$transaksi->average = $this->average($transaksi);
		$transaksi->sum = $this->sum($transaksi);
		return $transaksi;
	}

	private function average($transaksi)
	{
		$time = [];
		foreach($transaksi as $item)
		{
			$created_at = $item->created_at;
			$send_at = Carbon::parse($item->sender_confirmed_at);
			$response_time = $created_at->diffInSeconds($send_at);
			$time[] = $response_time; 
		}
		if(count($time) != 0)
		{
			$average = ceil(array_sum($time) / count($time));	
		}
		else
		{
			$average = 0;
		}
		$average_date = $this->secondsToTime($average);
		$explode = explode(',', $average_date);
		$day = $explode[0];
		$time = $explode[1];

		if($day > 0) return ($day.' - '.$time);
		else return $time;
	}

	private function sum($transaksi)
	{
		$time = [];
		foreach($transaksi as $item)
		{
			$created_at = $item->created_at;
			$send_at = Carbon::parse($item->sender_confirmed_at);
			$response_time = $created_at->diffInSeconds($send_at);
			$time[] = $response_time; 
		}
		if(count($time) != 0)
		{
			$sum = array_sum($time);	
		}
		else
		{
			$sum = 0;
		}
		$sum_date = $this->secondsToTime($sum);
		$explode = explode(',', $sum_date);
		$day = $explode[0];
		$time = $explode[1];

		if($day > 0) return ($day.' - '.$time);
		else return $time;
	}

	private function secondsToTime($seconds) {
		$dtF = new \DateTime('@0');
		$dtT = new \DateTime("@$seconds");
		return $dtF->diff($dtT)->format('%a hari, %h:%i:%s');
	}
}
