<?php

namespace App\Http\Controllers\CSSD\Alkes;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CSSD\Alkes;

class DeleteController extends Controller
{

	public function delete($id)
	{
		$alkes = Alkes::find($id);
		$alkes->delete();
		return $alkes;
	}
}
