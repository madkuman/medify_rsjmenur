<?php

namespace App\Http\Controllers\Kasus\Psikologi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\PemeriksaanPsikologiVisum;
use App\Models\Kasus\PsikogramVisum;
use App\Models\Kasus\TesIq;
use App\Models\Kasus\TesIqKeswara;
use App\Models\Kasus\LaporanPsikogramPemeriksaanPsikologi;
use App\Models\Kasus\LaporanDeskripsiPemeriksaanPsikologi;
use App\Models\Kasus\IdentifikasiPotensiPsikologi;
use App\Models\Kasus\BakatMinatAnak;
use App\Models\Kasus\BakatMinatDewasa;
use App\User;

define("relasi", ["lokasi.lokasi.departemen", "identitas", 
    "pembayaran.perusahaan.tipe", "pasien", "kelas", "end_by_creator", 
    "TransaksiRawatInap", "myInvitation"]);

class ViewController extends Controller
{
	public function index($nomor_kasus)
    {
        $kasus = Kasus::with(relasi)->where('nomor_kasus', $nomor_kasus)->first();
        $data['kasus'] = $kasus;
        $data['sidebar_active'] = 'psikologi';
        $data['dokter'] = app('App\Http\Controllers\Users\ReadController')->getDokter();
        $data['galeri'] = app('App\Http\Controllers\Kasus\Psikologi\Galeri\ReadController')->getAllByKasus($kasus->id);

        return view('kasus.psikologi.index', $data);
    }

    public function visum($nomor_kasus)
    {
        $kasus = Kasus::with(relasi)->where('nomor_kasus', $nomor_kasus)->first();
        $data['kasus'] = $kasus;
        $data['sidebar_active'] = 'psikologi';
        $data['dokter'] = app('App\Http\Controllers\Users\ReadController')->getDokter();
        
        $pemeriksaan_psikologi_visum = PemeriksaanPsikologiVisum::with(["creator"])->where("kasus_id",$kasus->id)
                ->orderBy("id","desc")->get();
        $data["pemeriksaan_psikologi_visum"] = $pemeriksaan_psikologi_visum;

        $psikogram_visum = PsikogramVisum::with(["creator"])->where("kasus_id",$kasus->id)
                ->orderBy("id","desc")->get();
        $data["psikogram_visum"] = $psikogram_visum;

        return view('kasus.psikologi.visum', $data);
    }

    public function pemeriksaanDewasa($nomor_kasus)
    {
        $kasus = Kasus::with(relasi)->where('nomor_kasus', $nomor_kasus)->first();
        $data['kasus'] = $kasus;
        $data['sidebar_active'] = 'psikologi';
        $data['dokter'] = app('App\Http\Controllers\Users\ReadController')->getDokter();

        $tes_iq = TesIq::with(["creator"])->where("kasus_id",$kasus->id)
                ->orderBy("id","desc")->get();
        $data["tes_iq"] = $tes_iq;

        $bakat_minat_dewasa = BakatMinatDewasa::with(["creator"])
            ->where("kasus_id", $kasus->id)
            ->orderBy("id", "desc")->get();
        $data["bakat_minat_dewasa"] = $bakat_minat_dewasa;

        return view('kasus.psikologi.pemeriksaan-dewasa', $data);
    }

    public function pemeriksaanAnak($nomor_kasus)
    {
        $kasus = Kasus::with(relasi)->where('nomor_kasus', $nomor_kasus)->first();
        $data['kasus'] = $kasus;
        $data['sidebar_active'] = 'psikologi';
        $data['dokter'] = User::where('profesi', 1)->get();
        // $data['dokter'] = app('App\Http\Controllers\Users\ReadController')->getDokter();

        $tes_iq_keswara = TesIqKeswara::with(["creator"])->where("kasus_id",$kasus->id)
                ->orderBy("id","desc")->get();
        $data["tes_iq_keswara"] = $tes_iq_keswara;

        $bakat_minat_anak = BakatMinatAnak::with(["creator", "dokterPemeriksa"])
            ->where("kasus_id", $kasus->id)
            ->orderBy("id", "desc")->get();
        $data["bakat_minat_anak"] = $bakat_minat_anak;

        $identifikasi_potensi_psikologi = IdentifikasiPotensiPsikologi::with(["creator", 'dokterPemeriksa'])
            ->where("kasus_id", $kasus->id)
            ->orderBy("id", "desc")->get();
        $data["identifikasi_potensi_psikologi"] = $identifikasi_potensi_psikologi;

        $pemeriksaan_psikologis_anak = app(\App\Http\Controllers\Kasus\Psikologi\PemeriksaanPsikologisAnak\ReadController::class)->getByKasusId($kasus->id);
        $data["pemeriksaan_psikologis_anak"] = $pemeriksaan_psikologis_anak;

        return view('kasus.psikologi.pemeriksaan-anak', $data);
    }

    public function laporanPemeriksaanPsikologi($nomor_kasus)
    {
        $kasus = Kasus::with(relasi)->where('nomor_kasus', $nomor_kasus)->first();
        $data['kasus'] = $kasus;
        $data['sidebar_active'] = 'psikologi';
        $data['dokter'] = app('App\Http\Controllers\Users\ReadController')->getDokter();
        
        $deskripsi = LaporanDeskripsiPemeriksaanPsikologi::with(["creator"])->where("kasus_id",$kasus->id)
                ->orderBy("id","desc")->get();
        $data["laporan_deskripsi_pemeriksaan_psikologi"] = $deskripsi;

        $psikogram = LaporanPsikogramPemeriksaanPsikologi::with(["creator"])->where("kasus_id",$kasus->id)
                ->orderBy("id","desc")->get();
        $data["laporan_psikogram_pemeriksaan_psikologi"] = $psikogram;

        return view('kasus.psikologi.laporan-pemeriksaan-psikologi', $data);
    }
}