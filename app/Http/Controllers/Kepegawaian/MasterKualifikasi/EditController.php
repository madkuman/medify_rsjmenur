<?php

namespace App\Http\Controllers\Kepegawaian\MasterKualifikasi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\MasterKualifikasi;
use Auth;

class EditController extends Controller
{
	public function edit($id, $request)
	{
		$kualifikasi = MasterKualifikasi::find($id);
		$kualifikasi->nama = $request->nama;
		$kualifikasi->profesi = $request->profesi;
		$kualifikasi->save();
		return $kualifikasi;
		
	}
}
