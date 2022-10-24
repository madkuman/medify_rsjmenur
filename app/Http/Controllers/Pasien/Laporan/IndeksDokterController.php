<?php

namespace App\Http\Controllers\Pasien\Laporan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Models\Kasus\Kasus;

class IndeksDokterController extends Controller
{
    	public function get($start,$end)
    	{
    		$dokter = User::where('profesi',1)->get();
            foreach($dokter as $user)
            {
                $kasus = Kasus::whereBetween('created_at',array($start,$end))->whereHas('kolaborator', function($q) use ($user){
                    $q->where('user_id',$user->id);
                })->where('tipe_mc','0')->with('lokasi.lokasi','diagnosis.icd10','tindakan_icd9.icd9','kelas','pasien','identitas')->get();

                $user->kasus = $kasus;
            }   
    		

    		return $dokter;
    	}
}
