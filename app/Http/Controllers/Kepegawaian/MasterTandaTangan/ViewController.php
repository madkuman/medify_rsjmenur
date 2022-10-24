<?php

namespace App\Http\Controllers\Kepegawaian\MasterTandaTangan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\TandaTangan;

class ViewController extends Controller
{
	public function index()
	{
		$tanda_tangan = TandaTangan::all();
		$data['tanda_tangan'] = $tanda_tangan;
		return view('kepegawaian.master.tanda-tangan.index',$data);
	}

	public function baru()
	{
		$data["title"] = "Tambah Tanda Tangan Baru";
		return view('kepegawaian.master.tanda-tangan.form',$data);
	}

	public function edit($id)
	{
		$tanda_tangan = TandaTangan::find($id);
		$tanda_tangan->title="Edit Tanda Tangan";
		return view('kepegawaian.master.tanda-tangan.form',$tanda_tangan);
	}
}
