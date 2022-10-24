<?php

namespace App\Http\Controllers\Pasien\LaporanV2\Page\RL32RawatDarurat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Models\RawatInap\Bangsal;

class ViewController extends Controller
{
    public function index()
    {

        $data['tahun_transaksi'] = app(\App\Http\Controllers\IGD\Transaksi\ReadController::class)->getAllYearTransaksi();
    	return view('pasien.laporanv2.pages.rl-3-2-rawat-darurat.index', $data);
    }
}
