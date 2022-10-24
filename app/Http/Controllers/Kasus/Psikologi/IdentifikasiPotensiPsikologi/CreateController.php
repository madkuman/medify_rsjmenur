<?php

namespace App\Http\Controllers\Kasus\Psikologi\IdentifikasiPotensiPsikologi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\IdentifikasiPotensiPsikologi;
use Carbon\Carbon;
use DB;
use Auth;

class CreateController extends Controller
{
    public function create($req, $kasus_id){
    	$identifikasi_potensi_psikologi = new IdentifikasiPotensiPsikologi;
    	
        if(!empty($req->tanggal_pemeriksaan)){        
            $identifikasi_potensi_psikologi->tanggal_pemeriksaan = Carbon::createFromFormat("d/m/Y", $req->tanggal_pemeriksaan);
        } else {
            $identifikasi_potensi_psikologi->tanggal_pemeriksaan = null;
        }

        $identifikasi_potensi_psikologi->rujukan = $req->rujukan;
        $identifikasi_potensi_psikologi->tujuan_pemeriksaan = $req->tujuan_pemeriksaan;
        $identifikasi_potensi_psikologi->dokter_pemeriksa = $req->dokter_pemeriksa;
        $identifikasi_potensi_psikologi->hasil = $req->hasil;

    	$identifikasi_potensi_psikologi->created_by = Auth::user()->id;
    	$identifikasi_potensi_psikologi->kasus_id = $kasus_id;
    	$identifikasi_potensi_psikologi->save();
    	return $identifikasi_potensi_psikologi;
    }
}