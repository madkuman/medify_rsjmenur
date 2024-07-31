<?php

namespace App\Http\Controllers\Farmasi\JenisAntrian;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hospital\LokasiDepartemen;

class ViewController extends Controller
{
    public function index(Request $request, $farmasi)
    {
        try {
            $farm = session('farmasi');

            $data['farmasi'] = $farm;
            $data['jenis_antrian'] = app('App\Http\Controllers\Farmasi\JenisAntrian\ReadController')->getAll();
            $data['perusahaan_tipe'] = app('App\Http\Controllers\Admin\PembayaranPerusahaanType\ReadController')->getAll();
            $data['lokasi_departemen_khusus'] = LokasiDepartemen::whereIn('slug', ['rawat-jalan', 'rawat-inap', 'igd'])->get();
            $data['sidebar_active'] = "";

            return view('farmasi.screen.pengaturan.jenis-antrian.index',$data);
        } catch (\Exception $e) {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
        }
    }
}
