<?php

namespace App\Http\Controllers\Kasus\Penunjang;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Penunjang;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\PenunjangKomentar;

class DeleteController extends Controller
{
	public function delete($id)
	{
		$penunjang = Penunjang::find($id);
		if(!empty($penunjang->id))
		{
			$penunjang->delete();
			return TRUE;
		}
		return FALSE;
	}

	public function deleteKomentar($id)
	{
		$komentar = PenunjangKomentar::find($id);
		if(is_null(($komentar)))
			return NULL;
		if($komentar->delete())
			return TRUE;
		return FALSE; 
	}
}