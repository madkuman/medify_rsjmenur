<?php

namespace App\Http\Controllers\Kepegawaian\MasterStrataPendidikan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\MasterStrataPendidikan;
use App\Models\Kepegawaian\MasterJenisPendidikan;


class ViewController extends Controller
{
    public function index(){

		$strata = MasterStrataPendidikan::with('jenisPendidikan')->get();
		$jenis = MasterJenisPendidikan::all();

		$data['strata'] = $strata;
		$data['jenis'] = $jenis;
		
		return view('kepegawaian.master.strata-pendidikan.index', $data);
	}
}
