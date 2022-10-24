<?php

namespace App\Http\Controllers\Kepegawaian\MasterJenisPegawai;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\MasterJenisPegawai;

class EditController extends Controller
{
    public function edit($id, $request)
	{
		$kualifikasi = MasterJenisPegawai::find($id);
		$kualifikasi->nama = $request->nama;
        $kualifikasi->index = $request->index;
		$kualifikasi->save();
		return $kualifikasi;
		
	}
}
