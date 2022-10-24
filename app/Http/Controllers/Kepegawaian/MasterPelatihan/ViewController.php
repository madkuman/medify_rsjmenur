<?php

namespace App\Http\Controllers\Kepegawaian\MasterPelatihan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\MasterPelatihan;


class ViewController extends Controller
{
    public function index()
	{
		$pelatihan = MasterPelatihan::with('berkas')->get();
		$data['pelatihan'] = $pelatihan;
		
		return view('kepegawaian.master.pelatihan.index', $data);
	}
}
