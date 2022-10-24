<?php

namespace App\Http\Controllers\Kasus\Asesmen\EvaluasiPerencanaanPemulanganPasien;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\EvaluasiPerencanaanPemulanganPasien;
use DB;
use Auth;
use Carbon\Carbon;

class EditController extends Controller
{
    public function edit(Request $req){
    	$evaluasi_perencanaan_pemulangan_pasien = EvaluasiPerencanaanPemulanganPasien::find($req->id);
    	        
        if(!empty($req->tanggal)){        
            $evaluasi_perencanaan_pemulangan_pasien->tanggal = Carbon::createFromFormat("d/m/Y", $req->tanggal);
        }
		$evaluasi_perencanaan_pemulangan_pasien->jam = $req->jam;
		$evaluasi_perencanaan_pemulangan_pasien->implementasi_p3 = $req->implementasi_p3;
		$evaluasi_perencanaan_pemulangan_pasien->evaluasi = $req->evaluasi;
		$evaluasi_perencanaan_pemulangan_pasien->materi = $req->materi;
        $evaluasi_perencanaan_pemulangan_pasien->updated_by = Auth::user()->id;
    	$evaluasi_perencanaan_pemulangan_pasien->save();
    }
}