<?php

namespace App\Http\Controllers\Kepegawaian\MasterPendidikan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ViewController extends Controller
{
	public function index()
	{
		return view('kepegawaian.master.pendidikan.index');
	}

    public function gelarPendidikan()
	{
		$data['gelar'] = app("App\Http\Controllers\Kepegawaian\MasterPendidikan\ReadController")->getAllGelar();
		$data['strata'] = app("App\Http\Controllers\Kepegawaian\MasterPendidikan\ReadController")->getAllStrata();
		return view('kepegawaian.master.pendidikan.gelar-pendidikan.index', $data);
	}
	
	public function strataPendidikan()
	{
        $data['strata'] = app("App\Http\Controllers\Kepegawaian\MasterPendidikan\ReadController")->getAllStrata();
        $data['jenis'] = app("App\Http\Controllers\Kepegawaian\MasterPendidikan\ReadController")->getAllJenisPendidikan();
		return view('kepegawaian.master.pendidikan.strata-pendidikan.index', $data);
    }

    public function jenisPendidikan()
	{
		$data['jenis'] = app("App\Http\Controllers\Kepegawaian\MasterPendidikan\ReadController")->getAllJenisPendidikan();
		return view('kepegawaian.master.pendidikan.jenis-pendidikan.index', $data);
    }
    
    public function institusiPendidikan()
	{
		$data['institusi'] = app("App\Http\Controllers\Kepegawaian\MasterPendidikan\ReadController")->getAllInstitusi();
		return view('kepegawaian.master.pendidikan.institusi-pendidikan.index', $data);
	}

	public function edit($id)
	{
		$kualifikasi = app("App\Http\Controllers\Kepegawaian\MasterJabatanIntern\ReadController")->getData()->find($id);
		return response()->json($kualifikasi);
	}
}
