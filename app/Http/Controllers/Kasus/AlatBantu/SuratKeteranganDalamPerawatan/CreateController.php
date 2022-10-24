<?php

namespace App\Http\Controllers\Kasus\AlatBantu\SuratKeteranganDalamPerawatan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\SuratKeteranganDalamPerawatan;
use DB;
use Auth;
use Carbon\Carbon;

class CreateController extends Controller
{
    public function create($req, $kasus_id){
    	$surat_keterangan_dalam_perawatan = new SuratKeteranganDalamPerawatan;
    	
        $surat_keterangan_dalam_perawatan->no_bpjs = $req->no_bpjs;
        $surat_keterangan_dalam_perawatan->no_sep = $req->no_sep;

        foreach ($req->terapi as $key => $value) {
            $terapi[] = $req->terapi[$key];
        }
        $surat_keterangan_dalam_perawatan->terapi = json_encode($terapi);
        
        if(!empty($req->tanggal_surat_rujukan)){        
            $surat_keterangan_dalam_perawatan->tanggal_surat_rujukan = Carbon::createFromFormat("d/m/Y", $req->tanggal_surat_rujukan);
        } else {
            $surat_keterangan_dalam_perawatan->tanggal_surat_rujukan = null;
        }
        $surat_keterangan_dalam_perawatan->no_rujukan = $req->no_rujukan;

        foreach ($req->alasan as $key => $value) {
            $alasan[] = $req->alasan[$key];
        }
        $surat_keterangan_dalam_perawatan->alasan = json_encode($alasan);

        foreach ($req->rencana_kunjungan as $key => $value) {
            $rencana_kunjungan[] = $req->rencana_kunjungan[$key];
        }
        $surat_keterangan_dalam_perawatan->rencana_kunjungan = json_encode($rencana_kunjungan);

        if(!empty($req->tanggal_surat_keterangan)){        
            $surat_keterangan_dalam_perawatan->tanggal_surat_keterangan = Carbon::createFromFormat("d/m/Y", $req->tanggal_surat_keterangan);
        } else {
            $surat_keterangan_dalam_perawatan->tanggal_surat_keterangan = null;
        }

        $surat_keterangan_dalam_perawatan->no_antrian = $req->no_antrian;
    	$surat_keterangan_dalam_perawatan->created_by = Auth::user()->id;
    	$surat_keterangan_dalam_perawatan->kasus_id = $kasus_id;
    	$surat_keterangan_dalam_perawatan->save();
    }
}