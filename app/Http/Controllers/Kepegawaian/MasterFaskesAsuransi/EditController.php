<?php

namespace App\Http\Controllers\Kepegawaian\MasterFaskesAsuransi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\MasterFaskesAsuransi;

class EditController extends Controller
{
    public function edit($id, $request)
	{
		$kualifikasi = MasterFaskesAsuransi::find($id);
		$kualifikasi->nama = $request->nama;
		$kualifikasi->save();
		return $kualifikasi;
		
	}
}
