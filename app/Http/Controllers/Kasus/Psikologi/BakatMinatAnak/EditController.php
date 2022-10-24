<?php

namespace App\Http\Controllers\Kasus\Psikologi\BakatMinatAnak;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\BakatMinatAnak;
use Carbon\Carbon;
use DB;
use Auth;

class EditController extends Controller
{
    public function edit($req){
        $content = [];
        $bakat_minat_anak = BakatMinatAnak::find($req->id);
        
        if(!empty($req->tanggal_tes)){        
            $bakat_minat_anak->tanggal_tes = Carbon::createFromFormat("d/m/Y", $req->tanggal_tes);
        } else {
            $bakat_minat_anak->tanggal_tes = null;
        }

        $bakat_minat_anak->nomor = $req->nomor;
        $bakat_minat_anak->tujuan_tes = $req->tujuan_tes;
        $bakat_minat_anak->penalaran_kongkrit = $req->penalaran_kongkrit;
        $bakat_minat_anak->penalaran_abstrak = $req->penalaran_abstrak;
        $bakat_minat_anak->pemahaman_verbal = $req->pemahaman_verbal;
        $bakat_minat_anak->kemampuan_numerik = $req->kemampuan_numerik;
        $bakat_minat_anak->daya_analisis_sintesa = $req->daya_analisis_sintesa;
        $bakat_minat_anak->daya_bayang_ruang = $req->daya_bayang_ruang;
        $bakat_minat_anak->konsentrasi_daya_ingat = $req->konsentrasi_daya_ingat;
        $bakat_minat_anak->kemampuan_skolastik = $req->kemampuan_skolastik;
        $bakat_minat_anak->kematangan_emosi = $req->kematangan_emosi;
        $bakat_minat_anak->kemasakan_sosial = $req->kemasakan_sosial;
        $bakat_minat_anak->kemampuan_adaptasi = $req->kemampuan_adaptasi;
        $bakat_minat_anak->motivasi_berprestasi = $req->motivasi_berprestasi;
        $bakat_minat_anak->kecepatan_kerja = $req->kecepatan_kerja;
        $bakat_minat_anak->ketelitian = $req->ketelitian;
        $bakat_minat_anak->ketekunan_keuletan = $req->ketekunan_keuletan;
        $bakat_minat_anak->daya_tahan_terhadap_stress = $req->daya_tahan_terhadap_stress;
        $bakat_minat_anak->minat = $req->minat;
        $bakat_minat_anak->saran_pemilihan_penjurusan = $req->saran_pemilihan_penjurusan;
        $bakat_minat_anak->deskripsi = $req->deskripsi;
        $bakat_minat_anak->saran_pemilihan_penjurusan = $req->saran_pemilihan_penjurusan;
        $bakat_minat_anak->kemampuan_intelegensi = $req->kemampuan_intelegensi;
        $bakat_minat_anak->kategori = $req->kategori;
        $bakat_minat_anak->dokter_pemeriksa = $req->dokter_pemeriksa;
        $bakat_minat_anak->overall = $req->overall;

        foreach ($req->minat as $key => $value) {
            $content[] = [
                'judul_minat' => $req->judul_minat[$key],
                'minat' => $req->minat[$key],
            ];
        }
        $bakat_minat_anak->minat = json_encode($content);

        $bakat_minat_anak->updated_by = Auth::user()->id;
        $bakat_minat_anak->updated_at = date('Y-m-d H:i:s');
        $bakat_minat_anak->save();
        return $bakat_minat_anak;
    }
}