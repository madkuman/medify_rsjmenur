<?php

namespace App\Http\Controllers\Admin\Kelas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hospital\Kelas;

class CreateController extends Controller
{
    public function create($data)
    {
    	$kelas = new Kelas;
    	$kelas->nama = $data['nama'];
    	$kelas->rawat_jalan = $data['rawat_jalan'];
    	$kelas->rawat_inap = $data['rawat_inap'];
    	$kelas->igd = $data['igd'];
        $kelas->medical_checkup = $data['medical_checkup'];
    	$kelas->created_by = $data['pegawai'];
    	$kelas->save();

    	return $kelas;
    }
}
