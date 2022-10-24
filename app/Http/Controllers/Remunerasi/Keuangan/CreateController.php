<?php

namespace App\Http\Controllers\Remunerasi\Keuangan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Remunerasi\Keuangan;
use Carbon\Carbon;
use Carbon\CarbonPeriod;


class CreateController extends Controller{
    
    public function create(Request $request){

        $countExecuteData = 0;
        $tanggal =  Carbon::createFromFormat('d-m-Y', $request->bulan_tahun)->format('Y-m-d');
        $bulan = Carbon::parse($request->bulan_tahun)->format('m');
        $tahun = Carbon::parse($request->bulan_tahun)->format('Y');

        $pegawai_id         = $request->pegawai;
        $jp_dasar           = preg_replace("/[^0-9]/", "", $request->jp_dasar);
        $visite_tetap       = preg_replace("/[^0-9]/", "", $request->visite_tetap);
        $visite_anggrek     = preg_replace("/[^0-9]/", "", $request->visite_anggrek);
        $jasa_pendidikan    = preg_replace("/[^0-9]/", "", $request->jasa_pendidikan);
        $tindakan_dokter    = preg_replace("/[^0-9]/", "", $request->tindakan_dokter);
        $konsul_dokter      = preg_replace("/[^0-9]/", "", $request->konsul_dokter);
        $poli_tumbang       = preg_replace("/[^0-9]/", "", $request->poli_tumbang);
        $aps_ect            = preg_replace("/[^0-9]/", "", $request->aps_ect);
        $patologi_klinik    = preg_replace("/[^0-9]/", "", $request->patologi_klinik);
        $ipwl               = preg_replace("/[^0-9]/", "", $request->ipwl);

        if($request->id == null or $request->id == 0){
             // Create data
            $keuangan = Keuangan::where('pegawai_id', $pegawai_id)->whereMonth('tanggal', $bulan)->whereYear('tanggal', $tahun)->first();
                if(empty($keuangan)){
                    $keuangan = new Keuangan();
                        $keuangan->pegawai_id       = $pegawai_id;
                        $keuangan->jp_dasar         = $jp_dasar != "" ? $jp_dasar : NULL ;
                        $keuangan->visite_tetap     = $visite_tetap != "" ? $visite_tetap : NULL ;
                        $keuangan->visite_anggrek   = $visite_anggrek != "" ? $visite_anggrek : NULL;
                        $keuangan->jasa_pendidikan  = $jasa_pendidikan != "" ? $jasa_pendidikan : NULL;
                        $keuangan->tindakan_dokter  = $tindakan_dokter != "" ? $tindakan_dokter : NULL;
                        $keuangan->konsul_dokter    = $konsul_dokter != "" ? $konsul_dokter : NULL;
                        $keuangan->poli_tumbang     = $poli_tumbang != "" ? $poli_tumbang : NULL;
                        $keuangan->aps_ect          = $aps_ect != "" ? $aps_ect : NULL;
                        $keuangan->patologi_klinik  = $patologi_klinik != "" ? $patologi_klinik : NULL;
                        $keuangan->ipwl             = $ipwl != "" ? $ipwl : NULL;
                        $keuangan->tanggal          = $tanggal;
                    $keuangan->save();
                    $countExecuteData++;
                }

        }else{
            // Update data
            $keuangan = Keuangan::find($request->id);
                $keuangan->jp_dasar         = $jp_dasar != "" ? $jp_dasar : NULL ;
                $keuangan->visite_tetap     = $visite_tetap != "" ? $visite_tetap : NULL ;
                $keuangan->visite_anggrek   = $visite_anggrek != "" ? $visite_anggrek : NULL;
                $keuangan->jasa_pendidikan  = $jasa_pendidikan != "" ? $jasa_pendidikan : NULL;
                $keuangan->tindakan_dokter  = $tindakan_dokter != "" ? $tindakan_dokter : NULL;
                $keuangan->konsul_dokter    = $konsul_dokter != "" ? $konsul_dokter : NULL;
                $keuangan->poli_tumbang     = $poli_tumbang != "" ? $poli_tumbang : NULL;
                $keuangan->aps_ect          = $aps_ect != "" ? $aps_ect : NULL;
                $keuangan->patologi_klinik  = $patologi_klinik != "" ? $patologi_klinik : NULL;
                $keuangan->ipwl             = $ipwl != "" ? $ipwl : NULL;
            $keuangan->save();
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