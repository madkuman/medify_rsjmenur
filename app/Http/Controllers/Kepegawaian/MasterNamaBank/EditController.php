<?php

namespace App\Http\Controllers\Kepegawaian\MasterNamaBank;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\MasterNamaBank;

class EditController extends Controller
{
    public function edit($id, $request)
	{
		$kualifikasi = MasterNamaBank::find($id);
		$kualifikasi->nama = $request->nama;
		$kualifikasi->save();
		return $kualifikasi;
		
	}
}
