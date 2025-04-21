<?php

namespace App\Http\Controllers\Gizi\Laporan;

use App\Models\Gizi\WaktuMakan;
use App\Models\RawatInap\Bangsal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Exports\Gizi\LaporanPermintaanMakanan;
use App\Exports\Gizi\LaporanSuratPemesananMakanan;
use App\Exports\Gizi\LaporanSuratPemesananMakananTambahan;
use App\Exports\Gizi\LaporanDietPasienBulanan;
use App\Exports\Gizi\LaporanPenyerapanPorsiMakanan;
use App\Exports\Gizi\LaporanMakananUtama;
use App\Exports\Gizi\LaporanMakananTambahan;
use MPDF;

class ViewController extends Controller
{
    public function index()
    {
        $data['status'] = 'laporan';
        $data['bangsal'] = Bangsal::all();
        $data['waktu_makan'] = WaktuMakan::all();
        return view('gizi.laporan.index', $data);
    }

    public function laporanPermintaanMakanan(Request $request)
    {
        $data = app('App\Http\Controllers\Gizi\Laporan\LaporanController\LaporanPermintaanMakananController')->get($request);
        return (new LaporanPermintaanMakanan($data))->download('laporan_permintaan_makanan.xlsx');
    }

    public function laporanSuratPemesananMakanan(Request $request)
    {
        $data = app('App\Http\Controllers\Gizi\Laporan\LaporanController\LaporanSuratPemesananMakananController')->get($request);
        if ($request->file == 'excel')
            return (new LaporanSuratPemesananMakanan($data))->download('laporan_surat_pemesanan_makanan.xlsx');
        else {
            $pdf = MPDF::loadView('gizi.laporan.view.laporan-surat-pemesanan-makanan-pdf', $data, [], ['format' => 'A4-L']);
            return $pdf->stream('Surat Pemesanan Makanan.pdf');
        }
    }

    public function laporanSuratPemesananMakananTambahan(Request $request)
    {
        $data = app('App\Http\Controllers\Gizi\Laporan\LaporanController\LaporanSuratPemesananMakananTambahanController')->get($request);
        if ($request->file == 'excel')
            return (new LaporanSuratPemesananMakananTambahan($data))->download('laporan_surat_pemesanan_makanan_tambahan.xlsx');
        else {
            $pdf = MPDF::loadView('gizi.laporan.view.laporan-surat-pemesanan-makanan-pdf', $data, [], ['format' => 'A4-L']);
            return $pdf->stream('Surat Pemesanan Makanan.pdf');
        }
    }

    public function laporanDietPasienBulanan(Request $request)
    {
        $data = app('App\Http\Controllers\Gizi\Laporan\LaporanController\LaporanDietPasienBulanan')->get($request);
        return (new LaporanDietPasienBulanan($data))->download('laporan_diet_pasien_bulanan.xlsx');
    }

    public function laporanPenyerapanPorsiMakanan(Request $request)
    {
        $data = app('App\Http\Controllers\Gizi\Laporan\LaporanController\LaporanPenyerapanPorsiMakanan')->get($request);
        return (new LaporanPenyerapanPorsiMakanan($data))->download('laporan_penyerapan_porsi_makanan.xlsx');
    }

    public function laporanRekapDietPelayananMakananPasien(Request $request)
    {
        ini_set('memory_limit', "1024M");
        ini_set('max_execution_time', "300");
        $data = app('App\Http\Controllers\Gizi\Laporan\LaporanController\LaporanRekapDietPelayananMakananPasien')->get($request);
        if ($request->utama == 1) {
            return (new LaporanMakananUtama($data))->download('laporan_rekap_pelayanan_makanan_utama_pasien.xlsx');
        } else {
            return (new LaporanMakananTambahan($data))->download('laporan_rekap_pelayanan_makanan_tambahan_pasien.xlsx');
        }
    }
}
