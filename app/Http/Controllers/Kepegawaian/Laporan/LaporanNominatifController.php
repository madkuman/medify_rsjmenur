<?php

namespace App\Http\Controllers\Kepegawaian\Laporan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Models\Kepegawaian\Pegawai;
use App\Models\Kepegawaian\TandaTangan;
use MPDF;

class LaporanNominatifController extends Controller
{
	public function index(Request $request)
	{
        \Blade::setEchoFormat('nl2br(e(%s))');
		ini_set("pcre.backtrack_limit", "5000000");
		$start = Carbon::parse($request->bulan_tahun)->startOfMonth();
		$start = $start->format('Y-m-d');
		$data['kop_bulan'] = app('App\Http\Controllers\Functions\DateFormatter')->dateFormat($start,'%B %Y');

		$tanggal_surat = Carbon::parse($request->tanggal_surat)->startOfMonth();
		$tanggal_surat = $tanggal_surat->format('Y-m-d');
		$data['tanggal_surat'] = app('App\Http\Controllers\Functions\DateFormatter')->dateFormat($tanggal_surat,'%d %B %Y');
		$data['nomor_sprin'] = $request->nomor_sprin;
		$data['pegawai'] = Pegawai::where('status_aktif','Aktif')->whereIn('official_status',$request->status)
		->where(function($q) use ($start) {
			$q->WhereNull('tmt_out')->orWhere(function($q2) use ($start){
				$q2->whereDate('tmt','<=',$start)->whereDate('tmt_out','>=',$start);
			});
		})
		->orderBy('print_order','asc')->orderBy('pangkat_order','asc')->get();
		$data['ttd'] = TandaTangan::find($request->ttd_id);

		$pdf = MPDF::loadView('kepegawaian.laporan.hasil.daftar-nominatif.index',$data, [], [
			'format' => 'legal-L',
			'orientation' => 'L'
		]);
		$filename = 'Laporan-Daftar-Nominatif_'.$start.'.pdf';
		return $pdf->stream($filename); 


	}
}
