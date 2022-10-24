<?php

namespace App\Http\Controllers\Kepegawaian\MasterNamaBank;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\MasterNamaBank;
use Auth;

class CreateController extends Controller
{
    public function create($request)
	{
		$kualifikasi = new MasterNamaBank;
		$kualifikasi->nama = $request->nama;
		$kualifikasi->created_by = Auth::user()->id;
		$kualifikasi->save();
		return $kualifikasi;
	}
}
