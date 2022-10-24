<?php

namespace App\Http\Controllers\KamarOperasi\PeranTim;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\KamarOperasi\PeranTim;


class DeleteController extends Controller
{
    	public function delete($id)
	{
		$peran = PeranTim::find($id);
		$peran->delete();

		return $peran;
	}
}
