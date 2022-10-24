<?php

namespace App\Http\Controllers\BPJS\Piutang;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Keuangan\Piutang;
use App\Models\Keuangan\Perusahaan;
use App\Models\Keuangan\Akun;
use Carbon\Carbon;
use DB;
use MPDF;
use DOMPDF;
use Auth;

class ViewController extends Controller
{
    public function index()
    {
        $data['sidebar_active'] = "piutang";
        $today = Carbon::today();
        $data['today'] = $today;
        $data['perusahaan'] = Perusahaan::all();
        $data['rawat_inap'] = config('const.rawat_inap');
        $data['akun'] = Akun::get();
        $data['rawat_jalan'] = config('const.rawat_jalan');
        return view('bpjs.piutang.index',$data);
    }

}