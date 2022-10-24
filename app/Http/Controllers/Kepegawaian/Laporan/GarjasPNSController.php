<?php

namespace App\Http\Controllers\Kepegawaian\Laporan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\Pegawai;
use App\Models\Kepegawaian\TandaTangan;
use DOMPDF;
use Carbon\Carbon;
class GarjasPNSController extends Controller
{
   public function index(Request $request)
   {	
        \Blade::setEchoFormat('nl2br(e(%s))');
   	$data['pegawai'] = Pegawai::where('id',$request->employee_id)->first();
   	$data['satker'] = $request->kesatuan;
   	$data['ttd'] = TandaTangan::find($request->ttd_id);
   	$data['tinggi'] = $request->tinggi;
   	$data['berat'] = $request->berat;
   	$data['tanggal'] = app('App\Http\Controllers\Functions\DateFormatter')->dateNow('%d %B %Y');
   	$data['kategori_umur'] = $request->kategori_umur;
   	$temp = $data['pegawai']->birth_date;
   	$lahir = Carbon::parse($temp)->format('d m Y');
   	//dd($lahir);
   	$lahir = explode(" ",$lahir);
   	$data['tgl_lahir'] = $lahir[0];
   	$data['bln_lahir'] = $lahir[1];
   	$data['thn_lahir'] = $lahir[2];
   	//dd($data['tanggal']);
	$data['waktu'] = $request->waktu;
	$data['nilai'] = $request->nilai;
	$data['kategori'] = $request->kategori;
	//dd($data);
	$pdf = DOMPDF::loadView('kepegawaian.laporan.hasil.garjas-pns.index',$data)->setPaper('a4', 'portrait');
	$pdf->setOptions(['defaultFont' => 'sans-serif', 'isRemoteEnabled' => true]);
	$filename = 'Kesegaran-Jasmani-PNS.pdf';
	return $pdf->stream($filename); 

		//return view('kepegawaian.laporan.hasil.profile-pegawai.index',$return);
  }
}
