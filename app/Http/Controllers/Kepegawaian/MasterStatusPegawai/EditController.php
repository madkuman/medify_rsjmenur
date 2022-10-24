<?php

namespace App\Http\Controllers\Kepegawaian\MasterStatusPegawai;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\MasterStatusPegawai;

class EditController extends Controller
{
    public function edit($id, $request)
	{
		$slug = explode(' ', strtolower($request->status));
		$slug = implode('-', $slug);

		$status = MasterStatusPegawai::where('slug', $slug)->get();

		if (count($status) == 0) {
			$kualifikasi = MasterStatusPegawai::find($id);
			$kualifikasi->status = $request->status;
			$kualifikasi->slug = $slug;
			$kualifikasi->save();
			return $kualifikasi;
		} else{
			$status = MasterStatusPegawai::whereOrFail('slug', $slug)->get();
			return $status;
		}
		
	}
}
