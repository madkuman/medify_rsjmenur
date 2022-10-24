<?php

namespace App\Http\Controllers\Kasus\Asesmen\LembarKomunikasiInformasiDanEdukasiPasienDanKeluarga;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\LembarKomunikasiInformasiDanEdukasiPasienDanKeluarga;
use DB;
use Auth;
use Carbon\Carbon;

class CreateController extends Controller
{
    public function create($req, $kasus_id){
    	$lembar_komunikasi_informasi_dan_edukasi_pasien_dan_keluarga = new LembarKomunikasiInformasiDanEdukasiPasienDanKeluarga;
    	
        $lembar_komunikasi_informasi_dan_edukasi_pasien_dan_keluarga->kebutuhan_materi_edukasi_informasi = $req->kebutuhan_materi_edukasi_informasi;
        $lembar_komunikasi_informasi_dan_edukasi_pasien_dan_keluarga->asesmen_id = $req->asesmen_id;
        if(!empty($req->tanggal_edukasi)){        
            $lembar_komunikasi_informasi_dan_edukasi_pasien_dan_keluarga->tanggal_edukasi = Carbon::createFromFormat("d/m/Y", $req->tanggal_edukasi);
        } else {
            $lembar_komunikasi_informasi_dan_edukasi_pasien_dan_keluarga->tanggal_edukasi = null;
        }
        $lembar_komunikasi_informasi_dan_edukasi_pasien_dan_keluarga->jam_edukasi = $req->jam_edukasi;
        $lembar_komunikasi_informasi_dan_edukasi_pasien_dan_keluarga->durasi_edukasi = $req->durasi_edukasi;
        $lembar_komunikasi_informasi_dan_edukasi_pasien_dan_keluarga->metode = $req->metode;
        $lembar_komunikasi_informasi_dan_edukasi_pasien_dan_keluarga->nama_edukator_pemberi_informasi = $req->nama_edukator_pemberi_informasi;
        $lembar_komunikasi_informasi_dan_edukasi_pasien_dan_keluarga->verifikasi_verfikasi = $req->verifikasi_verfikasi;
        $lembar_komunikasi_informasi_dan_edukasi_pasien_dan_keluarga->verifikasi_verfikasi = $req->verifikasi_verfikasi;
        $lembar_komunikasi_informasi_dan_edukasi_pasien_dan_keluarga->nama_penerima_informasi = $req->nama_penerima_informasi;
        $lembar_komunikasi_informasi_dan_edukasi_pasien_dan_keluarga->hubungan_terhadap_pasien = $req->hubungan_terhadap_pasien;
    	$lembar_komunikasi_informasi_dan_edukasi_pasien_dan_keluarga->created_by = Auth::user()->id;
    	$lembar_komunikasi_informasi_dan_edukasi_pasien_dan_keluarga->kasus_id = $kasus_id;
    	$lembar_komunikasi_informasi_dan_edukasi_pasien_dan_keluarga->save();
    }
}