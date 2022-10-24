<?php

namespace App\Http\Controllers\Kepegawaian\MasterPangkat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\MasterPangkat;
use Auth;

class ViewController extends Controller
{	
	public function index()
	{
		$pangkat = MasterPangkat::all();
		$data['pangkat'] = $pangkat;
		return view('kepegawaian.master.pangkat.index',$data);
	}

	public function indexProfilPangkat($id)
	{
		$pegawai = app("App\Http\Controllers\Kepegawaian\MasterPangkat\ReadController")->getPegawai($id);
		$master_pangkat = app("App\Http\Controllers\Kepegawaian\MasterPangkat\ReadController")->getAllMasterPangkat();
		$items		= app("App\Http\Controllers\Kepegawaian\MasterPangkat\ReadController")->getAllPangkat($id);
		$is_hrd_member 	= app('App\Http\Controllers\Group\Members\ReadController')->checkIfUserActiveInGroup(13,Auth::user()->id);
		
		return view('kepegawaian.pegawai.pangkat.index', compact('master_pangkat', 'items', 'pegawai', 'is_hrd_member'));
	}
}
