<?php

namespace App\Http\Controllers\Pasien\Laporan;

use App\Models\Hospital\MasterStatusPulang;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Diagnosis;
use App\Models\Kasus\Kasus;

class IndeksKematianController extends Controller
{
	public function get($start,$end,$layanan)
	{
        $meninggal = MasterStatusPulang::where('slug','meninggal')->first()->id;
        if($layanan == 'all'){
            $kasus = Kasus::whereBetween('created_at',array($start,$end))->where('krs_status',$meninggal)->where('tipe_mc','0')->with('lokasi.lokasi')->get();
        }
        elseif($layanan == 'ri'){
            $kasus = Kasus::whereBetween('created_at',array($start,$end))->where('krs_status',$meninggal)->where('tipe_mc','0')->where('tipe_ri',1)->with('lokasi.lokasi')->get();
        }
        elseif($layanan == 'igd'){
            $kasus = Kasus::whereBetween('created_at',array($start,$end))->where('krs_status',$meninggal)->where('tipe_mc','0')->where('tipe_igd',1)->with('lokasi.lokasi')->get();
        }
        elseif($layanan == 'rj'){
            $kasus = Kasus::whereBetween('created_at',array($start,$end))->where('krs_status',$meninggal)->where('tipe_mc','0')->where('tipe_rj',1)->with('lokasi.lokasi')->get();
        }
        
        return $kasus;
    }
}
