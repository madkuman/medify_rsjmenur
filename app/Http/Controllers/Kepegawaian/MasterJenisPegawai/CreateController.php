<?php

namespace App\Http\Controllers\Kepegawaian\MasterJenisPegawai;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\MasterJenisPegawai;
use Auth;

class CreateController extends Controller
{
    public function create($request)
	{
		$kualifikasi = new MasterJenisPegawai;
		$kualifikasi->nama = $request->nama;
		$kualifikasi->index = $request->index;
		$kualifikasi->created_by = Auth::user()->id;
		$kualifikasi->save();
		return $kualifikasi;
	}
}
