<?php

namespace App\Http\Controllers\Kasus\AlatBantu\InstrumenActivityDailyLiving;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\InstrumenActivityDailyLiving;
use DB;
use Auth;
use Carbon\Carbon;

class CreateController extends Controller
{
    public function create($req, $kasus_id){
    	$instrumen_activity_daily_living = new InstrumenActivityDailyLiving;
        
        $total_skor = 0;
        foreach ($req->skor as $key => $value) {
            if (!is_null($value)) {
                $total_skor += $value;
            }
        }
    	
        if(!empty($req->tanggal)){        
            $instrumen_activity_daily_living->tanggal = Carbon::createFromFormat("d/m/Y", $req->tanggal);
        } else {
            $instrumen_activity_daily_living->tanggal = null;
        }

        $instrumen_activity_daily_living->mengendalikan_rangsang_pembuangan_tinja = $req->mengendalikan_rangsang_pembuangan_tinja;
        $instrumen_activity_daily_living->mengendalikan_rangsang_berkemih = $req->mengendalikan_rangsang_berkemih;
        $instrumen_activity_daily_living->membersihkan_diri = $req->membersihkan_diri;
        $instrumen_activity_daily_living->penggunaan_jamban = $req->penggunaan_jamban;
        $instrumen_activity_daily_living->makan = $req->makan;
        $instrumen_activity_daily_living->berubah_sikap = $req->berubah_sikap;
        $instrumen_activity_daily_living->berpindah_atau_berjalan = $req->berpindah_atau_berjalan;
        $instrumen_activity_daily_living->memakai_baju = $req->memakai_baju;
        $instrumen_activity_daily_living->naik_turun_tangga = $req->naik_turun_tangga;
        $instrumen_activity_daily_living->mandi = $req->mandi;
        $instrumen_activity_daily_living->total_skor = $total_skor;

    	$instrumen_activity_daily_living->created_by = Auth::user()->id;
    	$instrumen_activity_daily_living->kasus_id = $kasus_id;
    	$instrumen_activity_daily_living->save();
    }
}