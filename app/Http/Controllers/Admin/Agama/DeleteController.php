<?php

namespace App\Http\Controllers\Admin\Agama;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pasien\JenisAgama;

class DeleteController extends Controller
{
	public function delete($id)
	{
		$agama = JenisAgama::where('id',$id)->first();
		$agama->delete();
		return;
	}    
}
