<?php

namespace App\Http\Controllers\LabPA\Laporan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DOMPDF;
use Carbon\Carbon;

class ViewController extends Controller
{
	static protected $departemen_id = 'lab-pa';
	static protected $header = "laporan";

	public function index(Request $req)
	{
		$data['header'] = self::$header;
		$data['current_month'] = Carbon::now()->subMonth()->format('Y-m');
		$data['laporan'] = $this->getLaporanData();
		return view('labpa.laporan.index',$data);
	}

	private function getLaporanData()
	{
		$array_laporan = ['Data Diagnosa Pasien Bulanan','Rekap Jumlah Pasien Bulanan'];

		$array = [];

		$labpa = config('const.lab-pa');

		foreach($array_laporan as $item)
		{
			$temp = app('App\Http\Controllers\Hospital\Laporan\ReadController')->getAllFormed($item,$labpa);
			$array[] = $temp;
		}

		return $array;
	}

	public function cetakDetail(Request $req, $transaksiSlug, $detailId)
	{
		\Blade::setEchoFormat('nl2br(e(%s))');

		$data['transaksi'] = app('App\Http\Controllers\LabPA\Transaction\ReadController')->getPatientService($transaksiSlug);
		$data['detail'] = app('App\Http\Controllers\LabPA\Transaction\ReadController')->getTransactionDetail($detailId);
		if(!is_null($data['detail']->result)) $data['result'] = json_decode($data['detail']->result);
		if($data['result']->jenis_form == 'papsmear'){
			$pdf = DOMPDF::loadView('labpa.laporan.print-papsmear', $data);
		}
		else {
			$pdf = DOMPDF::loadView('labpa.laporan.print-detail', $data);
		}
		return $pdf->stream('Hasil Pemeriksaan LabPA '.date("M Y", strtotime($req->get('date'))).'.pdf');
	}
}