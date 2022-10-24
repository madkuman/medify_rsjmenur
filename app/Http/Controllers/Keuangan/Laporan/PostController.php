<?php

namespace App\Http\Controllers\Keuangan\Laporan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Exports\Keuangan\PemasukanRekapPasien;
use App\Exports\Keuangan\BukuUtang;
use App\Exports\Keuangan\BukuPiutang;
use App\Exports\Keuangan\BukuKas;
use App\Exports\Keuangan\TerimaKeluarTahunan;
use App\Exports\Keuangan\TerimaKeluarBulanan;
use App\Exports\Keuangan\RekapPengeluaran;
use App\Exports\Keuangan\PemasukanHarian;
use App\Exports\Keuangan\InvoicePO;
use DOMPDF;
use MPDF;

class PostController extends Controller
{
	public function riwayatPemasukanPasien(Request $request)
	{
		$start = $request->get('start');
		$end = $request->get('end');

		$start_date = Carbon::createFromFormat('Y-m-d', $start,'Asia/Jakarta')->startOfDay();
		$end_date = Carbon::createFromFormat('Y-m-d', $end,'Asia/Jakarta')->endOfDay();

		//$data['pemasukan'] = app('App\Http\Controllers\Keuangan\Laporan\PemasukanController')->rekapPemasukanPasien($start_date,$end_date);
		
		return (new PemasukanRekapPasien($start_date,$end_date))->download('riwayat-pemasukan-pasien_'.$start_date.'_'.$end_date.'.xlsx');
	}	

	public function bukuUtang(Request $request)
	{
		$bulan = $request->get('bulan');
		$bulan_start = Carbon::createFromFormat('Y-m', $bulan,'Asia/Jakarta')->startOfMonth();
		$bulan_end = Carbon::createFromFormat('Y-m', $bulan,'Asia/Jakarta')->endOfMonth();

		$bulan_prev_start = Carbon::createFromFormat('Y-m', $bulan,'Asia/Jakarta')->subMonth()->startOfMonth();
		$bulan_prev_end =  Carbon::createFromFormat('Y-m', $bulan,'Asia/Jakarta')->subMonth()->endOfMonth();

		$data['bulan_start']=$bulan_start;
		$data['bulan_end']=$bulan_end;
		$data['bulan_prev_start']=$bulan_prev_start;
		$data['bulan_prev_end']=$bulan_prev_end;

		$utang = app('App\Http\Controllers\Keuangan\Laporan\UtangController')->getAllUtang($data);
		return (new BukuUtang($utang))->download('buku-utang_'.$utang['bulan'].'.xlsx');
		//return view('keuangan.laporan.utang.buku-utang-print',$utang);
	}

	public function bukuPiutang(Request $request)
	{
		$bulan = $request->get('bulan');
		$bulan_start = Carbon::createFromFormat('Y-m', $bulan,'Asia/Jakarta')->startOfMonth();
		$bulan_end = Carbon::createFromFormat('Y-m', $bulan,'Asia/Jakarta')->endOfMonth();

		$bulan_prev_start = Carbon::createFromFormat('Y-m', $bulan,'Asia/Jakarta')->subMonth()->startOfMonth();
		$bulan_prev_end =  Carbon::createFromFormat('Y-m', $bulan,'Asia/Jakarta')->subMonth()->endOfMonth();

		$data['bulan_start']=$bulan_start;
		$data['bulan_end']=$bulan_end;
		$data['bulan_prev_start']=$bulan_prev_start;
		$data['bulan_prev_end']=$bulan_prev_end;

		$piutang = app('App\Http\Controllers\Keuangan\Laporan\PiutangController')->getAllPiutang($data);
		return (new BukuPiutang($piutang))->download('buku-piutang_'.$piutang['bulan'].'.xlsx');
		//return view('keuangan.laporan.piutang.buku-piutang-print',$utang);
	}


	public function rekapPemasukanPengeluaran(Request $request)
	{
		$bulan = $request->get('bulan');
		$bulan_start = Carbon::createFromFormat('Y-m', $bulan,'Asia/Jakarta')->startOfMonth();
		$data['sidebar_active'] = 'laporan';
		return view('keuangan.laporan.pemasukan-pengeluaran.rekap',$data);
	}

	public function bukuKas(Request $request)
	{
		$bulan = $request->get('bulan');
		$bulan_start = Carbon::createFromFormat('Y-m', $bulan,'Asia/Jakarta')->startOfMonth();
		$bulan_end = Carbon::createFromFormat('Y-m', $bulan,'Asia/Jakarta')->endOfMonth();

		$data['bulan_start']=$bulan_start;
		$data['bulan_end']=$bulan_end;
		
		$kas = app('App\Http\Controllers\Keuangan\Laporan\BukuKasController')->get($data);
			// return view('keuangan.laporan.kas.buku-kas-print',$kas);
		return (new BukuKas($kas))->download('buku-kas_'.$kas['bulan'].'.xlsx');
	}

	public function terimaKeluarBulanan(Request $request)
	{
		$bulan = $request->get('bulan');
		$bulan_start = Carbon::createFromFormat('Y-m', $bulan,'Asia/Jakarta')->startOfMonth();
		$bulan_end = Carbon::createFromFormat('Y-m', $bulan,'Asia/Jakarta')->endOfMonth();

		$data['bulan_start']=$bulan_start;
		$data['bulan_end']=$bulan_end;
		
		$terimakeluar = app('App\Http\Controllers\Keuangan\Laporan\TerimaKeluarController')->getBulanan($data);
			// return view('keuangan.laporan.terimakeluar.bulanan-print',$terimakeluar);
		return (new TerimaKeluarBulanan($terimakeluar))->download('penerimaan-pengeluaran_'.$terimakeluar['bulan'].'.xlsx');
	}

	public function terimaKeluarTahunan(Request $request)
	{
		$tahun = $request->get('tahun');

		$data['tahun']=$tahun;
		
		$terimakeluar = app('App\Http\Controllers\Keuangan\Laporan\TerimaKeluarController')->getTahunan($data);
			// return view('keuangan.laporan.terimakeluar.tahunan-print',$terimakeluar);
		return (new TerimaKeluarTahunan($terimakeluar))->download('penerimaan-pengeluaran_'.$tahun.'.xlsx');
	}

	public function rekapPengeluaran(Request $request)
	{
		$bulan = $request->get('bulan');
		$bulan_start = Carbon::createFromFormat('Y-m', $bulan,'Asia/Jakarta')->startOfMonth();
		$bulan_end = Carbon::createFromFormat('Y-m', $bulan,'Asia/Jakarta')->endOfMonth();

		$data['bulan_start']=$bulan_start;
		$data['bulan_end']=$bulan_end;
		
		$rekapkeluar = app('App\Http\Controllers\Keuangan\Laporan\PengeluaranController')->getRekapPengeluaran($data);
			// return view('keuangan.laporan.pengeluaran.rekap-pengeluaran-print',$rekapkeluar);
		return (new RekapPengeluaran($rekapkeluar))->download('rekap-pengeluaran_'.$rekapkeluar['bulan'].'.xlsx');
	}

	public function pemasukanHarian(Request $request)
	{
		$start = $request->get('start');
		$end = $request->get('end');

		$start_date = Carbon::createFromFormat('Y-m-d', $start,'Asia/Jakarta')->startOfDay();
		$end_date = Carbon::createFromFormat('Y-m-d', $end,'Asia/Jakarta')->endOfDay();

		$data = app('App\Http\Controllers\Keuangan\Laporan\PemasukanHarianController')->getPemasukanHarian($start_date,$end_date);
			// return view('keuangan.laporan.pemasukanharian.pemasukan-harian-print',$pemasukan);
		return (new PemasukanHarian($data))->download('rekap-pemasukan_'.$start_date.'_'.$end_date.'.xlsx');
	}

	public function laporanPJK(Request $request)
	{
		ini_set("pcre.backtrack_limit", "5000000");

		$start = $request->get('pjk_awal');
		$end = $request->get('pjk_akhir');
		$status_spp = $request->get('status_spp');
		$status_terbayar = $request->get('status_terbayar');
		$akun = $request->get('akun');

		if(empty($start) || empty($end))
		{
			abort(500,'Tanggal Kosong');
		}

		$start_date = Carbon::createFromFormat('d-m-Y', $start,'Asia/Jakarta')->startOfDay();
		$end_date = Carbon::createFromFormat('d-m-Y', $end,'Asia/Jakarta')->endOfDay();

		$data = app('App\Http\Controllers\Keuangan\Laporan\PengeluaranController')->getLaporanPJK($start_date,$end_date,$status_spp,$status_terbayar,$akun);
		// $pdf = DOMPDF::loadView('keuangan.laporan.pengeluaran.laporan-pjk', $data, [])->setPaper('a4', 'landscape');
		// $pdf->setOptions(['defaultFont' => 'sans-serif', 'isRemoteEnabled' => true]);
		$pdf = MPDF::loadView('keuangan.laporan.pengeluaran.laporan-pjk', $data, [], [
			'format' => 'A4-L',
			'orientation' => 'L'
		]);
		return $pdf->stream('Laporan PJK '.date("d M Y", strtotime($start)).'-'.date("d M Y", strtotime($end)).'.pdf');
	}

	public function laporanBK(Request $request)
	{
		ini_set("pcre.backtrack_limit", "5000000");

		$start = $request->get('bk_awal');
		$end = $request->get('bk_akhir');

		if(empty($start) || empty($end))
		{
			abort(500,'Tanggal Kosong');
		}

		$start_date = Carbon::createFromFormat('d-m-Y', $start,'Asia/Jakarta')->startOfDay();
		$end_date = Carbon::createFromFormat('d-m-Y', $end,'Asia/Jakarta')->endOfDay();

		$data = app('App\Http\Controllers\Keuangan\Laporan\PengeluaranController')->getLaporanBK($start_date,$end_date);
		// $pdf = DOMPDF::loadView('keuangan.laporan.pengeluaran.laporan-bk', $data, [])->setPaper('a4', 'landscape');
		// $pdf->setOptions(['defaultFont' => 'sans-serif', 'isRemoteEnabled' => true]);
		$pdf = MPDF::loadView('keuangan.laporan.pengeluaran.laporan-bk', $data, [], [
			'format' => 'A4-L',
			'orientation' => 'L'
		]);
		return $pdf->stream('Laporan BK '.date("d M Y", strtotime($start)).'-'.date("d M Y", strtotime($end)).'.pdf');
	}

	public function laporanBKDetail(Request $request)
	{
		ini_set("pcre.backtrack_limit", "5000000");

		$start = $request->get('bk_awal');
		$end = $request->get('bk_akhir');

		if(empty($start) || empty($end))
		{
			abort(500,'Tanggal Kosong');
		}

		$start_date = Carbon::createFromFormat('d-m-Y', $start,'Asia/Jakarta')->startOfDay();
		$end_date = Carbon::createFromFormat('d-m-Y', $end,'Asia/Jakarta')->endOfDay();

		$data = app('App\Http\Controllers\Keuangan\Laporan\PengeluaranController')->getLaporanBK($start_date,$end_date);
		// $pdf = DOMPDF::loadView('keuangan.laporan.pengeluaran.laporan-bk-detail', $data, [])->setPaper('a4', 'landscape');
		// $pdf->setOptions(['defaultFont' => 'sans-serif', 'isRemoteEnabled' => true]);
		$pdf = MPDF::loadView('keuangan.laporan.pengeluaran.laporan-bk-detail', $data, [], [
			'format' => 'A4-L',
			'orientation' => 'L'
		]);
        return $pdf->stream('Laporan BK Detail '.date("d M Y", strtotime($start)).'-'.date("d M Y", strtotime($end)).'.pdf');
	}

	public function laporanSPP(Request $request)
	{
		ini_set("pcre.backtrack_limit", "5000000");
		ini_set('max_execution_time', '240');

		$start = $request->get('spp_awal');
		$end = $request->get('spp_akhir');
		$status_terbayar = $request->get('status_terbayar');
		$kategori = $request->get('kategori');
		$perusahaan = $request->get('perusahaan');

		if(empty($start) || empty($end))
		{
			abort(500,'Tanggal Kosong');
		}

		$start_date = Carbon::createFromFormat('d-m-Y', $start,'Asia/Jakarta')->startOfDay();
		$end_date = Carbon::createFromFormat('d-m-Y', $end,'Asia/Jakarta')->endOfDay();

		$data = app('App\Http\Controllers\Keuangan\Laporan\PengeluaranController')->getLaporanSPP($start_date,$end_date,$kategori,$status_terbayar,$perusahaan);
		$pdf = MPDF::loadView('keuangan.laporan.pengeluaran.laporan-spp', $data, [], [
			'format' => 'A4-L',
			'orientation' => 'L'
		]);
		// $pdf = DOMPDF::loadView('keuangan.laporan.pengeluaran.laporan-spp', $data, [])->setPaper('a4', 'landscape');
		// $pdf->setOptions(['defaultFont' => 'sans-serif', 'isRemoteEnabled' => true]);
        return $pdf->stream('Laporan SPP '.date("d M Y", strtotime($start)).'-'.date("d M Y", strtotime($end)).'.pdf');
	}

	public function laporanSPPDetail(Request $request)
	{
		ini_set("pcre.backtrack_limit", "5000000");
		ini_set('max_execution_time', '240');

		$start = $request->get('spp_awal');
		$end = $request->get('spp_akhir');
		$status_terbayar = $request->get('status_terbayar');
		$kategori = $request->get('kategori');
		$perusahaan = $request->get('perusahaan');

		if(empty($start) || empty($end))
		{
			abort(500,'Tanggal Kosong');
		}

		$start_date = Carbon::createFromFormat('d-m-Y', $start,'Asia/Jakarta')->startOfDay();
		$end_date = Carbon::createFromFormat('d-m-Y', $end,'Asia/Jakarta')->endOfDay();

		$data = app('App\Http\Controllers\Keuangan\Laporan\PengeluaranController')->getLaporanSPP($start_date,$end_date,$kategori,$status_terbayar,$perusahaan);
		// $pdf = DOMPDF::loadView('keuangan.laporan.pengeluaran.laporan-spp-detail', $data, [])->setPaper('a4', 'landscape');
		// $pdf->setOptions(['defaultFont' => 'sans-serif', 'isRemoteEnabled' => true]);
		$pdf = MPDF::loadView('keuangan.laporan.pengeluaran.laporan-spp-detail', $data, [], [
			'format' => 'A4-L',
			'orientation' => 'L'
		]);
        return $pdf->stream('Laporan SPP Detail '.date("d M Y", strtotime($start)).'-'.date("d M Y", strtotime($end)).'.pdf');
	}

	public function laporanUJI(Request $request)
	{
		ini_set("pcre.backtrack_limit", "5000000");

		$start = $request->get('uji_awal');
		$end = $request->get('uji_akhir');
		$status_terbayar = $request->get('status_terbayar');
		$perusahaan = $request->get('perusahaan');

		if(empty($start) || empty($end))
		{
			abort(500,'Tanggal Kosong');
		}

		$start_date = Carbon::createFromFormat('d-m-Y', $start,'Asia/Jakarta')->startOfDay();
		$end_date = Carbon::createFromFormat('d-m-Y', $end,'Asia/Jakarta')->endOfDay();

		$data = app('App\Http\Controllers\Keuangan\Laporan\PengeluaranController')->getLaporanUJI($start_date,$end_date,$perusahaan,$status_terbayar);
		// $pdf = DOMPDF::loadView('keuangan.laporan.pengeluaran.laporan-pajak', $data, [])->setPaper('a4', 'landscape');
		// $pdf->setOptions(['defaultFont' => 'sans-serif', 'isRemoteEnabled' => true]);
		$pdf = MPDF::loadView('keuangan.laporan.pengeluaran.laporan-pajak', $data, [], [
			'format' => 'A4-L',
			'orientation' => 'L'
		]);
        return $pdf->stream('Laporan UJI '.date("d M Y", strtotime($start)).'-'.date("d M Y", strtotime($end)).'.pdf');
	}

	public function laporanTransaksiFile(Request $request)
	{
		ini_set("pcre.backtrack_limit", "5000000");

		$start = $request->get('tanggal_awal');
		$end = $request->get('tanggal_akhir');
		$perusahaan = $request->get('perusahaan');

		if(empty($start) || empty($end))
		{
			abort(500,'Tanggal Kosong');
		}

		$start_date = Carbon::createFromFormat('d-m-Y', $start,'Asia/Jakarta')->startOfDay();
		$end_date = Carbon::createFromFormat('d-m-Y', $end,'Asia/Jakarta')->endOfDay();

		$data = app('App\Http\Controllers\Keuangan\Laporan\PengeluaranController')->getLaporanTransaksiFile($start_date,$end_date,$perusahaan);
		// $pdf = DOMPDF::loadView('keuangan.laporan.pengeluaran.laporan-bk', $data, [])->setPaper('a4', 'landscape');
		// $pdf->setOptions(['defaultFont' => 'sans-serif', 'isRemoteEnabled' => true]);
		$pdf = MPDF::loadView('keuangan.laporan.pengeluaran.transaksi-file', $data, [], [
			'format' => 'A4-L',
			'orientation' => 'L'
		]);
		return $pdf->stream('Laporan Transaksi File Pengadaan '.date("d M Y", strtotime($start)).'-'.date("d M Y", strtotime($end)).'.pdf');
	}

    public function laporanPO(Request $request)
    {
    	ini_set("pcre.backtrack_limit", "5000000");

    	$start = date('d-m-Y', strtotime($request->get('tanggal_awal')));
		$end = date('d-m-Y', strtotime($request->get('tanggal_akhir')));
		$jenis = $request->get('jenis');

		if(empty($start) || empty($end))
		{
			abort(500,'Tanggal Kosong');
		}

		$start_date = Carbon::createFromFormat('d-m-Y', $start,'Asia/Jakarta')->startOfDay();
		$end_date = Carbon::createFromFormat('d-m-Y', $end,'Asia/Jakarta')->endOfDay();

        $data = app('App\Http\Controllers\Keuangan\Laporan\PengeluaranController')->getLaporanPO($start_date,$end_date,$jenis);
        // $pdf = DOMPDF::loadView('keuangan.laporan.po.print', $data, [])->setPaper('a4', 'landscape');
		// $pdf->setOptions(['defaultFont' => 'sans-serif', 'isRemoteEnabled' => true]);
		return (new InvoicePO($data))->download('Laporan PO '.date("d M Y", strtotime($start)).'-'.date("d M Y", strtotime($end)).'.xlsx');

  		//	$pdf = MPDF::loadView('keuangan.laporan.po.print', $data, [], [
		// 	'format' => 'A4-L',
		// 	'orientation' => 'L'
		// ]);
		// return $pdf->stream('Laporan PO '.date("d M Y", strtotime($start)).'-'.date("d M Y", strtotime($end)).'.pdf');
    }

	public function laporanPajak(Request $request)
	{
		ini_set("pcre.backtrack_limit", "5000000");
		
		$start = $request->get('pajak_awal');
		$end = $request->get('pajak_akhir');

		$start_date = Carbon::createFromFormat('d-m-Y', $start,'Asia/Jakarta')->startOfDay();
		$end_date = Carbon::createFromFormat('d-m-Y', $end,'Asia/Jakarta')->endOfDay();

		$data = app('App\Http\Controllers\Keuangan\Laporan\PengeluaranController')->getLaporanPajak($start_date,$end_date);
		$pdf = DOMPDF::loadView('keuangan.laporan.pengeluaran.laporan-pajak', $data, [])->setPaper('a4', 'landscape');
		$pdf->setOptions(['defaultFont' => 'sans-serif', 'isRemoteEnabled' => true]);
        return $pdf->stream('Laporan Pajak '.date("d M Y", strtotime($start)).'-'.date("d M Y", strtotime($end)).'.pdf');
	}
}
