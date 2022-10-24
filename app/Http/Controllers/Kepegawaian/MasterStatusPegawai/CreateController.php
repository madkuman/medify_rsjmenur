<?php

namespace App\Http\Controllers\Kepegawaian\MasterStatusPegawai;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\MasterStatusPegawai;
use Auth;

class CreateController extends Controller
{
    public function create($request)
	{
		$slug = explode(' ', strtolower($request->status));
		$slug = implode('-', $slug);

		$status = MasterStatusPegawai::where('slug', $slug)->get();
		
		if (count($status) == 0) {
			$status_pegawai = new MasterStatusPegawai;
			$status_pegawai->status = $request->status;
			$status_pegawai->slug = $slug;
			$status_pegawai->created_by = Auth::user()->id;
			$status_pegawai->save();
			return $status_pegawai;
		} else{
			$status = MasterStatusPegawai::whereOrFail('slug', $slug)->get();
			return $status;
		}
		
	}
}
