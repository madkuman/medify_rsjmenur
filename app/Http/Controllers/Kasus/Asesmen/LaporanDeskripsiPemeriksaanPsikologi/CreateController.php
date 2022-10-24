<?php

namespace App\Http\Controllers\Kasus\Asesmen\LaporanDeskripsiPemeriksaanPsikologi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\LaporanDeskripsiPemeriksaanPsikologi;
use DB;
use Auth;
use Carbon\Carbon;

class CreateController extends Controller
{
    public function create($req, $kasus_id){
    	$laporan_deskripsi_pemeriksaan_psikologi = new LaporanDeskripsiPemeriksaanPsikologi;
    	
        $laporan_deskripsi_pemeriksaan_psikologi->tujuan_pemeriksaan = $req->tujuan_pemeriksaan;
        if(!empty($req->tanggal_pemeriksaan)){        
            $laporan_deskripsi_pemeriksaan_psikologi->tanggal_pemeriksaan = Carbon::createFromFormat("d/m/Y", $req->tanggal_pemeriksaan);
        } else {
            $laporan_deskripsi_pemeriksaan_psikologi->tanggal_pemeriksaan = null;
        }
        $laporan_deskripsi_pemeriksaan_psikologi->rujukan_dari = $req->rujukan_dari;
        $laporan_deskripsi_pemeriksaan_psikologi->hasil = $req->hasil;
    	$laporan_deskripsi_pemeriksaan_psikologi->created_by = Auth::user()->id;
    	$laporan_deskripsi_pemeriksaan_psikologi->kasus_id = $kasus_id;
    	$laporan_deskripsi_pemeriksaan_psikologi->save();
    	return $laporan_deskripsi_pemeriksaan_psikologi;
    }
}