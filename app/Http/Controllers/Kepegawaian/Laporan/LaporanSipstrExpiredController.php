<?php

namespace App\Http\Controllers\Kepegawaian\Laporan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\Pegawai;
use App\Models\Kepegawaian\TandaTangan;
use App\Models\Kepegawaian\MasterKualifikasi;
use Carbon\Carbon;
use MPDF;

class LaporanSipstrExpiredController extends Controller
{
    public function index(Request $request)
	{
        \Blade::setEchoFormat('nl2br(e(%s))');
		$official_status = $request->status;
		$months = $request->expired_in;

		$periode = Carbon::parse($request->periode)->startOfMonth();
		$start_periode = $periode->copy();
		$periode = $periode->format('Y-m-d');

		$data['kop_bulan'] = app('App\Http\Controllers\Functions\DateFormatter')->dateFormat($periode,'%B %Y');
		$data['ttd'] = TandaTangan::find($request->ttd_id);

		if($request->sipstr == "str") $pegawai = $this->getSTRExpired($start_periode,$official_status,$months);
		if($request->sipstr == "sip") $pegawai = $this->getSIPExpired($start_periode,$official_status,$months);

		$data['pegawai'] = $pegawai;
		$data['sipstr'] = $request->sipstr;

		$pdf = MPDF::loadView('kepegawaian.laporan.hasil.laporan-sipstr-expired.index',$data ,[],[
			'format' => 'legal',
		]);
		$filename = 'Laporan SIP/STR akan Expired.pdf';
		return $pdf->stream($filename);
	}

	private function getSTRExpired($periode,$official_status,$months)
	{
		if($months >= 0)
		{
			$start = $periode->startOfMonth();
			$end = $start->copy()->addMonths($months)->endOfMonth();
			$pegawai = Pegawai::where('status_aktif','Aktif')
			->whereIn('official_status',$official_status)
			->whereBetween('str_expired_at',[$start,$end])
			->get();
		}
		else
		{
			$start = $periode->startOfMonth();
			$end = $start->copy()->addMonths($months)->endOfMonth();
			$pegawai = Pegawai::where('status_aktif','Aktif')
			->whereIn('official_status',$official_status)
			->where('str_expired_at','<',$start)
			->get();
		}

		return $pegawai;
	}

	private function getSIPExpired($periode,$official_status,$months)
	{
		if($months >= 0)
		{
			$start = $periode->startOfMonth();
			$end = $start->copy()->addMonths($months)->endOfMonth();
			$pegawai = Pegawai::where('status_aktif','Aktif')
			->whereIn('official_status',$official_status)
			->whereBetween('sip_expired_at',[$start,$end])
			->get();
		}
		else
		{
			$start = $periode->startOfMonth();
			$end = $start->copy()->addMonths($months)->endOfMonth();
			$pegawai = Pegawai::where('status_aktif','Aktif')
			->whereIn('official_status',$official_status)
			->where('sip_expired_at','<',$start)
			->get();
		}

		return $pegawai;
	}
}
