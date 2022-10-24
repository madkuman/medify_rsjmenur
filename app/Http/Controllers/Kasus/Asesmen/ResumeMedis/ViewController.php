<?php

namespace App\Http\Controllers\Kasus\Asesmen\ResumeMedis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\ResumeMedis;
use DOMPDF;

define("relasi", ["lokasi.lokasi.departemen", "identitas", 
    "pembayaran.perusahaan.tipe", "pasien", "kelas", "end_by_creator", 
    "TransaksiRawatInap", "myInvitation"]);

class ViewController extends Controller
{
	function index(Request $request, $nomor_kasus){
		$kasus = Kasus::with(relasi)->where("nomor_kasus",$nomor_kasus)->first();
        $data["kasus"] = $kasus;
        $resume_medis = ResumeMedis::with(["creator"])->where("kasus_id",$kasus->id)
        		->orderBy("id","desc")->get();

        $data["resume_medis"] = $resume_medis;
        $data["sidebar_active"] = "resume";
        $data['active_nav'] = 'resume_medis';

        $diagnosaAll = "";
        $i= 1;
        if(count($kasus->diagnosisTambahan) > 0){
            foreach($kasus->diagnosisTambahan as $tambahan){
                $diagnosaAll.= $i++.'. ('.$tambahan->icd10->code_icd.') - '.$tambahan->icd10->long_desc.'\n';
            }
        }
        $data["diagnosaAll"] = $diagnosaAll;

        $tindakanAll = "";
        $tindakanUtama = "";
        $i= 1;
        if(count($kasus->tindakan_icd9) > 0){
            foreach($kasus->tindakan_icd9 as $tindakan){
                if($i == 1) { $tindakanUtama = '('.$tindakan->icd9->code_icd.') - '.$tindakan->icd9->long_desc.'\n'; }  
                $tindakanAll.= $i++.'. ('.$tindakan->icd9->code_icd.') - '.$tindakan->icd9->long_desc.'\n';
            }
        }
        $data["tindakanAll"] = $tindakanAll;
        $data["tindakanUtama"] = $tindakanUtama;

        $resepAll = "";
        if(count($kasus->resep) > 0){
            foreach($kasus->resep as $resep){
                foreach($resep->resepDetail as $detail){
                    if($detail->kategori == 'racikan') {
                        $resepAll.= '- '.$detail->racikan.'\n';
                    }
                    else{
                        $resepAll.= '- '.$detail->obat_name.', '.$detail->jumlah.', '.$detail->type.'\n';   
                    }
                }
            }
        }
        $data["resepAll"] = $resepAll;

        return view("kasus.resume.index", $data);
        return view("kasus.asesmen.resume-medis.index", $data);
	}

    function print(Request $request, $nomor_kasus, $id){
        $kasus = Kasus::with(relasi)->where("nomor_kasus",$nomor_kasus)->first();
        $data["kasus"] = $kasus;
        $resume_medis = ResumeMedis::with(["creator"])->where("kasus_id",$kasus->id)->where("id",$id)
                ->orderBy("id","desc")->first();

        $data["item"] = $resume_medis;
        $data["sidebar_active"] = "alat";

        $pdf = DOMPDF::loadView("kasus.asesmen.resume-medis.print", $data);
        return $pdf->stream("print.pdf");
    }
}