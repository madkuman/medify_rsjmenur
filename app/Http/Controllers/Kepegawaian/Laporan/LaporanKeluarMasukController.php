<?php

namespace App\Http\Controllers\Kepegawaian\Laporan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use MPDF;
use App\Models\Kepegawaian\Pegawai;
use App\Models\Kepegawaian\TandaTangan;
use Carbon\Carbon;
class LaporanKeluarMasukController extends Controller
{
	public function index(Request $request)
	{	
        \Blade::setEchoFormat('nl2br(e(%s))');
		$date1 = Carbon::parse($request->input('bulan_tahun'))->startOfMonth();
		$date2 = Carbon::parse($request->input('bulan_tahun'))->endOfMonth();
		$start = Carbon::parse($request->bulan_tahun)->startOfMonth();
		$start = $start->format('Y-m-d');
		$data['kop_bulan'] = app('App\Http\Controllers\Functions\DateFormatter')->dateFormat($start,'%B %Y');

		$data['pegawai_masuk'] = Pegawai::whereIn('official_status',$request->status)
		->whereBetween('tmt',[$date1,$date2])
		->orderBy('print_order','asc')->orderBy('pangkat_order','asc')->get();

		$data['pegawai_keluar'] = Pegawai::whereIn('official_status',$request->status)
		->whereBetween('tmt_out',[$date1,$date2])
		->orderBy('print_order','asc')->orderBy('pangkat_order','asc')->get();
		
		$data['ttd'] = TandaTangan::find($request->ttd_id);
		$pdf = MPDF::loadView('kepegawaian.laporan.hasil.laporan-keluar-masuk.index',$data, [], [
			'format' => 'legal-L',
			'orientation' => 'L'
		]);
		$filename = 'Laporan-Keluar-Masuk-Personel.pdf';
		return $pdf->stream($filename);
	}
}
