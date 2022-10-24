<?php

namespace App\Http\Controllers\Kepegawaian\MasterInstitusiPendidikan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\MasterInstitusiPendidikan;


class ViewController extends Controller
{
    public function index()
	{
		$institusi_pendidikan = MasterInstitusiPendidikan::all();
		$data['institusi'] = $institusi_pendidikan;
		
		return view('kepegawaian.master.institusi-pendidikan.index', $data);
	}
}
