<?php

namespace App\Http\Controllers\KamarOperasi\Laporan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Exports\KamarOperasi\RekapJenisOperasi;
use App\Exports\KamarOperasi\LaporanPenggunaanOK;
use App\Exports\KamarOperasi\DiagnosisTerbanyak;


class ViewController extends Controller
{
	public function index()
	{
    		$today = Carbon::today();
    		$start_date = $today->copy()->startOfMonth();
    		$end_date = $today->copy()->endOfDay();

		$data['kasus'] = app('App\Http\Controllers\KamarOperasi\Laporan\ReadController')->getKasusTerbanyak($start_date,$end_date);
		$data['occupancy'] = app('App\Http\Controllers\KamarOperasi\Laporan\ReadController')->getOccupancy($start_date,$end_date);
		$data['jenis_operasi'] = app('App\Http\Controllers\KamarOperasi\Laporan\ReadController')->getRekapJenisOperasi($start_date,$end_date);
		$data['ok_occupancy'] = app('App\Http\Controllers\KamarOperasi\Laporan\ReadController')->getOccupancyPerOK($start_date,$end_date);
		return view('kamaroperasi.laporan.index',$data);
	}

	public function rekapJenisOperasi(Request $request)
	{
		$tanggal_min = $request->get("tanggal_min");
		$tanggal_max = $request->get("tanggal_max");

		$tanggal_min = Carbon::createFromFormat('d/m/Y', $tanggal_min,'Asia/Jakarta')->startOfDay();
		$tanggal_max = Carbon::createFromFormat('d/m/Y', $tanggal_max,'Asia/Jakarta')->endOfDay();

		$data = app('App\Http\Controllers\KamarOperasi\Laporan\RekapJenisOperasiController')
		->getData($tanggal_min,$tanggal_max);

		$start_format = $tanggal_min->format('d-m-y');
		$end_format = $tanggal_max->format('d-m-y');

		//return view('kamaroperasi.laporan.rekap-jenis-operasi',$data);
		return (new RekapJenisOperasi($data))->download('rekap-jenis-operasi_'.$start_format.'_'.$end_format.'.xlsx');
	}

	public function laporanPenggunaanRuangan(Request $request)
	{
		$tanggal_min = $request->get("tanggal_min");
		$tanggal_max = $request->get("tanggal_max");

		$tanggal_min = Carbon::createFromFormat('d/m/Y', $tanggal_min,'Asia/Jakarta')->startOfDay();
		$tanggal_max = Carbon::createFromFormat('d/m/Y', $tanggal_max,'Asia/Jakarta')->endOfDay();

		$data = app('App\Http\Controllers\KamarOperasi\Laporan\LaporanPenggunaanRuangan')
		->getData($tanggal_min,$tanggal_max);

		$start_format = $tanggal_min->format('d-m-y');
		$end_format = $tanggal_max->format('d-m-y');


		//return view('kamaroperasi.laporan.laporan-penggunaan-ruangan',$data);
		return (new LaporanPenggunaanOK($data))->download('laporan-penggunaan-ruangan'.$start_format.'_'.$end_format.'.xlsx');
	}

	public function diagnosisTerbanyak(Request $request)
	{
		$tanggal_min = $request->get("tanggal_min");
		$tanggal_max = $request->get("tanggal_max");

		$tanggal_min = Carbon::createFromFormat('d/m/Y', $tanggal_min,'Asia/Jakarta')->startOfDay();
		$tanggal_max = Carbon::createFromFormat('d/m/Y', $tanggal_max,'Asia/Jakarta')->endOfDay();

		$data = app('App\Http\Controllers\KamarOperasi\Laporan\DiagnosisTerbanyak')
		->getData($tanggal_min,$tanggal_max);

		$start_format = $tanggal_min->format('d-m-y');
		$end_format = $tanggal_max->format('d-m-y');


		//return view('kamaroperasi.laporan.diagnosis-terbanyak',$data);
		return (new DiagnosisTerbanyak($data))->download('laporan-penggunaan-ruangan'.$start_format.'_'.$end_format.'.xlsx');
	}


}
