<?php

namespace App\Http\Controllers\Farmasi\WaktuEstimasiJenisResep;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ViewController extends Controller
{
    public function index()
    {
        try {
            $farm = session('farmasi');

            $data['farmasi'] = $farm;
            $data['waktu_etimasi'] = app('App\Http\Controllers\Farmasi\WaktuEstimasiJenisResep\ReadController')->getAll();
            $data['sidebar_active'] = "";

            return view('farmasi.screen.pengaturan.waktu-estimasi-jenis-resep.index', $data);
        } catch (\Exception $e) {
            app('App\Http\Controllers\Error\Handler')->bugsnag($e);
        }
    }
}
