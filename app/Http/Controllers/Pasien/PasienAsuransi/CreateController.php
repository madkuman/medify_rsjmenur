<?php

namespace App\Http\Controllers\Pasien\PasienAsuransi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pasien\PasienAsuransi;

class CreateController extends Controller
{
	public function create($pasien_id,$data)
	{
        if($data['type'] == 2) $data['asuransi'] = 10;

		$asuransi = new PasienAsuransi;
		$asuransi->patients_id = $pasien_id;
		$asuransi->company_id = $data['asuransi'];
		$asuransi->number = $data['asuransi_nomor'];
		$asuransi->created_by = 1;
		$asuransi->save();

		return array(
			'pasien_asuransi' => $asuransi,
			'status' => 1
		);

	}
}
