<?php

namespace App\Http\Controllers\Kasus\AlatBantu\Pulang;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\AlatPulang;


define('relasi', ['lokasi.lokasi.departemen', 'identitas', 
    'pembayaran.perusahaan.tipe', 'pasien', 'kelas', 'end_by_creator', 
    'TransaksiRawatInap', 'myInvitation']);

class ViewController extends Controller
{
    public function index($nomor_kasus)
    {
        $kasus = Kasus::with(relasi)->where('nomor_kasus',$nomor_kasus)->first();
        $data['kasus'] = $kasus;
        $pulang = AlatPulang::with(['creator'])->where('kasus_id',$kasus->id)->orderBy('id','desc')->get();

        // foreach($pulang as $item)
        // {
        //     $item = $this->getText($item);
        // }

        $data['pulang'] = $pulang;


        $data['sidebar_active'] = 'alat';

        return view('kasus.alatbantu.pulang.index',$data);
    }
    private function getText($data)
    {
        if($data->membuka_mata == 4) $data->membuka_mata_text = 'Spontan';
        else if($data->membuka_mata == 3) $data->membuka_mata_text = 'Respon terhadap suara';
        else if($data->membuka_mata == 2) $data->membuka_mata_text = 'Rangsangan terhadap tekanan';
        else if($data->membuka_mata == 1) $data->membuka_mata_text = 'Tidak ada';
        else if($data->membuka_mata == 0) $data->membuka_mata_text = 'Tidak dapat dinilai';
        
        if($data->respon_verbal == 5) $data->respon_verbal_text = 'Orientasi baik';
        else if($data->respon_verbal == 4) $data->respon_verbal_text = 'Bingung';
        else if($data->respon_verbal == 3) $data->respon_verbal_text = 'Kalimat';
        else if($data->respon_verbal == 2) $data->respon_verbal_text = 'Suara';
        else if($data->respon_verbal == 1) $data->respon_verbal_text = 'Tidak ada';
        else if($data->respon_verbal == 0) $data->respon_verbal_text = 'Tidak dapat dinilai';
        
        if($data->respon_motorik == 6) $data->respon_motorik_text = 'Menuruti perintah';
        else if($data->respon_motorik == 5) $data->respon_motorik_text = 'Melokalisir';
        else if($data->respon_motorik == 4) $data->respon_motorik_text = 'Fleksi normal';
        else if($data->respon_motorik == 3) $data->respon_motorik_text = 'Fleksi tidak normal';
        else if($data->respon_motorik == 2) $data->respon_motorik_text = 'Ekstensi';
        else if($data->respon_motorik == 1) $data->respon_motorik_text = 'Tidak ada';
        else if($data->respon_motorik == 0) $data->respon_motorik_text = 'Tidak dapat dinilai';    

        $data->membuka_mata = abs($data->membuka_mata);
        $data->respon_verbal = abs($data->respon_verbal);
        $data->respon_motorik = abs($data->respon_motorik);
    }
}
