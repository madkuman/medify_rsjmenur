<?php

namespace App\Http\Controllers\Pasien\LaporanV2\Page\LaporanKunjunganUnitTindakan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\UnitTindakan\UnitTindakan;
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
        $unit_tindakan_option = UnitTindakan::pluck('nama','id')->toArray();
        $data['unit_tindakan'] = [
            'form_title' => 'Unit Tindakan',
            'form_name' => 'unit_tindakan',
            'form_option' => $unit_tindakan_option,
            'multiple' => true,
            'selected_value' => '',
        ];
    	return view('pasien.laporanv2.pages.laporan-kunjungan-unit-tindakan.index',$data);
    }
}
