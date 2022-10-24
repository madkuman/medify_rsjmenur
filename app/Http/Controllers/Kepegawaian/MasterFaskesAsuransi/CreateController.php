<?php

namespace App\Http\Controllers\Kepegawaian\MasterFaskesAsuransi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\MasterFaskesAsuransi;
use Auth;

class CreateController extends Controller
{
    public function create($request)
	{
		$kualifikasi = new MasterFaskesAsuransi;
		$kualifikasi->nama = $request->nama;
		$kualifikasi->created_by = Auth::user()->id;
		$kualifikasi->save();
		return $kualifikasi;
	}
}
