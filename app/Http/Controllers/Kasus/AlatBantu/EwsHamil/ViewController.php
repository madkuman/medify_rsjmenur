<?php

namespace App\Http\Controllers\Kasus\AlatBantu\EwsHamil;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\AlatBantu;


define('relasi', ['lokasi.lokasi.departemen', 'identitas', 
    'pembayaran.perusahaan.tipe', 'pasien', 'kelas', 'end_by_creator', 
    'TransaksiRawatInap', 'myInvitation']);

class ViewController extends Controller
{
	public function index($nomor_kasus)
    	{
    		$kasus = Kasus::with(relasi)->where('nomor_kasus',$nomor_kasus)->first();
    		$data['kasus'] = $kasus;
    		$ewsHamil = AlatBantu::where('type', 'EWS Ibu Hamil')->with(['creator'])->where('kasus_id',$kasus->id)->orderBy('id','desc')->get();

    		foreach($ewsHamil as $item)
    		{
    			$item->val = json_decode($item->val);
           		$item = $this->getText($item->val);
    		}
    		$data['ewsHamil'] = $ewsHamil;


       		$data['sidebar_active'] = 'alat';

    		return view('kasus.alatbantu.ews-hamil.index',$data);
    	}

    	public function getText($data)
	{
		if($data->respiratory == "Normal") $data->respiratory_text = '11 - 19';
		else if($data->respiratory == "Yellow") $data->respiratory_text = '20 - 24';
		else if($data->respiratory == "Pink") $data->respiratory_text = '< 10 or ≥ 25';

		if($data->spo2 == "Normal") $data->spo2_text = '96 - 100';
		else if($data->spo2 == "Yellow") $data->spo2_text = '-';
		else if($data->spo2 == "Pink") $data->spo2_text = '< 95';

		if($data->temp == "Normal") $data->temp_text = '36.0 - 37.4';
		else if($data->temp == "Yellow") $data->temp_text = '35.1 - 35.9 or 37.5 - 37.9';
		else if($data->temp == "Pink") $data->temp_text = '< 35 or ≥ 38';

		if($data->maternal == "Normal") $data->maternal_text = '60 - 99';
		else if($data->maternal == "Yellow") $data->maternal_text = '50 - 59 or 100 - 119';
		else if($data->maternal == "Pink") $data->maternal_text = '< 50 or ≥ 120';

		if($data->systol == "Normal") $data->systol_text = '100 - 139';
		else if($data->systol == "Yellow") $data->systol_text = '90 - 99 or 140 - 159';
		else if($data->systol == "Pink") $data->systol_text = '< 90 or ≥ 160';

		if($data->diastol == "Normal") $data->diastol_text = '50 - 89';
		else if($data->diastol == "Yellow") $data->diastol_text = '40 - 49 or 90 - 99';
		else if($data->diastol == "Pink") $data->diastol_text = '< 40 or ≥ 110';

		if($data->avpu == "Normal") $data->avpu_text = 'Alert';
		else if($data->avpu == "Yellow") $data->avpu_text = '-';
		else if($data->avpu == "Pink") $data->avpu_text = 'Voice Pain or Unresponsive';

		return $data;
	}
}
