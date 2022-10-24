<?php

namespace App\Http\Controllers\Kasus\Asesmen\SuratNasehatPulang;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\SuratNasehatPulang;
use DB;
use Auth;
use Carbon\Carbon;

class EditController extends Controller
{
    public function edit(Request $req){
    	$surat_nasehat_pulang = SuratNasehatPulang::find($req->id);
    	
        if(!empty($req->tanggal_kontrol)){        
            $surat_nasehat_pulang->tanggal_kontrol = Carbon::createFromFormat("d/m/Y", $req->tanggal_kontrol);
        } else {
            $surat_nasehat_pulang->tanggal_kontrol = null;
        }
        $surat_nasehat_pulang->obat_yang_diminum = $req->obat_yang_diminum;
        $surat_nasehat_pulang->obat_yang_tidak_diminum = $req->obat_yang_tidak_diminum;
        $surat_nasehat_pulang->keterangan_lain_lain = $req->keterangan_lain_lain;
        $surat_nasehat_pulang->saran = $req->saran;
        $surat_nasehat_pulang->updated_by = Auth::user()->id;
    	$surat_nasehat_pulang->save();
    }
}