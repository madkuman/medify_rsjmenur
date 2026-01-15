<?php

namespace App\Http\Controllers\Farmasi\LaporanV2\PelayananResep;

use App\Exports\Farmasi\LaporanPelayananResepExcel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Farmasi\Farmasi;
use App\Models\Farmasi\Kategori;
use App\Models\Pasien\PembayaranPerusahaan;
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
        $perusahaan_pembayaran_id = $request->perusahaan_pembayaran_id ?? null;
        $kategori = $request->kategori ?? null;
        $farmasi_ids = $request->farmasi_ids ?? null;
        $farmasi_kriteria = $request->farmasi_ids ?? 'inklusi';


        if(!empty($perusahaan_pembayaran_id)){
            $perusahaan_pembayaran_id = explode(",",$perusahaan_pembayaran_id);
            $perusahaan_pembayaran_nama = PembayaranPerusahaan::whereIn('id',$perusahaan_pembayaran_id)->get()->pluck('nama')->toArray();
            $perusahaan_pembayaran_nama = implode(",",$perusahaan_pembayaran_nama);
        }
        else
            $perusahaan_pembayaran_nama = 'Semua';
            
        if(!empty($farmasi_ids)){
            $farmasi_ids = explode(",",$farmasi_ids);
            $farmasi_nama = Farmasi::whereIn('id',$farmasi_ids)->get()->pluck('nama')->toArray();
            $farmasi_nama = implode(",",$farmasi_nama);
        }
        else
            $farmasi_nama = 'Semua';

        if(!empty($kategori)){
            $kategori = explode(",",$kategori);
            $kategori_nama = Kategori::whereIn('id',$kategori)->get()->pluck('nama')->toArray();
            $kategori_nama = implode(",",$kategori_nama);
        }
        else
            $kategori_nama = 'Semua';

        if($farmasi_kriteria != 'inklusi' && $farmasi_nama != 'Semua')
        {
            $farmasi_kriteria = 'Kecuali';
            $farmasi_nama = $farmasi_kriteria.' '.$farmasi_nama;
        }
        
        $excel = new LaporanPelayananResepExcel([
            'data' => $data,
            'date_start' => $date_start,
            'date_end' => $date_end,
            'perusahaan_pembayaran_nama' => $perusahaan_pembayaran_nama,
            'kategori_nama' => $kategori_nama,
            'farmasi_nama' => $farmasi_nama,
            'farmasi_kriteria' => $farmasi_kriteria,
        ]);

        return $excel->download('Farmasi Laporan Pelayanan Resep.xlsx');
    }
}
