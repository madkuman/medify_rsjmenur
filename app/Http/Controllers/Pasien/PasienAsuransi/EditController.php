<?php

namespace App\Http\Controllers\Pasien\PasienAsuransi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pasien\PasienAsuransi;

class EditController extends Controller
{
    	public function edit($pasien)
	{
        	if($pasien['type'] == 2) $pasien['asuransi'] = 10;

		$asuransi = PasienAsuransi::where('patients_id',$pasien['id'])->first();

		if(empty($asuransi))
		{
			$asuransi = app('App\Http\Controllers\Pasien\PasienAsuransi\CreateController')->create($pasien['id'],$pasien);
		}
		else
		{
			$asuransi->company_id = $pasien['asuransi'];
			$asuransi->number = $pasien['asuransi_nomor'];
			$asuransi->save();
		}

		return array(
			'pasien_asuransi' => $asuransi,
			'status' => 1
		);
	}
}
