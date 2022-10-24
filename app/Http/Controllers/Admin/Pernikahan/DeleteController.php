<?php

namespace App\Http\Controllers\Admin\Pernikahan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pasien\JenisPernikahan;

class DeleteController extends Controller
{
    public function delete($id)
	{
		$pernikahan = JenisPernikahan::where('id',$id)->first();
		$pernikahan->delete();
		return;
	}
}