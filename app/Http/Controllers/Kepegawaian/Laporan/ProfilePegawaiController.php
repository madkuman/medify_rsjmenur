<?php

namespace App\Http\Controllers\Kepegawaian\Laporan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\Pegawai;
use App\Models\Kepegawaian\TandaTangan;
use DOMPDF;

class ProfilePegawaiController extends Controller
{
	public function index(Request $request)
	{      
		
        \Blade::setEchoFormat('nl2br(e(%s))');
		$data = (object) $request->all();
		if(empty($data->employee_id))
        {
            abort(500,'Anda tidak memilih nama pegawai!');
        }
        $pegawai = Pegawai::find($data->employee_id);
		$ttd = TandaTangan::find($data->ttd_id);

		$return['pegawai'] = $pegawai;
		$return['ttd'] = $ttd;
		$return['pegawai']->kelahiran_format_new = $pegawai->kelahiran;

		$pdf = DOMPDF::loadView('kepegawaian.laporan.hasil.profile-pegawai.index',$return)->setPaper('a4', 'portrait');
	$pdf->setOptions(['defaultFont' => 'sans-serif', 'isRemoteEnabled' => true]);
	$filename = 'Daftar Riwayat Personel -'.$pegawai->nrp.'.pdf';
	return $pdf->stream($filename); 

	//return view('kepegawaian.laporan.hasil.profile-pegawai.index',$return);
	}
}
