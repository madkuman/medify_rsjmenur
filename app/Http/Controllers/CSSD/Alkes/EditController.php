<?php

namespace App\Http\Controllers\CSSD\Alkes;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CSSD\Alkes;

class EditController extends Controller
{
	public function edit($data)
	{
		$alkes = Alkes::find($data['id']);
		$alkes->nama = $data['nama'];
		$alkes->batas_efektif = $data['batas_efektif'];
		$alkes->keterangan = $data['keterangan'];
		$alkes->prosedur_sterilisasi = $data['prosedur_sterilisasi'];
		$alkes->save();

		return $alkes;
	}
}
