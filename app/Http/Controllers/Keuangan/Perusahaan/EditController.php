<?php

namespace App\Http\Controllers\Keuangan\Perusahaan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Keuangan\Perusahaan;

class EditController extends Controller
{
    public function update($id,$nama,$npwp,$jabatan,$direktur,$alamat)
	{
		$perusahaan = Perusahaan::find($id);
		$perusahaan->nama = $nama;
		$perusahaan->npwp = $npwp;
		$perusahaan->jabatan = $jabatan;
		$perusahaan->direktur = $direktur;
		$perusahaan->alamat = $alamat;
		$perusahaan->save();

		return $perusahaan;
	}
}
