<?php

namespace App\Http\Controllers\Kepegawaian\MasterJabatan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class ViewController extends Controller
{
	public function index()
	{
		return view('kepegawaian.master.jabatan.index');
	}

    public function jabatan(){
		$data['jabatan'] = app("App\Http\Controllers\Kepegawaian\MasterJabatan\ReadController")->getAllJabatan();
		$data['jenis'] = app("App\Http\Controllers\Kepegawaian\MasterJabatan\ReadController")->getAllJenisJabatan();
		$data['departemen'] = app("App\Http\Controllers\Kepegawaian\MasterDepartemen\ReadController")->getAllDepartemen();
		return view('kepegawaian.master.jabatan.jabatan', $data);
	}
	
	public function jenisJabatan(){
		$data['jenis'] = app("App\Http\Controllers\Kepegawaian\MasterJabatan\ReadController")->getAllJenisJabatan();
		return view('kepegawaian.master.jabatan.jenis-jabatan', $data);
	}

	// Profil
	public function profilJabatan($id){

		$pegawai 			= app("App\Http\Controllers\Kepegawaian\MasterJabatan\ReadController")->getPegawai($id);
		$master_departemen 	= app("App\Http\Controllers\Kepegawaian\MasterJabatan\ReadController")->getAllMasterDepartemen();
		$master_jabatan 	= app("App\Http\Controllers\Kepegawaian\MasterJabatan\ReadController")->getAllMasterJabatan();
		$items				= app("App\Http\Controllers\Kepegawaian\MasterJabatan\ReadController")->getProfilJabatan($id);
		$is_hrd_member 		= app('App\Http\Controllers\Group\Members\ReadController')->checkIfUserActiveInGroup(13,Auth::user()->id);
		
		return view('kepegawaian.pegawai.jabatan.index', compact('master_jabatan', 'master_departemen', 'items', 'pegawai', 'is_hrd_member'));
	}

	public function edit($id)
	{
		$kualifikasi = app("App\Http\Controllers\Kepegawaian\MasterJabatanIntern\ReadController")->getData()->find($id);
		return response()->json($kualifikasi);
	}
}
