<?php

namespace App\Http\Controllers\Admin\Pekerjaan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pasien\JenisPekerjaan;

class DeleteController extends Controller
{
    public function delete($id)
	{
		$pekerjaan = JenisPekerjaan::where('id',$id)->first();
		$pekerjaan->delete();
		return;
	}
}