<?php

namespace App\Http\Controllers\Admin\Identitas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pasien\JenisKartuIdentitas;

class DeleteController extends Controller
{
    public function delete($id)
	{
		$identitas = JenisKartuIdentitas::where('id',$id)->first();
		$identitas->delete();
		return;
	}
}