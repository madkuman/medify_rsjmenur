<?php

namespace App\Http\Controllers\Remunerasi\Denda;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Remunerasi\Absensi;
use App\Models\Remunerasi\Denda;
use Carbon\Carbon;
use Carbon\CarbonPeriod;


class CreateController extends Controller
{
    function create($request){
        $countExecuteData = 0;
        $tgl = substr($request->bulan_tahun,3);
        //check duplicate data by bulan ;
        $check = Denda::where('tanggal',$tgl)->first();
            if(empty($check)){
                $denda = new Denda;
                    $denda->id          = $this->getCurrentLastID();
                    $denda->absen_ket   = preg_replace("/[^0-9]/", "", !empty($request->absen_ket) ? $request->absen_ket : 0);
                    $denda->absen       = preg_replace("/[^0-9]/", "", !empty($request->absen) ? $request->absen : 0) ;
                    $denda->lupa_absen_masuk  = preg_replace("/[^0-9]/", "", !empty($request->lupa_absen_masuk) ? $request->lupa_absen_masuk : 0);
                    $denda->lupa_absen_pulang = preg_replace("/[^0-9]/", "", !empty($request->lupa_absen_pulang) ? $request->lupa_absen_pulang : 0);
                    $denda->telat_satu  = preg_replace("/[^0-9]/", "", !empty($request->telat_satu) ? $request->telat_satu : 0);
                    $denda->telat_dua   = preg_replace("/[^0-9]/", "", !empty($request->telat_dua) ? $request->telat_dua : 0);
                    $denda->telat_tiga  = preg_replace("/[^0-9]/", "", !empty($request->telat_tiga) ? $request->telat_tiga : 0);
                    $denda->telat_empat = preg_replace("/[^0-9]/", "", !empty($request->telat_empat) ? $request->telat_empat : 0);
                    $denda->pulang_satu = preg_replace("/[^0-9]/", "", !empty($request->pulang_satu) ? $request->pulang_satu : 0);
                    $denda->pulang_dua  = preg_replace("/[^0-9]/", "", !empty($request->pulang_dua) ? $request->pulang_dua : 0);
                    $denda->pulang_tiga = preg_replace("/[^0-9]/", "", !empty($request->pulang_tiga) ? $request->pulang_tiga : 0);
                    $denda->pulang_empat = preg_replace("/[^0-9]/", "", !empty($request->pulang_empat) ?  $request->pulang_empat : 0);
                    $denda->tidak_senam = preg_replace("/[^0-9]/", "", !empty($request->tidak_senam) ? $request->tidak_senam : 0);
                    $denda->telat_senam = preg_replace("/[^0-9]/", "", !empty($request->telat_senam) ? $request->telat_senam : 0);
                    $denda->tanggal = $tgl;
                $denda->save();
                $countExecuteData++;
            }

            //sync data to absensi
            $bulan =  Carbon::createFromFormat('d-m-Y', $request->bulan_tahun)->format('m');
            $tahun =  Carbon::createFromFormat('d-m-Y', $request->bulan_tahun)->format('Y');
            $absen = Absensi::whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun)->get();
                if (!empty($absen)){
                    foreach($absen as $row){
                        $absen = Absensi::where('id', $row->id)->first();
                        $absen->denda_id = $this->getCurrentLastID() - 1 ;
                        $absen->save();
                    }
                }
        return $countExecuteData;     
    }

    private function getCurrentLastID()
    {
        // CHECK LAST ID
        $lastID = Denda::select('id')->latest()->first();
            if ($lastID != null){
                $currentID = $lastID->id + 1;
            }else{
                $currentID = 1;
            }
        return $currentID;
    }
}