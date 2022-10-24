<?php

namespace App\Http\Controllers\Pasien\LaporanV2\Index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hospital\MasterLaporan;

class ViewController extends Controller
{
    public function laporanIndex()
    {
    	$data['laporan'] = MasterLaporan::whereIn('departemen_id',[1,2,3,4,5,6,8,10,11,14])->orderBy('nama')->with('departemen')->get();

    	return view('pasien.laporanv2.index.index',$data);
    }
}
