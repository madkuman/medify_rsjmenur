<?php

namespace App\Http\Controllers\Kasus\AlatBantu\SOFA;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\AlatSOFA;


define('relasi', ['lokasi.lokasi.departemen', 'identitas', 
    'pembayaran.perusahaan.tipe', 'pasien', 'kelas', 'end_by_creator', 
    'TransaksiRawatInap', 'myInvitation']);

class ViewController extends Controller
{
    public function index($nomor_kasus)
    {
        $kasus = Kasus::with(relasi)->where('nomor_kasus',$nomor_kasus)->first();
        $data['kasus'] = $kasus;
        $sofa = AlatSOFA::with(['creator'])->where('kasus_id',$kasus->id)->orderBy('id','desc')->get();

        foreach($sofa as $item)
        {
            $item = $this->getText($item);
        }
        $data['sofa'] = $sofa;
        $data['sidebar_active'] = 'alat';

        return view('kasus.alatbantu.sofa.index',$data);
    }

    private function getText($data)
    {
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

        if($data->platelets == 0) $data->platelets_text = '>=150';
        else if($data->platelets == 1) $data->platelets_text = '100-149';
        else if($data->platelets == 2) $data->platelets_text = '50-99';
        else if($data->platelets == 3) $data->platelets_text = '20-49';
        else if($data->platelets == 4) $data->platelets_text = '<20';

        if($data->bilirubin == 0) $data->bilirubin_text = '<1.2 (<20)';
        else if($data->bilirubin == 1) $data->bilirubin_text = '1.2-1.9 (20-32)';
        else if($data->bilirubin == 2) $data->bilirubin_text = '2.0–5.9 (33-101)';
        else if($data->bilirubin == 3) $data->bilirubin_text = '6.0–11.9 (102-204)';
        else if($data->bilirubin == 4) $data->bilirubin_text = '≥12.0 (>204)';

        if($data->cardiovascular == 0) $data->cardiovascular_text = 'No hypotension';
        else if($data->cardiovascular == 1) $data->cardiovascular_text = 'MAP <70 mmHg';
        else if($data->cardiovascular == 2) $data->cardiovascular_text = 'Dopamine ≤5 or dobutamine (any dose)';
        else if($data->cardiovascular == 3) $data->cardiovascular_text = 'Dopamine >5, epinephrine ≤0.1, or norepinephrine ≤0.1';
        else if($data->cardiovascular == 4) $data->cardiovascular_text = 'Dopamine >15, epinephrine >0.1, or norepinephrine >0.1';

        if($data->creatinine == 0) $data->creatinine_text = '<1.2 (<110)';
        else if($data->creatinine == 1) $data->creatinine_text = '1.2–1.9 (110-170)';
        else if($data->creatinine == 2) $data->creatinine_text = '2.0–3.4 (171-299)';
        else if($data->creatinine == 3) $data->creatinine_text = '3.5–4.9 (300-440) or UOP <500 mL/day';
        else if($data->creatinine == 4) $data->creatinine_text = '≥5.0 (>440) or UOP <200 mL/day';

        if($data->score > 14) $data->mortality = '95.2% (if initial score), 89.7% (if highest score)';
        else if($data->score > 11) $data->mortality = '95.2% (if initial score), 80% (if highest score)';
        else if($data->score > 9) $data->mortality = '50% (if initial score), 45.8% (if highest score)';
        else if($data->score > 7) $data->mortality = '33.3% (if initial score), 26.3% (if highest score)';
        else if($data->score > 5) $data->mortality = '21.5% (if initial score), 18.2% (if highest score)';
        else if($data->score > 3) $data->mortality = '20.2% (if initial score), 6.7% (if highest score)';
        else if($data->score > 1) $data->mortality = '6.4% (if initial score), 1.5% (if highest score)';
        else $data->mortality = '0.0%';
    }
}
