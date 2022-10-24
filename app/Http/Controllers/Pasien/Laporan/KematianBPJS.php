<?php

namespace App\Http\Controllers\Pasien\Laporan;

use App\Models\Hospital\MasterStatusPulang;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Pasien\Pasien;
use Carbon\Carbon;

class KematianBPJS extends Controller
{
    public function get($start, $end)
	{
        $meninggal = MasterStatusPulang::where('slug','meninggal')->first()->id;
		$kasus = Kasus::whereBetween('krs_at',array($start,$end))->where('krs_status',$meninggal)->orderBy('krs_at','asc')->with(['pasien', 'pembayaran.perusahaan'])->get();
		$kasus = $kasus->filter(function($item) {
                    return $item->pembayaran->perusahaan['type'] == 1;
                });
		return $kasus;
		
	}
}
