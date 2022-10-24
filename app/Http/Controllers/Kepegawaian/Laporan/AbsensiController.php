<?php

namespace App\Http\Controllers\Kepegawaian\Laporan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\Pegawai;
use App\Models\Kepegawaian\TandaTangan;
use App\Models\Kepegawaian\MasterKualifikasi;
use Carbon\Carbon;
use MPDF;

class AbsensiController extends Controller
{
    public function index(Request $req)
	{	
        \Blade::setEchoFormat('nl2br(e(%s))');
		ini_set("pcre.backtrack_limit", "5000000");
		$start = Carbon::parse($req->bulan_tahun)->startOfMonth();
		$start = $start->format('Y-m-d');
		$data['kop_bulan'] = app('App\Http\Controllers\Functions\DateFormatter')->dateFormat($start,'%B %Y');

		$data['pegawai'] = Pegawai::where('status_aktif','Aktif')->whereIn('official_status',$req->status)
		->where(function($q) use ($start) {
			$q->WhereNull('tmt_out')->orWhere(function($q2) use ($start){
				$q2->whereDate('tmt','<=',$start)->whereDate('tmt_out','>=',$start);
			});
		})
		->orderBy('print_order','asc')->orderBy('pangkat_order','asc')->get();
		$data['ttd'] = TandaTangan::find($req->ttd_id);
		$data['judul'] = $req->judul;
		$pdf = MPDF::loadView('kepegawaian.laporan.hasil.absensi.index', $data, [], [
			'format' => 'legal-L',
			'orientation' => 'L'
		]);
		

		$filename = 'Laporan Absensi.pdf';
		return $pdf->stream($filename);
	}
}
