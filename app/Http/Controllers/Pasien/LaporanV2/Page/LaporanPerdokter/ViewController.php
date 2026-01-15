<?php

namespace App\Http\Controllers\Pasien\LaporanV2\Page\LaporanPerdokter;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pasien\PembayaranPerusahaanType;
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
        $asuransi_option = PembayaranPerusahaanType::pluck('nama','slug')->toArray();
        $data['asuransi_select'] = [
            'form_title' => 'Asuransi',
            'form_name' => 'perusahaan_tipe',
            'form_option' => $asuransi_option,
            'multiple' => true,
            'selected_value' => '',
        ];
    	return view('pasien.laporanv2.pages.laporan-perdokter.index',$data);
    }
}
