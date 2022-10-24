<?php

namespace App\Http\Controllers\Kepegawaian\MasterKualifikasi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\MasterKualifikasi;
use Auth;

class CreateController extends Controller
{
	public function create($request)
	{
		$kualifikasi = new MasterKualifikasi;
		$kualifikasi->nama = $request->nama;
		$kualifikasi->profesi = $request->profesi;
		$kualifikasi->created_by = Auth::user()->id;
		$kualifikasi->save();
		return $kualifikasi;
	}
}
