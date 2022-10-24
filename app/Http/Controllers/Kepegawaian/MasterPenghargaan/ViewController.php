<?php

namespace App\Http\Controllers\Kepegawaian\MasterPenghargaan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\MasterPenghargaan;


class ViewController extends Controller
{
    public function index()
	{
		$penghargaan = MasterPenghargaan::all();
		$data['penghargaan'] = $penghargaan;
		
		return view('kepegawaian.master.penghargaan.index', $data);
	}
}
