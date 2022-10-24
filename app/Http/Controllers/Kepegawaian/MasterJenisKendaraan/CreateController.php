<?php

namespace App\Http\Controllers\Kepegawaian\MasterJenisKendaraan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\MasterJenisKendaraan;
use Auth;

class CreateController extends Controller
{
    public function create($request)
	{
		$kualifikasi = new MasterJenisKendaraan;
		$kualifikasi->nama = $request->nama;
		$kualifikasi->created_by = Auth::user()->id;
		$kualifikasi->save();
		return $kualifikasi;
	}
}
