<?php

namespace App\Http\Controllers\Kepegawaian\Laporan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\DSP;
use App\Models\Kepegawaian\TandaTangan;
use Carbon\Carbon;
use MPDF;

class DaftarSusunanPersonelController extends Controller
{
    public function index(Request $req)
	{
        \Blade::setEchoFormat('nl2br(e(%s))');
		$date =  Carbon::createFromFormat('d-m-Y', $req->get('bulan_tahun'),'Asia/Jakarta')->startOfDay();
        $result['date'] = app('App\Http\Controllers\Functions\DateFormatter')->timestampFormat($date, '%B %Y');
        $result['data'] = DSP::all();
        $result['ttd'] = TandaTangan::find($req->get('ttd_id'));
		$pdf = MPDF::loadView('kepegawaian.laporan.hasil.daftar-susunan-personel.index', $result, [], [
			'format' => 'legal-L',
			'orientation' => 'L'
		]);
		$filename = 'Daftar Susunan Personel '.$result['date'].'.pdf';

		return $pdf->stream($filename);
	}
}
