<?php

namespace App\Http\Controllers\Pasien\LaporanV2\Page\DKK22LaporanBulananSTPRawatJalan;

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
        $data['data_umur'] = [
            '0 - 28 hr',
            '28 - <1th',
            '1 - 4 th',
            '5 - 14 th',
            '15 - 24 th',
            '25 - 44 th',
            '45 - 64 th',
            '65 + th'
        ];
    	return view('pasien.laporanv2.pages.dkk-22-laporan-bulanan-stp-rawat-jalan.index',$data);
    }
}
