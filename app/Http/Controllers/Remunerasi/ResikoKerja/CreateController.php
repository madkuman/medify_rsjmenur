<?php

namespace App\Http\Controllers\Remunerasi\ResikoKerja;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\Pegawai;
use App\Models\Kepegawaian\MasterResikoKerja;
use App\Models\Remunerasi\ResikoKerja;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Auth;
use DB;
use Bugsnag;


class CreateController extends Controller
{
    public function create($request){
        $countExecuteData = 0;
        $bulan = substr($request->bulan_tahun,3);
        $data = Pegawai::where('status_pegawai_id', 1)->with('masterResikoKerja')->get(); // init data pegawai then insert to resiko_kerja
        $resiko_kerja = [];
        foreach($data as $pegawai){
                //check duplicate data pegawai & bulan ;
                $check = ResikoKerja::where('pegawai_id',$pegawai->id)->where('bulan',$bulan)->first();
                if(empty($check)){
                    $new_resiko_kerja = array(
                        'pegawai_id' => $pegawai->id,
                        'index' => !empty($pegawai->masterResikoKerja->index) ? $pegawai->masterResikoKerja->index : 0,
                        'bulan' => $bulan,
                        'created_by' => Auth::user()->id,
                        'created_at' => Carbon::now()->toDateTimeString(),
                        'updated_at' => Carbon::now()->toDateTimeString(),
                    );
                    $resiko_kerja [] = $new_resiko_kerja;
                    $countExecuteData++;
                }
            }
        if(!empty($resiko_kerja))
        {
            ResikoKerja::insert($resiko_kerja);
        }
        return $countExecuteData;    
    }
}