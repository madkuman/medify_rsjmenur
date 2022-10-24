<?php

namespace App\Http\Controllers\Eusulan\Laporan;

use App\Models\Eusulan\Unit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Exports\Eusulan\LaporanUsulanFinal;
use App\Exports\Eusulan\LaporanUsulanRekap;

class PostController extends Controller
{
    public function laporanUsulanFinal(Request $request)
    {
        $get_data = $this->getUnitIdsFromFilterFarmasi($request->unit_kriteria,$request->unit_ids);
        $unit_names = $get_data['unit_names'];
        $unit_ids = $get_data['unit_ids'];

        $data = app('App\Http\Controllers\Eusulan\Laporan\LaporanController\LaporanUsulanFinalController')->get($request->tahun,$unit_ids);
        return (new LaporanUsulanFinal($data))->download('laporan_usulan_final_'.$request->tahun.'.xlsx');
    }

    public function laporanUsulanRekap(Request $request)
    {
        $data = app('App\Http\Controllers\Eusulan\Laporan\LaporanController\LaporanUsulanRekapController')->get($request->tahun);
        return (new LaporanUsulanRekap($data))->download('laporan_usulan_rekap_'.$request->tahun.'.xlsx');
    }

    private function getUnitIdsFromFilterFarmasi($unit_kriteria, $unit_ids)
    {
        if(empty($unit_ids)){
            $unit_names = 'Semua Unit';
            $unit_ids = Unit::pluck('id')->toArray();
        }
        else
        {
            if($unit_kriteria == 'eksklusi'){
                $prefix_unit_names = 'Selain - ';
                $unit = Unit::whereIn('id',$unit_ids)->get();
                $unit_ids = Unit::whereNotIn('id',$unit_ids)->pluck('id')->toArray();
            }
            else if($unit_kriteria == 'inklusi'){
                $prefix_unit_names = '';
                $unit = Unit::whereIn('id',$unit_ids)->get();
                $unit_ids = Unit::whereIn('id',$unit_ids)->pluck('id')->toArray();
            }

            $unit_names = $prefix_unit_names.implode(",", $unit->pluck('nama')->toArray());
        }
        $data['unit_ids'] = $unit_ids;
        $data['unit_names'] = $unit_names;

        return $data;
    }
}
