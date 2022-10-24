<?php

namespace App\Http\Controllers\Farmasi\LaporanV2\PelayananResep;

use App\Exports\Farmasi\LaporanPelayananResepExcel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class ViewController extends Controller
{
    public function index()
    {
        $data['date_range_start_month_default'] = Carbon::today()->subMonth();
        $data['date_range_end_month_default'] = Carbon::today();
        $data['date_range_start_day_default'] = Carbon::today()->subDay();
        $data['date_range_end_day_default'] = Carbon::today();
        $data['date_single_day_default'] = Carbon::today();
        $data['tahun'] = Carbon::now()->format('Y');
        $data['triwulan'] = Carbon::now()->format('m')/3;
        $data['sidebar_active'] = 'laporan';
        $lokasi_beauty = app('App\Http\Controllers\Hospital\Lokasi\ReadController')->getLokasibyDepartemenBeauty(['rawat-inap','rawat-jalan','igd']);
        $pharmacy = app('App\Http\Controllers\Farmasi\Farmasi\ReadController')->getAll();
        $kategori = app('App\Http\Controllers\Farmasi\Kategori\ReadController')->getAll();
        $perusahaan = app('App\Http\Controllers\Farmasi\Farmasi\ReadController')->getPerusahaan();
        $data['lokasi_beauty'] = $lokasi_beauty;
        $data['pharmacy'] = $pharmacy;
        $data['perusahaan'] = $perusahaan;
        $data['gorilla'] = $kategori;
        $data['kategori'] = $kategori;

    	return view('farmasi.laporanv2.pages.pelayanan-resep',$data);
    }

    public function download(Request $request)
    {
        $data = json_decode($request->data);
        $date_start = Carbon::parse($request->start_date);
        $date_end = Carbon::parse($request->end_date);
        $excel = new LaporanPelayananResepExcel([
            'data' => $data,
            'date_start' => $date_start,
            'date_end' => $date_end,
        ]);

        return $excel->download('Farmasi Laporan Pelayanan Resep.xlsx');
    }
}
