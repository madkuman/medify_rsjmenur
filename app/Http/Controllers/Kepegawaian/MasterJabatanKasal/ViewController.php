<?php

namespace App\Http\Controllers\Kepegawaian\MasterJabatanKasal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\MasterJabatanKasal;

class ViewController extends Controller
{
	public function index()
	{
		$jabatan_kasal = MasterJabatanKasal::all();
		$data['jabatan_kasal'] = $jabatan_kasal;
		return view('kepegawaian.master.jabatan-kasal.index',$data);
	}

	public function baru()
	{
		$data["title"] = "Tambah Jabatan Kasal Baru";
		return view('kepegawaian.master.jabatan-kasal.form',$data);
	}

	public function edit($id)
	{
		$jabatan_kasal = MasterJabatanKasal::find($id);
		$jabatan_kasal->title="Edit Jabatan Kasal";
		return view('kepegawaian.master.jabatan-kasal.form',$jabatan_kasal);
	}
}
