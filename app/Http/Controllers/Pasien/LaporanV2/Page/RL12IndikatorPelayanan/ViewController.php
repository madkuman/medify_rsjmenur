<?php

namespace App\Http\Controllers\Pasien\LaporanV2\Page\RL12IndikatorPelayanan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Models\Hospital\MasterSIRSTempatTidurKelas;
use App\Models\RawatInap\Bangsal;

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
        $data['kelas'] = MasterSIRSTempatTidurKelas::get();
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
    	return view('pasien.laporanv2.pages.rl-12-indikator-pelayanan.index',$data);
    }
}
