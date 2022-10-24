<?php

namespace App\Http\Controllers\Pasien\LaporanV2\Page\RawatJalanLaporan10BesarPenyakitPerKlinik;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Models\RawatJalan\Poliklinik;

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
        $data['poli'] = Poliklinik::get();
        
    	return view('pasien.laporanv2.pages.rawat-jalan-laporan-10-besar-penyakit-per-klinik.index',$data);
    }
}
