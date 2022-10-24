<?php

namespace App\Http\Controllers\Pasien\Laporan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RawatInap\Bangsal;
use Carbon\Carbon;

class ViewController extends Controller
{
    public function indikatorPelayanan()
    {
        $data['date_range_start_month_default'] = Carbon::today()->subMonth();
        $data['date_range_end_month_default'] = Carbon::today();
        $data['date_range_start_day_default'] = Carbon::today()->subDay();
        $data['date_range_end_day_default'] = Carbon::today();
        $data['date_single_day_default'] = Carbon::today();
        $data['tahun'] = Carbon::now()->format('Y');
        $data['triwulan'] = Carbon::now()->format('m')/3;
        $bangsal = Bangsal::all();
        $bangsal_option = $bangsal->pluck('nama','id')->toArray();
        $bangsal_option = ['-1' => 'Semua Bangsal' ] + $bangsal_option;
        $data['bangsal_select'] = [
            'form_title' => 'Bangsal',
            'form_name' => 'bangsal_id',
            'form_option' => $bangsal_option,
            'multiple' => true,
            'selected_value' => -1,
        ];
    	return view('pasien.laporan.laporan-indikator-pelayanan',$data);
    }
}
