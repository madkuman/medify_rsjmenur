<?php

namespace App\Http\Controllers\Remunerasi\BebanKerja;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\Pegawai;
use App\Models\Kepegawaian\MasterBebanKerja;
use App\Models\Remunerasi\BebanKerja;
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
        $data = Pegawai::where('status_pegawai_id', 1)->with('masterBebanKerja')->get(); // init data pegawai then insert to beban_kerja
        $beban_kerja = [];
        foreach($data as $pegawai){
                //check duplicate data pegawai & bulan ;
                $check = BebanKerja::where('pegawai_id',$pegawai->id)->where('bulan',$bulan)->first();
                if(empty($check)){
                    $new_beban_kerja = array(
                        'pegawai_id' => $pegawai->id,
                        'index' => !empty($pegawai->masterBebanKerja->index) ? $pegawai->masterBebanKerja->index : 0,
                        'bulan' => $bulan,
                        'created_by' => Auth::user()->id,
                        'created_at' => Carbon::now()->toDateTimeString(),
                        'updated_at' => Carbon::now()->toDateTimeString(),
                    );
                    $beban_kerja [] = $new_beban_kerja;
                    $countExecuteData++;
                }
            }

        if(!empty($beban_kerja))
        {
            BebanKerja::insert($beban_kerja);
        }

        return $countExecuteData;    
    }
}