<?php

namespace App\Http\Controllers\Kepegawaian\Laporan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\Pegawai;
use App\Models\Kepegawaian\TandaTangan;
use DOMPDF;
use App\Models\Pasien\TNISatker;
use Carbon\Carbon;
class GarjasMiliterController extends Controller
{
   public function index(Request $request)
   {	
        \Blade::setEchoFormat('nl2br(e(%s))');
   	$data['pegawai'] = Pegawai::where('id',$request->employee_id)->first();
   	$start = Carbon::parse($request->bulan_tahun)->startOfMonth();
  	$start = $start->format('Y-m-d');
  	$data['kop_bulan'] = app('App\Http\Controllers\Functions\DateFormatter')->dateFormat($start,'%B %Y');
   	$data['ttd'] = TandaTangan::find($request->ttd_id);
   	$data['tinggi'] = $request->tinggi;
   	$data['berat'] = $request->berat;
   	$data['klasifikasi_bb'] = $request->klasifikasi_bb;
   	$data['lari'] = $request->lari;
   	$nilaiMean = $request['nilai-battery-b'];
   	if($nilaiMean >= 81)
    {
        $kategori = 'BS';
    }
    else if($nilaiMean >= 61)
    {
        $kategori = 'B';
    }
    else if($nilaiMean >= 41)
    {
        $kategori = 'C';
    }
    else if($nilaiMean >= 37)
    {
        $kategori = 'K1';
    }
    else if($nilaiMean >= 0)
    {
        $kategori = 'K2';
    }
    $data['klasifikasi_garjasAB'] = $kategori;
    $data['nilai_garjasAB'] = $nilaiMean;
    $data['nilai_postur'] = $request['nilai-postur'];
    $data['pullup'] = $request->pullup;
    $data['pushup'] = $request->pushup;
    $data['situp'] = $request->situp;
    $data['shuttle'] = $request->shuttle;
    $data['nilai_pullup'] = $request->pullup2;
    $data['nilai_pushup'] = $request->pushup2;
    $data['nilai_situp'] = $request->situp2;
    $data['nilai_shuttle'] = $request->shuttle2;
    $data['satker'] = TNISatker::where('id',$request->kesatuan)->first();
    $data['nilai_lari'] = $request->lari2;
    $tl = Carbon::parse($data['pegawai']->birth_date)->format('Y-m-d');
    $data['keperluan'] = $request->keperluan;
    $data['tl'] = app('App\Http\Controllers\Functions\DateFormatter')->dateFormat($tl,'%d %B %Y');
  	$pdf = DOMPDF::loadView('kepegawaian.laporan.hasil.garjas-militer.index',$data)->setPaper('a4', 'portrait');
  	$pdf->setOptions(['defaultFont' => 'sans-serif', 'isRemoteEnabled' => true]);
  	$filename = 'Kesegaran-Jasmani-TNI-AL.pdf';
  	return $pdf->stream($filename); 

		//return view('kepegawaian.laporan.hasil.profile-pegawai.index',$return);
  }
}
