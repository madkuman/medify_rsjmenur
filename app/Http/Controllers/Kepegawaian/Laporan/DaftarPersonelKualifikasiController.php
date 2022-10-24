<?php

namespace App\Http\Controllers\Kepegawaian\Laporan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Models\Kepegawaian\Pegawai;
use App\Models\Kepegawaian\TandaTangan;
use MPDF;

class DaftarPersonelKualifikasiController extends Controller
{
	public function index(Request $request)
	{
        \Blade::setEchoFormat('nl2br(e(%s))');
		ini_set("pcre.backtrack_limit", "5000000");
		$start = Carbon::parse($request->bulan_tahun)->startOfMonth();
		$start = $start->format('Y-m-d');
		$data['kop_bulan'] = app('App\Http\Controllers\Functions\DateFormatter')->dateFormat($start,'%B %Y');

		$data['pegawai'] = Pegawai::where('status_aktif','Aktif')->whereIn('official_status',$request->status)
		->where(function($q) use ($start) {
			$q->WhereNull('tmt_out')->orWhere(function($q2) use ($start){
				$q2->whereDate('tmt','<=',$start)->whereDate('tmt_out','>=',$start);
			});
		})
		->orderBy('print_order','asc')->orderBy('pangkat_order','asc')->get();
		$data['ttd'] = TandaTangan::find($request->ttd_id);

		$pdf = MPDF::loadView('kepegawaian.laporan.hasil.daftar-personel-kualifikasi.index',$data, [], [
			'format' => 'A4'
		]);
		$filename = 'Laporan-Daftar-Personel-Berdasarkan-Kualifikasi'.$start.'.pdf';
		return $pdf->stream($filename); 
	}
}
