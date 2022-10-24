<?php

namespace App\Http\Controllers\Kasus\Asesmen\RingkasanPasienMasukDanKeluar;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Identitas;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\RingkasanPasienMasukDanKeluar;
use DOMPDF;

define("relasi", ["lokasi.lokasi.departemen", "identitas", 
    "pembayaran.perusahaan.tipe", "pasien", "kelas", "end_by_creator", 
    "TransaksiRawatInap", "myInvitation"]);

class ViewController extends Controller
{
	function index(Request $request, $nomor_kasus){
		$kasus = Kasus::with(relasi)->where("nomor_kasus",$nomor_kasus)->first();
        $identitas = Identitas::where('kasus_id', $kasus->id)->first();
        $data["identitas"] = $identitas;
        $data["kasus"] = $kasus;
        $data['dirawat_ke'] = Kasus::where('pasien_id',$kasus->pasien->id)->pluck('id')->toArray();
        $ringkasan_pasien_masuk_dan_keluar = RingkasanPasienMasukDanKeluar::with(["creator"])->where("kasus_id",$kasus->id)
        ->orderBy("id","desc")->get();

        $diagnosaAll = "";
        $i= 1;
        if(count($kasus->diagnosisTambahan) > 0){
            foreach($kasus->diagnosisTambahan as $tambahan){
                $diagnosaAll.= $i++.'. ('.$tambahan->icd10->code_icd.') - '.$tambahan->icd10->long_desc.'<br>';
            }
        }
        $data["diagnosaAll"] = $diagnosaAll;

        $tindakanAll = "";
        $i= 1; 
        if(count($kasus->tindakan_icd9) > 0){
            foreach($kasus->tindakan_icd9 as $tindakan){
                $tindakanAll.= $i++.'. ('.$tindakan->icd9->code_icd.') - '.$tindakan->icd9->long_desc.'<br>';
            }
        }

        $visum = 0;
        $tindakan_kolab = app('App\Http\Controllers\Kasus\Tindakan\ReadController')->fetchKasusTindakan($kasus->id, 0);
        if(count($tindakan_kolab) > 0){
            foreach($tindakan_kolab as $kolab){
                if($kolab->tarif_master){
                    if($kolab->tarif_master->kategori->nama == 'Visum'){
                        $visum = 1;
                    }
                }
            }
        }

        $data["tindakanAll"] = $tindakanAll;
        $data["visum"] = $visum;
        $data["ringkasan_pasien_masuk_dan_keluar"] = $ringkasan_pasien_masuk_dan_keluar;
        $data["sidebar_active"] = "resume";
        $data['active_nav'] = 'ringkasan_masuk_keluar';

        return view("kasus.resume.index", $data);
        return view("kasus.asesmen.ringkasan-pasien-masuk-dan-keluar.index", $data);
    }

    function print(Request $request, $nomor_kasus){
        $kasus = Kasus::with(relasi)->where("nomor_kasus",$nomor_kasus)->first();
        $identitas = Identitas::where('kasus_id', $kasus->id)->first();
        $data["identitas"] = $identitas;
        $data["kasus"] = $kasus;
        $data['dirawat_ke'] = Kasus::where('pasien_id',$kasus->pasien->id)->pluck('id')->toArray();
        $ringkasan_pasien_masuk_dan_keluar = RingkasanPasienMasukDanKeluar::with(["creator"])->where("kasus_id",$kasus->id)
        ->orderBy("id","desc")->get();

        $diagnosaAll = "";
        $i= 1;
        if(count($kasus->diagnosisTambahan) > 0){
            foreach($kasus->diagnosisTambahan as $tambahan){
                $diagnosaAll.= $i++.'. ('.$tambahan->icd10->code_icd.') - '.$tambahan->icd10->long_desc.'<br>';
            }
        }
        $data["diagnosaAll"] = $diagnosaAll;

        $tindakanAll = "";
        $i= 1;
        $visum = 0;
        if(count($kasus->tindakan_icd9) > 0){
            foreach($kasus->tindakan_icd9 as $tindakan){
                $tindakanAll.= $i++.'. ('.$tindakan->icd9->code_icd.') - '.$tindakan->icd9->long_desc.'<br>';
                if($tindakan->tarif_master){
                    if($tindakan->tarif_master->kategori->nama == 'Visum'){
                        $visum = 1;
                    }
                }
            }
        }
        $data["tindakanAll"] = $tindakanAll;
        $data["visum"] = $visum;
        $data["ringkasan_pasien_masuk_dan_keluar"] = $ringkasan_pasien_masuk_dan_keluar;
        $data["sidebar_active"] = "resume";
        $data['active_nav'] = 'ringkasan_masuk_keluar';

        $pdf = DOMPDF::loadView("kasus.asesmen.ringkasan-pasien-masuk-dan-keluar.print", $data);
        return $pdf->stream("print.pdf");
    }
}