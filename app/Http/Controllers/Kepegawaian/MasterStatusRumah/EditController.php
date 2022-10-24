<?php

namespace App\Http\Controllers\Kepegawaian\MasterStatusRumah;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\MasterStatusRumah;

class EditController extends Controller
{
    public function edit($id, $request)
	{
		$kualifikasi = MasterStatusRumah::find($id);
		$kualifikasi->status = $request->nama;
		$kualifikasi->save();
		return $kualifikasi;
		
	}
}
