<?php

namespace App\Http\Controllers\Kepegawaian\MasterSubkualifikasi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\MasterSubkualifikasi;
use App\Models\Kepegawaian\MasterKualifikasi;
use Auth;

class CreateController extends Controller
{
	public function create($request)
	{
		$data_kualifikasi = MasterKualifikasi::findOrFail($request->kualifikasi);

		$subkualifikasi = new MasterSubkualifikasi;
		$subkualifikasi->nama = $request->nama;
		$subkualifikasi->kualifikasi_id = $request->kualifikasi;
		$subkualifikasi->created_by = Auth::user()->id;
		$subkualifikasi->save();
		return $subkualifikasi;
	}
}
