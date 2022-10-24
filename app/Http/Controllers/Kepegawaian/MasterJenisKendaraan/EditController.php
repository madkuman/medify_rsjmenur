<?php

namespace App\Http\Controllers\Kepegawaian\MasterJenisKendaraan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\MasterJenisKendaraan;

class EditController extends Controller
{
    public function edit($id, $request)
	{
		$kualifikasi = MasterJenisKendaraan::find($id);
		$kualifikasi->nama = $request->nama;
		$kualifikasi->save();
		return $kualifikasi;
		
	}
}
