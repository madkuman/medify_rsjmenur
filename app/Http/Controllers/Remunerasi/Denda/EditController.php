<?php

namespace App\Http\Controllers\Remunerasi\Denda;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Remunerasi\Absensi;
use App\Models\Remunerasi\Denda;
use Carbon\Carbon;
use Carbon\CarbonPeriod;


class EditController extends Controller
{
    function update($request){
        $countExecuteData = 0;
      
        $denda = Denda::find($request->id);
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
        $denda->save();
        $countExecuteData++;
           
        //sync data to absensi
        $bulan =  Carbon::createFromFormat('d-m-Y', '01-'.$denda->tanggal)->format('m');
        $tahun =  Carbon::createFromFormat('d-m-Y', '01-'.$denda->tanggal)->format('Y');
        $absen = Absensi::whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun)->get();
            if (!empty($absen)){
                foreach($absen as $row){
                    $absen = Absensi::where('id', $row->id)->first();
                    $absen->denda_id = $request->id;
                    $absen->save();
                }
            }
        return $countExecuteData;    
    }
}