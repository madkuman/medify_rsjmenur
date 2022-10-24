<?php

namespace App\Http\Controllers\Kepegawaian\MasterGelarPendidikan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\MasterGelarPendidikan;
use App\Models\Kepegawaian\MasterStrataPendidikan;


class ViewController extends Controller
{
    public function index(){

		$gelar = MasterGelarPendidikan::with('strata_pendidikan')->get();
		$strata = MasterStrataPendidikan::all();
		$data['gelar'] = $gelar;
		$data['strata'] = $strata;
		
		return view('kepegawaian.master.gelar-pendidikan.index', $data);
	}
}
