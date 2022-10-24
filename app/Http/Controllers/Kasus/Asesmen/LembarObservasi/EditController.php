<?php

namespace App\Http\Controllers\Kasus\Asesmen\LembarObservasi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\LembarObservasi;
use DB;
use Auth;
use Carbon\Carbon;

class EditController extends Controller
{
    public function edit(Request $req){
    	$lembar_observasi = LembarObservasi::find($req->id);
    	
        if(!empty($req->tanggal)){        
            $lembar_observasi->tanggal = Carbon::createFromFormat("d/m/Y", $req->tanggal);
        } else {
            $lembar_observasi->tanggal = null;
        }
        $lembar_observasi->jam = $req->jam;
        $lembar_observasi->tensi = $req->tensi;
        $lembar_observasi->nadi = $req->nadi;
        $lembar_observasi->suhu = $req->suhu;
        $lembar_observasi->rr = $req->rr;
        $lembar_observasi->infus = $req->infus;
        $lembar_observasi->per_os = $req->per_os;
        $lembar_observasi->urine = $req->urine;
        $lembar_observasi->cairan_lain_lain = $req->cairan_lain_lain;
        $lembar_observasi->rencana_tindakan = $req->rencana_tindakan;
        $lembar_observasi->updated_by = Auth::user()->id;
    	$lembar_observasi->save();
    }
}