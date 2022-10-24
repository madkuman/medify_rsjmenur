<?php

namespace App\Http\Controllers\Kepegawaian\MasterJenisSuratPeringatan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\MasterJenisSuratPeringatan;
use Auth;

class CreateController extends Controller
{
    public function create($request)
	{
		$kualifikasi = new MasterJenisSuratPeringatan;
		$kualifikasi->nama = $request->nama;
		$kualifikasi->created_by = Auth::user()->id;
		$kualifikasi->save();
		return $kualifikasi;
	}
}
