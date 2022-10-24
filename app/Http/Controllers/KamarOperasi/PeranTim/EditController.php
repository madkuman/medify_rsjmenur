<?php

namespace App\Http\Controllers\KamarOperasi\PeranTim;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\KamarOperasi\PeranTim;


class EditController extends Controller
{
	public function edit($id,$nama)
	{
		$peran = PeranTim::find($id);
		$peran->nama = $nama;
		$peran->save();

		return $peran;
	}
}
