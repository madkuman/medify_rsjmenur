<?php

namespace App\Http\Controllers\Remunerasi\Absensi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Remunerasi\Absensi;
use App\Models\Remunerasi\Denda;
use Carbon\Carbon;
use Carbon\CarbonPeriod;


class CreateController extends Controller
{

    public function create(Request $request) {
       
        $countExecuteData = 0;
        $tanggal =  Carbon::createFromFormat('d-m-Y', $request->bulan_tahun)->format('Y-m-d');
        $bulan = Carbon::parse($request->bulan_tahun)->format('m');
        $tahun = Carbon::parse($request->bulan_tahun)->format('Y');

        $pegawai_id     = $request->pegawai; 
        $absen_ket      = $request->absen_ket;
        $absen          = $request->absen;
        $telat_satu     = $request->telat_satu;
        $telat_dua      = $request->telat_dua;
        $telat_tiga     = $request->telat_tiga;
        $telat_empat    = $request->telat_empat;
        $pulang_satu    = $request->pulang_satu;
        $pulang_dua     = $request->pulang_dua;
        $pulang_tiga    = $request->pulang_tiga;
        $pulang_empat   = $request->pulang_empat;
        $telat_senam    = $request->telat_senam;
        $tidak_senam    = $request->tidak_senam;
        $lupa_absen_masuk  = $request->lupa_absen_masuk;
        $lupa_absen_pulang = $request->lupa_absen_pulang;

        //get denda_id  based bulan tahun
        $tgl_denda = substr($request->bulan_tahun,3);
        $denda = Denda::where('tanggal',$tgl_denda)->first();

        if($request->id == null or $request->id == 0){
            // Create data
            $absensi = Absensi::where('pegawai_id', $pegawai_id)->whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun)->first(); 
            if(empty($absensi)){
                $absensi = new Absensi();
                    
                    $absensi->pegawai_id    = $pegawai_id;
                    $absensi->tanggal       = $tanggal;
                    $absensi->denda_id      = !empty($denda) ? $denda->id : NULL ;
                    $absensi->absen_ket     = $absen_ket;
                    $absensi->absen         = $absen;
                    $absensi->telat_satu    = $telat_satu;
                    $absensi->telat_dua     = $telat_dua;
                    $absensi->telat_tiga    = $telat_tiga;
                    $absensi->telat_empat   = $telat_empat;
                    $absensi->pulang_satu   = $pulang_satu;
                    $absensi->pulang_dua    = $pulang_dua;
                    $absensi->pulang_tiga   = $pulang_tiga;
                    $absensi->pulang_empat  = $pulang_empat;
                    $absensi->telat_senam   = $telat_senam;
                    $absensi->tidak_senam   = $tidak_senam;
                    $absensi->lupa_absen_masuk  = $lupa_absen_masuk;
                    $absensi->lupa_absen_pulang = $lupa_absen_pulang;
                $absensi->save();
                $countExecuteData++;
            }

        }else{
            // Update data
            $absensi = Absensi::find($request->id);
            
                $absensi->denda_id      = !empty($denda) ? $denda->id : NULL ;
                $absensi->absen_ket     = $absen_ket;
                $absensi->absen         = $absen;
                $absensi->telat_satu    = $telat_satu;
                $absensi->telat_dua     = $telat_dua;
                $absensi->telat_tiga    = $telat_tiga;
                $absensi->telat_empat   = $telat_empat;
                $absensi->pulang_satu   = $pulang_satu;
                $absensi->pulang_dua    = $pulang_dua;
                $absensi->pulang_tiga   = $pulang_tiga;
                $absensi->pulang_empat  = $pulang_empat;
                $absensi->telat_senam   = $telat_senam;
                $absensi->tidak_senam   = $tidak_senam;
                $absensi->lupa_absen_masuk  = $lupa_absen_masuk;
                $absensi->lupa_absen_pulang = $lupa_absen_pulang;
            $absensi->save();
            $countExecuteData++;

        }
        
        if($countExecuteData > 0){
            return json_encode([
                'number'=>200,
                'status'=>'Berhasil',
                'ket'=>'Berhasil menyimpan data'
            ]);
        } else {
            return json_encode([
                'number'=>400,
                'status'=>'Gagal',
                'ket'=>'Gagal, data pada periode yang dipilih sudah ada '
            ]);
        }
    }

}