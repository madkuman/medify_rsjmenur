<?php

namespace App\Http\Controllers\KamarOperasi\JenisOperasi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\KamarOperasi\JenisOperasi;


class CreateController extends Controller
{
	public function create($nama)
	{
		$jenis = new JenisOperasi;
		$jenis->nama = $nama;
		$jenis->save();

		return $jenis;
	}
}
