<?php

namespace App\Http\Controllers\Keuangan\BukuKas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Keuangan\BukuKas;

class DeleteController extends Controller
{
	public function delete($id)
	{
		$bk = BukuKas::find($id);
		$bk->delete();
		return $bk;
	}
}
