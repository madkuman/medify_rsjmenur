<?php

namespace App\Http\Controllers\Kepegawaian\MasterSubkualifikasi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\MasterSubkualifikasi;
use Auth;
class EditController extends Controller
{
    public function edit($id, $request)
	{
		$subkualifikasi = MasterSubkualifikasi::find($id);
		$subkualifikasi->nama = $request->nama;
		$subkualifikasi->kualifikasi_id = $request->kualifikasi;
		$subkualifikasi->save();
		return $subkualifikasi;
	}
}
