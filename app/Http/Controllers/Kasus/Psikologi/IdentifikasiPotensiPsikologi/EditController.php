<?php

namespace App\Http\Controllers\Kasus\Psikologi\IdentifikasiPotensiPsikologi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\IdentifikasiPotensiPsikologi;
use Carbon\Carbon;
use DB;
use Auth;

class EditController extends Controller
{
    public function edit($req){
        $identifikasi_potensi_psikologi = IdentifikasiPotensiPsikologi::find($req->id);
        
        if(!empty($req->tanggal_pemeriksaan)){        
            $identifikasi_potensi_psikologi->tanggal_pemeriksaan = Carbon::createFromFormat("d/m/Y", $req->tanggal_pemeriksaan);
        } else {
            $identifikasi_potensi_psikologi->tanggal_pemeriksaan = null;
        }

        $identifikasi_potensi_psikologi->rujukan = $req->rujukan;
        $identifikasi_potensi_psikologi->tujuan_pemeriksaan = $req->tujuan_pemeriksaan;
        $identifikasi_potensi_psikologi->dokter_pemeriksa = $req->dokter_pemeriksa;
        $identifikasi_potensi_psikologi->hasil = $req->hasil;

        $identifikasi_potensi_psikologi->updated_by = Auth::user()->id;
        $identifikasi_potensi_psikologi->updated_at = date('Y-m-d H:i:s');
        $identifikasi_potensi_psikologi->save();
        return $identifikasi_potensi_psikologi;
    }
}