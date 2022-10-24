<?php

namespace App\Http\Controllers\Kasus\AlatBantu\Triss;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\AlatTriss;


define('relasi', ['lokasi.lokasi.departemen', 'identitas', 
    'pembayaran.perusahaan.tipe', 'pasien', 'kelas', 'end_by_creator', 
    'TransaksiRawatInap', 'myInvitation']);

class ViewController extends Controller
{
    public function index($nomor_kasus)
    {
        $kasus = Kasus::with(relasi)->where('nomor_kasus',$nomor_kasus)->first();
        $data['kasus'] = $kasus;
        $triss = AlatTriss::with(['creator'])->where('kasus_id',$kasus->id)->orderBy('id','desc')->get();

        foreach($triss as $item)
        {
            $item = $this->getText($item);
        }
        $data['triss'] = $triss;
        $data['sidebar_active'] = 'alat';

        return view('kasus.alatbantu.triss.index',$data);
    }

    private function getText($data)
    {
        if($data->headneck == 0) $data->headneck_text = 'None';
        else if($data->headneck == 1) $data->headneck_text = 'Minor';
        else if($data->headneck == 2) $data->headneck_text = 'Moderate';
        else if($data->headneck == 3) $data->headneck_text = 'Serious';
        else if($data->headneck == 4) $data->headneck_text = 'Severe';
        else if($data->headneck == 5) $data->headneck_text = 'Critical';
        else if($data->headneck == 6) $data->headneck_text = 'Unsurvivable';

        if($data->face == 0) $data->face_text = 'None';
        else if($data->face == 1) $data->face_text = 'Minor';
        else if($data->face == 2) $data->face_text = 'Moderate';
        else if($data->face == 3) $data->face_text = 'Serious';
        else if($data->face == 4) $data->face_text = 'Severe';
        else if($data->face == 5) $data->face_text = 'Critical';
        else if($data->face == 6) $data->face_text = 'Unsurvivable';

        if($data->chest == 0) $data->chest_text = 'None';
        else if($data->chest == 1) $data->chest_text = 'Minor';
        else if($data->chest == 2) $data->chest_text = 'Moderate';
        else if($data->chest == 3) $data->chest_text = 'Serious';
        else if($data->chest == 4) $data->chest_text = 'Severe';
        else if($data->chest == 5) $data->chest_text = 'Critical';
        else if($data->chest == 6) $data->chest_text = 'Unsurvivable';

        if($data->abdomen == 0) $data->abdomen_text = 'None';
        else if($data->abdomen == 1) $data->abdomen_text = 'Minor';
        else if($data->abdomen == 2) $data->abdomen_text = 'Moderate';
        else if($data->abdomen == 3) $data->abdomen_text = 'Serious';
        else if($data->abdomen == 4) $data->abdomen_text = 'Severe';
        else if($data->abdomen == 5) $data->abdomen_text = 'Critical';
        else if($data->abdomen == 6) $data->abdomen_text = 'Unsurvivable';

        if($data->extremity == 0) $data->extremity_text = 'None';
        else if($data->extremity == 1) $data->extremity_text = 'Minor';
        else if($data->extremity == 2) $data->extremity_text = 'Moderate';
        else if($data->extremity == 3) $data->extremity_text = 'Serious';
        else if($data->extremity == 4) $data->extremity_text = 'Severe';
        else if($data->extremity == 5) $data->extremity_text = 'Critical';
        else if($data->extremity == 6) $data->extremity_text = 'Unsurvivable';

        if($data->external == 0) $data->external_text = 'None';
        else if($data->external == 1) $data->external_text = 'Minor';
        else if($data->external == 2) $data->external_text = 'Moderate';
        else if($data->external == 3) $data->external_text = 'Serious';
        else if($data->external == 4) $data->external_text = 'Severe';
        else if($data->external == 5) $data->external_text = 'Critical';
        else if($data->external == 6) $data->external_text = 'Unsurvivable';

        if($data->gcs_eye == 1) $data->gcs_eye_text = 'Tidak membuka';
        else if($data->gcs_eye == 2) $data->gcs_eye_text = 'Membuka terhadap respon sakit';
        else if($data->gcs_eye == 3) $data->gcs_eye_text = 'Membuka terhadap perintah verbal';
        else if($data->gcs_eye == 4) $data->gcs_eye_text = 'Membuka spontan';

        if($data->gcs_verbal == 1) $data->gcs_verbal_text = 'Tidak ada respon';
        else if($data->gcs_verbal == 2) $data->gcs_verbal_text = 'Suara tidak jelas';
        else if($data->gcs_verbal == 3) $data->gcs_verbal_text = 'Kata-kata tidak sopan';
        else if($data->gcs_verbal == 4) $data->gcs_verbal_text = 'Kebingungan';
        else if($data->gcs_verbal == 5) $data->gcs_verbal_text = 'Respon baik';

        if($data->gcs_motor == 1) $data->gcs_motor_text = 'Tidak ada respon';
        else if($data->gcs_motor == 2) $data->gcs_motor_text = 'Extension to pain';
        else if($data->gcs_motor == 3) $data->gcs_motor_text = 'Flexion to pain';
        else if($data->gcs_motor == 4) $data->gcs_motor_text = 'Withdrawal from pain';
        else if($data->gcs_motor == 5) $data->gcs_motor_text = 'Localizes pain';
        else if($data->gcs_motor == 6) $data->gcs_motor_text = 'Mematuhi perintah';
    }
}
