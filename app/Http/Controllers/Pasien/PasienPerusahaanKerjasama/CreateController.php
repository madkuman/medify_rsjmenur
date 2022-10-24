<?php

namespace App\Http\Controllers\Pasien\PasienPerusahaanKerjasama;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pasien\PasienPerusahaanKerjasama;

class CreateController extends Controller
{
    	public function create($pasien_id,$data)
    	{
    		$kerjasama = new PasienPerusahaanKerjasama;
    		$kerjasama->patients_id = $pasien_id;
    		$kerjasama->company_id = $data['perusahaan_kerjasama'];
    		$kerjasama->number = $data['identitas_pegawai'];
    		$kerjasama->created_by = 1;
    		$kerjasama->save();

    		return array(
    			'kerjasama' => $kerjasama,
    			'status' => 1
    		);

    	}
}
