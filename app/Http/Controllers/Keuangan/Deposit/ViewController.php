<?php

namespace App\Http\Controllers\Keuangan\Deposit;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Keuangan\Deposit;
use App\Models\Keuangan\DepositLog;
use MPDF;


class ViewController extends Controller
{
	public function single($deposit_id)
	{
		$deposit = Deposit::find($deposit_id);
		$logs = DepositLog::where('deposit_id',$deposit_id)->orderBy('id','desc')->get();
		$data['deposit'] = $deposit;
		$data['logs'] = $logs;
		$data['sidebar_active'] = 'deposit';
		return view('keuangan.deposit.single',$data);
	}

	public function index()
	{
		$deposit = Deposit::orderBy('updated_at','desc')->get();
		$data['deposit'] = $deposit;
		$data['sidebar_active'] = 'deposit';
		return view('keuangan.deposit.index',$data);
	}

	public function create()
	{
		$data['kasir_id'] = null;
		$data['sidebar_active'] = "deposit";
		return view('keuangan.deposit.create',$data);
	}


	public function logPrint($log)
	{
		$log = DepositLog::find($log);
		$deposit = Deposit::find($log->deposit_id);
		$data['terima_dari'] = $deposit->pasien->name;

		$data['banyaknya_uang'] = app('App\Http\Controllers\Functions\SpellMoney')->spellMoney($log->jumlah);
		$data['terbilang'] = $log->jumlah;
		$data['pasien'] = 'Pembayaran Deposit';
		$data['nama_kasir'] = $log->creator->name;
		$data['no_rm'] = $deposit->pasien->no_rm;
		$pdf = MPDF::loadView('keuangan.pemasukan.print-kwitansi', $data, [], [
			'mode' => 'utf-8',
			'format' => [220, 360]
		]);

		$filename = 'kwitansi-deposit.pdf';

		return $pdf->stream($filename);
	}
}
