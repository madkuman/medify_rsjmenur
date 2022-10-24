<?php

namespace App\Http\Controllers\Kasus\AlatBantu\PemeriksaanPsikologiVisum;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\PemeriksaanPsikologiVisum;
use DB;
use Auth;
use Carbon\Carbon;

class CreateController extends Controller
{
    public function create($req, $kasus_id){
    	$pemeriksaan_psikologi_visum = new PemeriksaanPsikologiVisum;
    	
        $pemeriksaan_psikologi_visum->tujuan_pemeriksaan = $req->tujuan_pemeriksaan;
        if(!empty($req->tanggal_pemeriksaan)){        
            $pemeriksaan_psikologi_visum->tanggal_pemeriksaan = Carbon::createFromFormat("d/m/Y", $req->tanggal_pemeriksaan);
        } else {
            $pemeriksaan_psikologi_visum->tanggal_pemeriksaan = null;
        }
        $pemeriksaan_psikologi_visum->hasil = $req->hasil;
    	$pemeriksaan_psikologi_visum->created_by = Auth::user()->id;
    	$pemeriksaan_psikologi_visum->kasus_id = $kasus_id;
    	$pemeriksaan_psikologi_visum->save();
    	return $pemeriksaan_psikologi_visum;
    }
}