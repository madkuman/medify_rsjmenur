<?php

namespace App\Http\Controllers\CSSD\Laporan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Exports\CSSD\RekapPenggunaanAlat;

class PostController extends Controller
{
    public function rekapPenggunaanAlat(Request $request)
    {
        $tanggal_max = $request->tanggal_max;
        $tanggal_min = $request->tanggal_min;

        $tanggal_min = Carbon::createFromFormat('d/m/Y', $tanggal_min,'Asia/Jakarta')->startOfDay();
        $tanggal_max = Carbon::createFromFormat('d/m/Y', $tanggal_max,'Asia/Jakarta')->endOfDay();

        $data = app('App\Http\Controllers\CSSD\Laporan\RekapPenggunaanAlatController')->getData($tanggal_min,$tanggal_max);


        $start_format = $tanggal_min->format('d-m-y');
        $end_format = $tanggal_max->format('d-m-y');

        return (new RekapPenggunaanAlat($data))->download('rekap-jenis-operasi_'.$start_format.'_'.$end_format.'.xlsx');
    }
}
