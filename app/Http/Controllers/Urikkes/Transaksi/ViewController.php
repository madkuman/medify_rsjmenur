<?php

namespace App\Http\Controllers\Urikkes\Transaksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Models\Urikkes\Transaksi;

class ViewController extends Controller
{
	public function index(Request $request)
	{
		if(empty($request->date))
			$date = Carbon::today()->format('d-m-Y');
		else
			$date = $request->date;  

		$data['transaksi'] = app('App\Http\Controllers\Urikkes\Transaksi\ReadController')->getTransaksi($request->date);
		$data['date'] = $date;
		return view('urikkes/transaksi/index', $data);
	}

	public function detail(Request $request)
	{
		$data['transaksi'] = app('App\Http\Controllers\Urikkes\Transaksi\ReadController')->getDetailTransaksi($request->transaksi_id);
		return view('urikkes/transaksi/detail', $data);
	}

	public function edit(Request $request)
	{
		$data['transaksi'] = app('App\Http\Controllers\Urikkes\Transaksi\ReadController')->getDetailTransaksi($request->transaksi_id);
		$data['layanan'] = app('App\Http\Controllers\Urikkes\Layanan\ReadController')->getAllLayanan();
		return view('urikkes/transaksi/edit', $data);
	}

	public function tambah(Request $request)
	{
		$transaksi = new class{};
		$transaksi->nama = "";
		$transaksi->id = 0;
		$transaksi->layanan = [];
		$data['transaksi'] = $transaksi;
		$data['layanan'] = app('App\Http\Controllers\Urikkes\Layanan\ReadController')->getAllLayanan();
		return view('urikkes/transaksi/edit', $data);
	}

	public function histori(Request $request)
	{
		$date_start = $request->date_start;
		$date_end = $request->date_end;

		if(!empty($date_start)) $start = Carbon::createFromFormat('d-m-Y', $date_start)->startOfDay();
		else $start = Carbon::today()->subDay(7)->startOfDay();

		if(!empty($date_end)) $end = Carbon::createFromFormat('d-m-Y', $date_end)->endOfDay();
		else $end = Carbon::today()->endOfDay();

		$data['date_start'] = $start;
		$data['date_end'] = $end;
		$data['transaksi'] = app('App\Http\Controllers\Urikkes\Transaksi\ReadController')->getTransaksiRange($start,$end);
		return view('urikkes/histori-transaksi/index', $data);
	}
}
