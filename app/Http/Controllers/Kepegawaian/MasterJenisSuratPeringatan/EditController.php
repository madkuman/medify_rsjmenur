<?php

namespace App\Http\Controllers\Kepegawaian\MasterJenisSuratPeringatan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\MasterJenisSuratPeringatan;

class EditController extends Controller
{
    public function edit($id, $request)
	{
		$kualifikasi = MasterJenisSuratPeringatan::find($id);
		$kualifikasi->nama = $request->nama;
		$kualifikasi->save();
		return $kualifikasi;
		
	}
}
