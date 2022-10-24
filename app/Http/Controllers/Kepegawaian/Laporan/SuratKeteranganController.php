<?php

namespace App\Http\Controllers\Kepegawaian\Laporan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\Pegawai;
use App\Models\Kepegawaian\TandaTangan;
use App\Models\Kepegawaian\MasterKualifikasi;
use Carbon\Carbon;
use MPDF;
use App\Models\Pasien\TNISatker;

class SuratKeteranganController extends Controller
{
    public function index(Request $req)
	{	
        \Blade::setEchoFormat('nl2br(e(%s))');
		$data = [];
		$data['kesatuan'] = TNISatker::where('id',$req->kesatuan)->first();
		$data['pegawai'] = Pegawai::where('id',$req->employee_id)->first();
		$data['nomor_sprin'] = $req->nomor_sprin;
		$data['ttd'] = TandaTangan::find($req->ttd_id);
		$data['penandatangan'] = Pegawai::where('id',$data['ttd']->employee_id)->first();
		$data['aktif_mulai'] = Carbon::parse($data['pegawai']->tmt)->format('d/m/Y');
		$format = '%d %B %Y';
		$start = Carbon::now();
		$start = $start->format('Y-m-d');
		//$tanggal = Carbon::now();
		$data['tanggal'] = app('App\Http\Controllers\Functions\DateFormatter')->dateFormat($start,$format);
		//dd($data);
		$pdf = MPDF::loadView('kepegawaian.laporan.hasil.surat-keterangan.index', $data, [], [
			'format' => 'legal',
			'orientation' => 'P'
		]);

		$filename = 'Surat Keterangan.pdf';
		return $pdf->stream($filename);
	}
}
