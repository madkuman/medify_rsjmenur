<?php

namespace App\Http\Controllers\Kepegawaian\Laporan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\Pegawai;
use App\Models\Kepegawaian\TandaTangan;
use App\Models\Kepegawaian\MasterKualifikasi;
use Carbon\Carbon;
use MPDF;
use DOMPDF;

class LegalitasController extends Controller
{
    public function index(Request $request)
	{
        \Blade::setEchoFormat('nl2br(e(%s))');
		$jenis = $request->nama;
		$start = $request->start_date;
		$end   = $request->end_date;
		// $periode = Carbon::parse($request->periode)->startOfMonth();
		// $start_periode = $periode->copy();

		// $data['kop_bulan'] = app('App\Http\Controllers\Functions\DateFormatter')->dateFormat($periode,'%B %Y');
		// $data['ttd'] = TandaTangan::find($request->ttd_id);

		if($jenis == "str") $pegawai = $this->getExpiredSTR($start, $end);
		if($jenis == "sip") $pegawai = $this->getExpiredSIP($start, $end);

		$data['pegawai'] = $pegawai;
		$data['jenis'] = $request->nama;
		$data['tanggal'] = [$start, $end];

		$pdf = DOMPDF::loadView('kepegawaian.laporan.hasil.laporan-legalitas.index',$data);
		$filename = 'Laporan_Legalitas_Expired';
		
		return $pdf->stream($filename);
	}

	function getExpiredSIP($start, $end){
		$pegawai = Pegawai::where('status_pegawai_id',1)
			->whereBetween('sip_expired_at',[$start,$end])
			->get();
		return $pegawai;
	}

	function getExpiredSTR($start, $end){
		$pegawai = Pegawai::where('status_pegawai_id',1)
			->whereBetween('str_expired_at',[$start,$end])
			->get();
		return $pegawai;
	}

	
}
