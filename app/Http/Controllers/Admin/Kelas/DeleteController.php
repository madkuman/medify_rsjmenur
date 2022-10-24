<?php

namespace App\Http\Controllers\Admin\Kelas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hospital\Kelas;

class DeleteController extends Controller
{
    public function delete($id)
	{
		$kelas = Kelas::where('id',$id)->first();
		$kelas->delete();
		return;
	}
}
