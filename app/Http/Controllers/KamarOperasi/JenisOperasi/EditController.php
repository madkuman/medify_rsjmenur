<?php

namespace App\Http\Controllers\KamarOperasi\JenisOperasi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\KamarOperasi\JenisOperasi;


class EditController extends Controller
{
	public function edit($id,$nama)
	{
		$jenis = JenisOperasi::find($id);
		$jenis->nama = $nama;
		$jenis->save();

		return $jenis;
	}
}
