<?php

namespace App\Http\Controllers\Kasus\Penunjang;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Penunjang;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\PenunjangKomentar;

class UpdateController extends Controller
{
	public function update($id,$judul,$caption)
	{
		$penunjang = Penunjang::find($id);
		$penunjang->judul = $judul;
		$penunjang->caption = $caption;
		$penunjang->save();

		return $penunjang;
	}

	public function updateKomentar($id, $new_komentar)
	{
		$komentar = PenunjangKomentar::find($id);
		if(is_null(($komentar)))
			return NULL;
		$komentar->konten = $new_komentar;
		if($komentar->save())
			return TRUE;
		return FALSE;
	}
}