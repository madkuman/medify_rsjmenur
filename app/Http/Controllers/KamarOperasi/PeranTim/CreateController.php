<?php

namespace App\Http\Controllers\KamarOperasi\PeranTim;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\KamarOperasi\PeranTim;

class CreateController extends Controller
{
	public function create($nama)
	{
		$peran = new PeranTim;
		$peran->nama = $nama;
		$peran->save();

		return $peran;
	}
}
