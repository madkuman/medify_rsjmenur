<?php

namespace App\Http\Controllers\Pasien\PasienPerusahaanKerjasama;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pasien\PasienPerusahaanKerjasama;

class EditController extends Controller
{
	public function edit($pasien)
	{
		$asuransi = PasienPerusahaanKerjasama::where('patients_id',$pasien['id'])->first();

		if(empty($kerjasama))
		{
			$kerjasama = app('App\Http\Controllers\Pasien\PasienPerusahaanKerjasama\CreateController')->create($pasien['id'],$pasien);
		}
		else
		{
	    		$kerjasama->company_id = $pasien['perusahaan_kerjasama'];
	    		$kerjasama->number = $pasien['identitas_pegawai'];
	    		$kerjasama->created_by = 1;
	    		$kerjasama->save();
		}

    		return array(
    			'kerjasama' => $kerjasama,
    			'status' => 1
    		);
	}
}
