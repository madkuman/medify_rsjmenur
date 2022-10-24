<?php

namespace App\Http\Controllers\Urikkes\Laporan;

use Illuminate\Http\Request;
use App\Exports\Urikkes\RekapTransaksi;
use App\Http\Controllers\Controller;
use App\Models\Pasien\TNISatker;
use App\Models\Pasien\TNIKotama;
use Carbon\Carbon;
use App\Models\Urikkes\DokterUrikkes;
use App\Http\Controllers\Functions\DateFormatter;
use App\Exports\Urikkes\SistemDiskesal;
use DOMPDF;

class ViewController extends Controller
{
	public function index(Request $request)
	{
		$data['dokter'] = DokterUrikkes::all();
		$data['satker'] =  TNISatker::all();
		$data['kesatuan'] =  TNIKotama::all();
		$data['today'] = (new DateFormatter)->dateNow("%B %Y");
		$data['awal_tahun'] = Carbon::now()->startOfYear()->format('d-m-Y');
		$data['akhir_tahun'] = Carbon::now()->endOfYear()->format('d-m-Y');
		$tanggal = Carbon::now();
		$data['bulan_romawi'] = (new DateFormatter)->numberToRoman(date("m", strtotime($tanggal)));
		$data['tahun'] = Carbon::now()->format('Y');
		//dd($data['bulan_romawi']);
		return view('urikkes.laporan.index', $data);
	}

	public function riwayat(Request $request)
	{	
		$data['type'] = $request->get_by;
		$data['transaksi'] = app('App\Http\Controllers\Urikkes\Laporan\ReadController')->getRiwayat($request);
		$data['tanggal']= str_replace(' ', '&nbsp;', $request->tanggal);
		$data['judul'] = $request->judul;
		$data['no_surat'] = str_replace(' ', '&nbsp;', $request->no_surat);
		$data['date'] = $request->tahun." (".date("d-m-Y", strtotime($request->tanggal_min))." s/d ".date("d-m-Y", strtotime($request->tanggal_max)).")";
		if($request->get_by == 'nrp'){
			$data['nrp'] = explode(',', $request->nrp);
			// $data['nrp_min'] = $request->nrp_min;
			// $data['nrp_max'] = $request->nrp_max;
		}
		else if($request->get_by == 'satker-pilihan')
		{
			$data['satker'] =  TNISatker::where('cetak',1)->pluck('nama')->toArray();
		}
		else
		{
			$satker =  TNISatker::find($request->satker);
			$kesatuan =  TNIKotama::find($request->kesatuan);
			if(isset($satker))
				$data['satker'] = $satker->nama;
			else
				$data['satker'] = "";

			if(isset($kesatuan))
				$data['kesatuan'] = $kesatuan->nama;
			else
				$data['kesatuan'] = "";
			
		}
		$data['dokter'] = json_decode($request->dokter);
		$pdf = DOMPDF::loadView('urikkes.laporan.riwayat', $data)->setPaper('a4', 'landscape');
		return $pdf->stream('Hasil Uji Dan Pemeriksaan - '.$data['type']);
	}

	public function pasienUmum(Request $request)
	{
		$data['type'] = $request->get_by;
		$data['transaksi'] = app('App\Http\Controllers\Urikkes\Laporan\ReadController')->getPasienUmum($request);
		$data['tanggal']= str_replace(' ', '&nbsp;', $request->tanggal);
		$data['judul'] = $request->judul;
		$data['no_surat'] = str_replace(' ', '&nbsp;', $request->no_surat);
		$data['date'] = $request->tahun." (".date("d-m-Y", strtotime($request->tanggal_min))." s/d ".date("d-m-Y", strtotime($request->tanggal_max)).")";
		if($request->get_by == 'nrp'){
			$data['nrp'] = explode(',', $request->nrp);
			// $data['nrp_min'] = $request->nrp_min;
			// $data['nrp_max'] = $request->nrp_max;
		}
		else if($request->get_by == 'satker-pilihan')
		{
			$data['satker'] =  TNISatker::where('cetak',1)->pluck('nama')->toArray();
		}
		else
		{
			$satker =  TNISatker::find($request->satker);
			$kesatuan =  TNIKotama::find($request->kesatuan);
			if(isset($satker))
				$data['satker'] = $satker->nama;
			else
				$data['satker'] = "";

			if(isset($kesatuan))
				$data['kesatuan'] = $kesatuan->nama;
			else
				$data['kesatuan'] = "";
			
		}
		$data['dokter'] = json_decode($request->dokter);
		$pdf = DOMPDF::loadView('urikkes.laporan.pasien-umum', $data)->setPaper('a4', 'landscape');
		return $pdf->stream('Laporan Pasien Umum.pdf');	
	}

	public function rekap(Request $request)
	{
		$data = app('App\Http\Controllers\Urikkes\Laporan\ReadController')->getRekap($request);
		$data['type'] = $request->get_by;
		$data['date'] = $request->tahun." (".date("d-m-Y", strtotime($request->tanggal_min))." s/d ".date("d-m-Y", strtotime($request->tanggal_max)).")";

		if($request->get_by == 'nrp'){
			$data['nrp'] = explode(',', $request->nrp);
			// $data['nrp_min'] = $request->nrp_min;
			// $data['nrp_max'] = $request->nrp_max;
		}
		else if($request->get_by == 'satker-pilihan')
		{
			$data['satker'] =  TNISatker::where('cetak',1)->pluck('nama')->toArray();
		}
		else{
			$satker =  TNISatker::find($request->satker);
			$kesatuan =  TNIKotama::find($request->kesatuan);
			if(isset($satker))
				$data['satker'] = $satker->nama;
			else
				$data['satker'] = "";

			if(isset($kesatuan))
				$data['kesatuan'] = $kesatuan->nama;
			else
				$data['kesatuan'] = "";			
		}
		
		$data['dokter'] = json_decode($request->dokter);
		// dd($data);
		$pdf = DOMPDF::loadView('urikkes.laporan.rekap', $data)->setPaper('a4', 'landscape');
		return $pdf->stream('urikkes.laporan.rekap');
	}

	public function sistemDiskesal(Request $request) {
		$data['transaksi'] = app('App\Http\Controllers\Urikkes\Laporan\ReadController')->getDiskesal($request);
		if($request->get_by == 'nrp'){
			$data['nrp'] = explode(',', $request->nrp);
			// $data['nrp_min'] = $request->nrp_min;
			// $data['nrp_max'] = $request->nrp_max;
		}
		else if($request->get_by == 'satker-pilihan')
		{
			$data['satker'] =  TNISatker::where('cetak',1)->pluck('nama')->toArray();
		}
		else{
			if(isset($satker))
				$data['satker'] = $satker->nama;
			else
				$data['satker'] = "";

			if(isset($kesatuan))
				$data['kesatuan'] = $kesatuan->nama;
			else
				$data['kesatuan'] = "";			
		}
		return (new SistemDiskesal($data))->download('Laporan_Terintegrasi_Sistem_Diskesal.xlsx');
	}

	public function pamenPnsJiwaTreadmill(Request $request) {
		$tanggal = $request->tanggal;
		$tanggal_min = $request->tanggal_min;
		$tanggal_max = $request->tanggal_max;

		$tanggal_min = Carbon::createFromFormat('d-m-Y', $tanggal_min)->startOfDay();
		$tanggal_max = Carbon::createFromFormat('d-m-Y', $tanggal_max)->endOfDay();

		$transaksi = app('App\Http\Controllers\Urikkes\Laporan\ReadController')->getPamenPnsJiwaTreadmill($tanggal_min,$tanggal_max);
		$data['transaksi'] = $transaksi;

		$data['tanggal'] = $request->tanggal;
		$data['tanggal_min'] = $tanggal_min;
		$data['tanggal_max'] = $tanggal_max;
		$data['judul'] = $request->judul;
		$data['no_surat'] = $request->no_surat;
		/*
		if($request->get_by == 'nrp'){
			$data['nrp'] = explode(',', $request->nrp);
			// $data['nrp_min'] = $request->nrp_min;
			// $data['nrp_max'] = $request->nrp_max;
		}
		else if($request->get_by == 'satker-pilihan')
		{
			$data['satker'] =  TNISatker::where('cetak',1)->pluck('nama')->toArray();
		}
		else{
			$data['satker'] =  TNISatker::find($request->satker)->nama;
			$data['kesatuan'] =  TNIKotama::find($request->kesatuan)->nama;			
		}*/
		$data['dokter'] = json_decode($request->dokter);
		$pdf = DOMPDF::loadView('urikkes.laporan.pamen-pns-jiwa-treadmill', $data)->setPaper('a4', 'landscape');
		return $pdf->stream('urikkes.laporan.pamen-pns-jiwa-treadmill');
	}

    
	public function rekapTransaksi(Request $request)
    {
        $tanggal_min = $request->tanggal_min;
        $tanggal_max = $request->tanggal_max;

        $tanggal_min = Carbon::createFromFormat('d-m-Y', $tanggal_min)->startOfDay();
        $tanggal_max = Carbon::createFromFormat('d-m-Y', $tanggal_max)->endOfDay();

        $data['transaksi'] = app('App\Http\Controllers\Urikkes\Laporan\ReadController')->getRekapTransaksi($tanggal_min,$tanggal_max);

        $data['tanggal_min'] = $tanggal_min;
        $data['tanggal_max'] = $tanggal_max;

        $start_format = $tanggal_min->format('d-m-Y');
        $end_format = $tanggal_max->format('d-m-Y');

        return (new RekapTransaksi($data))->download('Laporan_Rekapitulasi_Medical_Checkup_'.$start_format.'_'.$end_format.'.xlsx');
    }
}

