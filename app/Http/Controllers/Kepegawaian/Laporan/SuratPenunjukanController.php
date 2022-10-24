<?php

namespace App\Http\Controllers\Kepegawaian\Laporan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\Pegawai;
use App\Models\Kepegawaian\TandaTangan;
use App\Models\Kepegawaian\MasterKualifikasi;
use Carbon\Carbon;
use MPDF;

class SuratPenunjukanController extends Controller
{
    public function index(Request $req)
	{
        \Blade::setEchoFormat('nl2br(e(%s))');
		$date =  Carbon::createFromFormat('d-m-Y', $req->get('bulan_tahun'),'Asia/Jakarta')->startOfDay();
        $result['title'] = $req->get('judul');
        $result['type'] = $req->get('jenis');
        $result['letter_num'] = app('App\Http\Controllers\Functions\DateFormatter')->numberToRoman($date->month).'/'.$date->year;
        $result['date'] = app('App\Http\Controllers\Functions\DateFormatter')->timestampFormat($date, '%B %Y');
		$result['data'] = Pegawai::whereIn('id', $req->get('daftar-personel'))->orderBy('print_order')->get();
		$result['ttd'] = TandaTangan::find($req->get('ttd_id'));
		$pdf = MPDF::loadView('kepegawaian.laporan.hasil.surat-penunjukan.index', $result, [], [
			'format' => 'legal',
			'orientation' => 'P'
		]);

		$filename = 'Surat Penunjukan.pdf';
		return $pdf->stream($filename);
	}
}
