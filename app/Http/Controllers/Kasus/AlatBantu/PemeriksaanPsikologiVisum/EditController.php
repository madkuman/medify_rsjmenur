<?php

namespace App\Http\Controllers\Kasus\AlatBantu\PemeriksaanPsikologiVisum;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\PemeriksaanPsikologiVisum;
use DB;
use Auth;
use Carbon\Carbon;

class EditController extends Controller
{
    public function edit(Request $req){
    	$pemeriksaan_psikologi_visum = PemeriksaanPsikologiVisum::find($req->id);
    	
        $pemeriksaan_psikologi_visum->tujuan_pemeriksaan = $req->tujuan_pemeriksaan;
        if(!empty($req->tanggal_pemeriksaan)){        
            $pemeriksaan_psikologi_visum->tanggal_pemeriksaan = Carbon::createFromFormat("d/m/Y", $req->tanggal_pemeriksaan);
        } else {
            $pemeriksaan_psikologi_visum->tanggal_pemeriksaan = null;
        }
        $pemeriksaan_psikologi_visum->hasil = $req->hasil;
        $pemeriksaan_psikologi_visum->updated_by = Auth::user()->id;
    	$pemeriksaan_psikologi_visum->save();
    	return $pemeriksaan_psikologi_visum;
    }
}