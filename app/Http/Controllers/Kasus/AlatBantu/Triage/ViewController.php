<?php

namespace App\Http\Controllers\Kasus\AlatBantu\Triage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\IGD\Triage;
use App\Models\Kasus\Kasus;


define('relasi', ['lokasi.lokasi.departemen', 'identitas', 
    'pembayaran.perusahaan.tipe', 'pasien', 'kelas', 'end_by_creator', 
    'TransaksiRawatInap', 'myInvitation']);

class ViewController extends Controller
{
    public function index($nomor_kasus)
	{
		$kasus = Kasus::with(relasi)->where('nomor_kasus',$nomor_kasus)->first();
    	$data['kasus'] = $kasus;
		$triage_kasus = Triage::with('creator')->where('kasus_id', $kasus->id)->orderBy('id','desc')->get();
		$triage_exist = Triage::with('creator')->whereNull('kasus_id')->orderBy('id','desc')->get();
		foreach($triage_kasus as $item)
        {
            $item = $this->getText($item);
        }
        $data['triage'] = $triage_kasus;
        $data['triage_exist'] = $triage_exist;
        $data['sidebar_active'] = 'alat';

		return view('kasus.alatbantu.triage.index', $data);
	}

	private function getText($data)
    {
        //PARAMETERS
        if($data->mobility == -3) $data->mobility_text = '-';
        else if($data->mobility == -2) $data->mobility_text = '-';
        else if($data->mobility == -1) $data->mobility_text = '-';
        else if($data->mobility == 0) $data->mobility_text = 'Berjalan';
        else if($data->mobility == 1) $data->mobility_text = 'Berjalan dgn bantuan';
        else if($data->mobility == 2) $data->mobility_text = 'Tdk dpt Berjalan';
        else if($data->mobility == 3) $data->mobility_text = '-';

        if($data->resp == -3) $data->resp_text = '0-6';
        else if($data->resp == -2) $data->resp_text = '-';
        else if($data->resp == -1) $data->resp_text = '7 - 11';
        else if($data->resp == 0) $data->resp_text = '12 - 20';
        else if($data->resp == 1) $data->resp_text = '21 - 29';
        else if($data->resp == 2) $data->resp_text = '>= 30';
        else if($data->resp == 3) $data->resp_text = '-';

        if($data->heartrate == -3) $data->heartrate_text = '0';
        else if($data->heartrate == -2) $data->heartrate_text = '< 50';
        else if($data->heartrate == -1) $data->heartrate_text = '50 - 59';
        else if($data->heartrate == 0) $data->heartrate_text = '60 - 100';
        else if($data->heartrate == 1) $data->heartrate_text = '101 - 119';
        else if($data->heartrate == 2) $data->heartrate_text = '120 - 139';
        else if($data->heartrate == 3) $data->heartrate_text = '>= 140';    

        if($data->systol == -3) $data->systol_text = '< 70';
        else if($data->systol == -2) $data->systol_text = '70 - 80';
        else if($data->systol == -1) $data->systol_text = '81 - 100';
        else if($data->systol == 0) $data->systol_text = '101 - 199';
        else if($data->systol == 1) $data->systol_text = '-';
        else if($data->systol == 2) $data->systol_text = '>= 200';
        else if($data->systol == 3) $data->systol_text = '-';

        if($data->conscious == -3) $data->conscious_text = '-';
        else if($data->conscious == -2) $data->conscious_text = '-';
        else if($data->conscious == -1) $data->conscious_text = '-';
        else if($data->conscious == 0) $data->conscious_text = 'Alert';
        else if($data->conscious == 1) $data->conscious_text = 'Respond to Verbal';
        else if($data->conscious == 2) $data->conscious_text = 'Respond to Pain';
        else if($data->conscious == 3) $data->conscious_text = 'Unresponsive';

        if($data->trauma == -3) $data->trauma_text = '-';
        else if($data->trauma == -2) $data->trauma_text = '-';
        else if($data->trauma == -1) $data->trauma_text = '-';
        else if($data->trauma == 0) $data->trauma_text = 'Tidak';
        else if($data->trauma == 1) $data->trauma_text = 'Ya';
        else if($data->trauma == 2) $data->trauma_text = '-';
        else if($data->trauma == 3) $data->trauma_text = '-';

        if($data->temp == -3) $data->temp_text = '-';
        else if($data->temp == -2) $data->temp_text = '< 35';
        else if($data->temp == -1) $data->temp_text = '35 - 35.9';
        else if($data->temp == 0) $data->temp_text = '36 - 37.9';
        else if($data->temp == 1) $data->temp_text = '38 - 38.9';
        else if($data->temp == 2) $data->temp_text = '>= 39';
        else if($data->temp == 3) $data->temp_text = '-';


        $data->mobility = abs($data->mobility);
        $data->resp = abs($data->resp);
        $data->heartrate = abs($data->heartrate);
        $data->systol = abs($data->systol);
        $data->conscious = abs($data->conscious);
        $data->trauma = abs($data->trauma);
        $data->temp = abs($data->temp);

        //DISKRIMINAN
        if (!empty($data->p1_diskriminan)) {
            $p1 = explode(',', $data->p1_diskriminan);
            $p1_text = [];
            foreach ($p1 as $item) {
                switch ($item) {
                    case '1': array_push($p1_text, 'Nyeri dada ischemic');break;
                    case '2': array_push($p1_text, 'Perdarahan tidak terkontrol');break;
                    case '3': array_push($p1_text, 'Dislokasi sendi lain');break;
                    case '4': array_push($p1_text, 'Threatened limb');break;
                    case '5': array_push($p1_text, 'Major trauma');break;
                    case '6': array_push($p1_text, 'Combustio akut wajah');break;
                    case '7': array_push($p1_text, 'Combustio akut inhalasi');break;
                    case '8': array_push($p1_text, 'Combustio akut >20%');break;
                    case '9': array_push($p1_text, 'Combustio akut chemical');break;
                    case '10': array_push($p1_text, 'Combustio akut electrical');break;
                    case '11': array_push($p1_text, 'Hipoglikemia <60');break;
                    case '12': array_push($p1_text, 'Hiperglikemia >400');break;
                    case '13': array_push($p1_text, 'Keracunan/Overdosis');break;
                    case '14': array_push($p1_text, 'Nyeri berat (skor nyeri 8-10)');break;
                    case '15': array_push($p1_text, 'Kejang');break;
                    case '16': array_push($p1_text, 'Apneu');break;
                    case '17': array_push($p1_text, 'Gasping');break;
                    case '18': array_push($p1_text, 'Tidak sadar');break;
                    case '19': array_push($p1_text, 'Henti jantung');break;
                    
                    default:
                        # code...
                        break;
                }
            }
            $data->p1_text = $p1_text;
        }
        if (!empty($data->p2_diskriminan)) {
            $p2 = explode(',', $data->p2_diskriminan);
            $p2_text = [];
            foreach ($p2 as $item) {
                switch ($item) {
                    case '1': array_push($p2_text, 'Nyeri perut');break;
                    case '2': array_push($p2_text, 'Perdarahan terkontrol');break;
                    case '3': array_push($p2_text, 'Agresif/Psikosis');break;
                    case '4': array_push($p2_text, 'Defisit neurologis fokal akut');break;
                    case '5': array_push($p2_text, 'Dislokasi sendi jari tangan/kaki');break;
                    case '6': array_push($p2_text, 'Fraktur');break;
                    case '7': array_push($p2_text, 'Combustio akut circumferencial');break;
                    case '8': array_push($p2_text, 'Muntah profus');break;
                    case '9': array_push($p2_text, 'Diare profus');break;
                    case '10': array_push($p2_text, 'Nyeri sedang (skor nyeri 5-7');break;
                    
                    default:
                        # code...
                        break;
                }
            }
            $data->p2_text = $p2_text;
        }
        if (!empty($data->ponek_diskriminan)) {
            $ponek = explode(',', $data->ponek_diskriminan);
            $ponek_text = [];
            foreach ($ponek as $item) {
                switch ($item) {
                    case '1': array_push($ponek_text, 'Hipertensi');break;
                    case '2': array_push($ponek_text, 'Perdarahan pervaginam');break;
                    case '3': array_push($ponek_text, 'Trauma');break;
                    case '4': array_push($ponek_text, 'Kejang');break;
                    case '5': array_push($ponek_text, 'Sesak nafas berat');break;
                    case '6': array_push($ponek_text, 'Penurunan kesadaran');break;
                    
                    default:
                        # code...
                        break;
                }
            }
            $data->ponek_text = $ponek_text;
        }
    }
}
