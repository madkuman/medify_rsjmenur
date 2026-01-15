<?php

namespace App\Http\Controllers\Kasus\Asesmen\SkoringPanssEc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\SkoringPanssEc;
use DB;
use Auth;
use Carbon\Carbon;

class CreateController extends Controller
{
    public function create($req, $kasus_id){
    	$skoring_panss_ec = new SkoringPanssEc;
    	
        if(!empty($req->tanggal_pelaksanaan_skoring)){        
            $skoring_panss_ec->tanggal_pelaksanaan_skoring = Carbon::createFromFormat("d/m/Y", $req->tanggal_pelaksanaan_skoring);
        } else {
            $skoring_panss_ec->tanggal_pelaksanaan_skoring = null;
        }
        $skoring_panss_ec->jam_pelaksanaan_skoring = $req->jam_pelaksanaan_skoring;
        $skoring_panss_ec->tempat_pelaksanaan_skoring = $req->tempat_pelaksanaan_skoring;
        $skoring_panss_ec->gaduh_gelisah = $req->gaduh_gelisah;
        $skoring_panss_ec->permusuhan = $req->permusuhan;
        $skoring_panss_ec->ketegangan = $req->ketegangan;
        $skoring_panss_ec->ketidak_kooperatifan = $req->ketidak_kooperatifan;
        $skoring_panss_ec->pengendalian_impuls_yang_buruk = $req->pengendalian_impuls_yang_buruk;
        
        $skoring_panss_ec->total = 
        $skoring_panss_ec->gaduh_gelisah +
        $skoring_panss_ec->permusuhan +
        $skoring_panss_ec->ketegangan +
        $skoring_panss_ec->ketidak_kooperatifan +
        $skoring_panss_ec->pengendalian_impuls_yang_buruk;

        $skoring_panss_ec->created_by = Auth::user()->id;
        $skoring_panss_ec->kasus_id = $kasus_id;
        $skoring_panss_ec->save();
    }
}