<?php

namespace App\Http\Controllers\Kasus\AlatBantu\ApacheII;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\AlatApacheII;


define('relasi', ['lokasi.lokasi.departemen', 'identitas', 
    'pembayaran.perusahaan.tipe', 'pasien', 'kelas', 'end_by_creator', 
    'TransaksiRawatInap', 'myInvitation']);

class ViewController extends Controller
{
    public function index($nomor_kasus)
    {
        $kasus = Kasus::with(relasi)->where('nomor_kasus',$nomor_kasus)->first();
        $data['kasus'] = $kasus;
        $apache = AlatApacheII::with(['creator'])->where('kasus_id',$kasus->id)->orderBy('id','desc')->get();

        foreach($apache as $item)
        {
            $item = $this->getText($item);
        }
        $data['apache'] = $apache;
        $data['sidebar_active'] = 'alat';

        return view('kasus.alatbantu.apache-ii.index',$data);
    }

    private function getText($data)
    {
        if($data->gcs_eye == 1) $data->gcs_eye_text = 'Tidak membuka';
        else if($data->gcs_eye == 2) $data->gcs_eye_text = 'Membuka terhadap respon sakit';
        else if($data->gcs_eye == 3) $data->gcs_eye_text = 'Membuka terhadap perintah verbal';
        else $data->gcs_eye_text = 'Membuka spontan';

        if($data->gcs_verbal == 1) $data->gcs_verbal_text = 'Tidak ada respon';
        else if($data->gcs_verbal == 2) $data->gcs_verbal_text = 'Suara tidak jelas';
        else if($data->gcs_verbal == 3) $data->gcs_verbal_text = 'Kata-kata tidak sopan';
        else if($data->gcs_verbal == 4) $data->gcs_verbal_text = 'Kebingungan';
        else $data->gcs_verbal_text = 'Respon baik';

        if($data->gcs_motor == 1) $data->gcs_motor_text = 'Tidak ada respon';
        else if($data->gcs_motor == 2) $data->gcs_motor_text = 'Extension to pain';
        else if($data->gcs_motor == 3) $data->gcs_motor_text = 'Flexion to pain';
        else if($data->gcs_motor == 4) $data->gcs_motor_text = 'Withdrawal from pain';
        else if($data->gcs_motor == 5) $data->gcs_motor_text = 'Localizes pain';
        else $data->gcs_motor_text = 'Mematuhi perintah';

        if($data->history == 0) $data->history_text = 'Tidak';
        else if($data->history == 2) $data->history_text = 'Ya (Elective Post-Op Patient)';
        else $data->history_text = 'Ya (Non-Operative/Emergency Post-Op Patient)';

        if($data->renal == 0) $data->renal_text = 'Tidak';
        else $data->renal_text = 'Ya';

        if($data->fio2 == 0){
        	$data->fio2_text = '&lt;50% (or non-intubated)';
        	if($data->pao2 == 0) $data->pao2_text = '&gt;70 mmHg';
	        else if($data->pao2 == 1) $data->pao2_text = '61-70 mmHg';
	        else if($data->pao2 == 3) $data->pao2_text = '55-60 mmHg';
	        else $data->pao2_text = '&lt;55 mmHg';
        }
        else{
			$data->fio2_text = '&ge;50%';
			if($data->aa_grad == 0) $data->aa_grad_text = '&lt;200';
	        else if($data->aa_grad == 2) $data->aa_grad_text = '200-349';
	        else if($data->aa_grad == 3) $data->aa_grad_text = '350-499';
	        else $data->aa_grad_text = '&gt;499';
        }

        if($data->score < 5) $data->score_text = 'Mortality: 4% (Non-Op), 1% (Post-Op)';
        else if($data->score < 10) $data->score_text = 'Mortality: 8% (Non-Op), 3% (Post-Op)';
        else if($data->score < 15) $data->score_text = 'Mortality: 15% (Non-Op), 7% (Post-Op)';
        else if($data->score < 20) $data->score_text = 'Mortality: 25% (Non-Op), 12% (Post-Op)';
        else if($data->score < 25) $data->score_text = 'Mortality: 40% (Non-Op), 30% (Post-Op)';
        else if($data->score < 30) $data->score_text = 'Mortality: 55% (Non-Op), 35% (Post-Op)';
        else if($data->score < 34) $data->score_text = 'Mortality: 73% (Non-Op, Post-Op)';
        else $data->score_text = 'Mortality: 85% (Non-Op), 88% (Post-Op)';
    }
}
