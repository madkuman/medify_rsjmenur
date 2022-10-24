<?php

namespace App\Http\Controllers\Kepegawaian\MasterStatusRumah;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\MasterStatusRumah;

class DeleteController extends Controller
{
    public function delete($id)
	{
		$kualifikasi = MasterStatusRumah::where('id',$id)->delete();
		return $kualifikasi;
		
	}
}
