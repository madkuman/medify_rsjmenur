<?php

namespace App\Http\Controllers\Kepegawaian\MasterStatusRumah;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\MasterStatusRumah;
use Auth;

class CreateController extends Controller
{
    public function create($request)
	{
		$kualifikasi = new MasterStatusRumah;
		$kualifikasi->status = $request->nama;
		$kualifikasi->created_by = Auth::user()->id;
		$kualifikasi->save();
		return $kualifikasi;
	}
}
