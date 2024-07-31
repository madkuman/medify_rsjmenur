<?php

namespace App\Http\Controllers\Kasus\Asesmen\ResikoMelarikanDiri;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\AlatBantu;
use Auth;
use stdClass;

class CreateController extends Controller
{
    public function create(Request $req, $kasus_id){
    	$alatbantu = new AlatBantu;
		$alatbantu->val = $this->requestToJson($req);
        $alatbantu->type = 'resiko-melarikan-diri';
    	$alatbantu->created_by = Auth::user()->id;
    	$alatbantu->kasus_id = $kasus_id;
    	$alatbantu->save();
    }

	public function requestToJson(Request $req)
	{
		$obj = new stdClass;
		$obj->tanggal_masuk = $req->input('tanggal_masuk');
		$obj->ruang = $req->input('ruang');
		$obj->dpjp = $req->input('dpjp');
		$obj->diagnosa_medis = $req->input('diagnosa_medis');
		$obj->faktor_dinamis = $req->input('faktor_dinamis');
		$obj->tanggal = $req->input('tanggal');
		$obj->skoring = $req->input('skoring');

		$perawat_penilai_inputs = $req->input('perawat_penilai');
		foreach ($perawat_penilai_inputs as $perawat_penilai) {
			$obj->perawat_penilai[] = !empty($perawat_penilai) ? $perawat_penilai : ''; 
		}

		$paraf_inputs = $req->input('paraf');
		foreach ($paraf_inputs as $paraf) {
			$obj->paraf[] = !empty($paraf) ? $paraf : ''; 
		}

		$obj->level_resiko = $req->input('level_resiko');

		return json_encode($obj);
	}
}