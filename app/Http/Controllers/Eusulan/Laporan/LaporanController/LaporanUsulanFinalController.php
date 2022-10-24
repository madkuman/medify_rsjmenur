<?php

namespace App\Http\Controllers\Eusulan\Laporan\LaporanController;

use App\Models\Eusulan\LogUsulan;
use App\Models\Eusulan\Unit;
use App\Models\Eusulan\Usulan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class LaporanUsulanFinalController extends Controller
{
    public function get($tahun,$unit_ids)
    {
        $data = [];
        $units = Unit::whereIn('id',$unit_ids)->get();
        foreach ($units as $unit)
        {
            $data[$unit->id] = [];
            $usulan = Usulan::where('tahun',$tahun)->where('unit_id',$unit->id)->get();
            foreach ($usulan as $row){
                $data[$unit->id][$row->id]['usulan'] = $row;
                $data[$unit->id][$row->id]['akun_rekening'] = LogUsulan::Select('akun_rekening_id','kegiatan',DB::raw("sum(jumlah*harga) as total"))->where('usulan_id',$row->id)->where('status',1)->with('barang','akun_rekening')->orderBy('akun_rekening_id')->groupBy('akun_rekening_id')->get()->groupBy('akun_rekening_id');
                $data[$unit->id][$row->id]['kegiatan'] = LogUsulan::Select('akun_rekening_id','kegiatan',DB::raw("sum(jumlah*harga) as total"))->where('usulan_id',$row->id)->where('status',1)->with('barang','akun_rekening')->orderBy('akun_rekening_id')->groupBy('akun_rekening_id')->groupby('kegiatan')->get();
                $data[$unit->id][$row->id]['barang'] = LogUsulan::where('usulan_id',$row->id)->where('status',1)->with('barang','akun_rekening')->orderBy('akun_rekening_id')->get();
            }
        }
        $return['unit'] = $units;
        $return['tahun'] = $tahun;
        $return['data'] = $data;
        return $return;

    }
}
