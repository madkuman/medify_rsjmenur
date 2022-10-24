<?php

namespace App\Http\Controllers\Kasus\AlatBantu\Morse;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\AlatMorse;


define('relasi', ['lokasi.lokasi.departemen', 'identitas', 
    'pembayaran.perusahaan.tipe', 'pasien', 'kelas', 'end_by_creator', 
    'TransaksiRawatInap', 'myInvitation']);

class ViewController extends Controller
{
	public function index($nomor_kasus)
    	{
    		$kasus = Kasus::with(relasi)->where('nomor_kasus',$nomor_kasus)->first();
    		$data['kasus'] = $kasus;
    		$morse = AlatMorse::with(['creator'])->where('kasus_id',$kasus->id)->orderBy('id','desc')->get();

    		foreach($morse as $item)
    		{
           		$item = $this->getText($item);
    		}
    		$data['morse'] = $morse;

       	$data['sidebar_active'] = 'alat';

    		return view('kasus.alatbantu.morse.index',$data);
    	}

   	public function getText($data)
	{
		if($data->jatuh == 25) $data->jatuh_text = 'Yes';
		else if($data->jatuh == 0) $data->jatuh_text = 'No';

		if($data->diagnosis == 15) $data->diagnosis_text = 'Yes';
		else if($data->diagnosis == 0) $data->diagnosis_text = 'No';

		if($data->ambulatory == 0) $data->ambulatory_text = 'Bed rest/nurse assist';
		else if($data->ambulatory == 15) $data->ambulatory_text = 'Crutches/cane/walker';
		else if($data->ambulatory == 30) $data->ambulatory_text = 'Furniture';

		if($data->iv == 20) $data->iv_text = 'Yes';
		else if($data->iv == 0) $data->iv_text = 'No';

		if($data->gait == 0) $data->gait_text = 'Normal/bedrest/immobile';
		else if($data->gait == 10) $data->gait_text = 'Weak';
		else if($data->gait == 20) $data->gait_text = 'Impaired';

		if($data->mental == 0) $data->mental_text = 'Oriented to own ability';
		else if($data->mental == 15) $data->mental_text = 'Forgets Limitation';
	}
}
