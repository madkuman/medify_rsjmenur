<?php

namespace App\Http\Controllers\KamarOperasi\JenisOperasi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\KamarOperasi\JenisOperasi;


class DeleteController extends Controller
{
	public function delete($id)
	{
		$jenis = JenisOperasi::find($id);
		$jenis->delete();

		return $jenis;
	}
}
