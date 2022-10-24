<?php

namespace App\Http\Controllers\Eusulan\Laporan\LaporanController;

use App\Models\Eusulan\LogUsulan;
use App\Models\Eusulan\Usulan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class LaporanUsulanRekapController extends Controller
{
    public function get($tahun)
    {
        $usulan_ids = Usulan::where('tahun',$tahun)->get()->pluck('id')->toArray();
        $log_usulan = LogUsulan::whereIn('usulan_id',$usulan_ids)->where('status',1)->with('barang','usulan.unit')->get()->groupBy(['akun_rekening_id','barang_id']);
        $akun_rekening = LogUsulan::Select('akun_rekening_id',DB::raw("sum(jumlah*harga) as total"))->whereIn('usulan_id',$usulan_ids)->where('status',1)->with('barang','akun_rekening')->orderBy('akun_rekening_id')->groupBy('akun_rekening_id')->get()->groupBy('akun_rekening_id');
        $return['tahun'] = $tahun;
        $return['log_usulan'] = $log_usulan;
        $return['akun_rekening'] = $akun_rekening;
        return $return;

    }
}
