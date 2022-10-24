<?php

namespace App\Http\Controllers\Kepegawaian\MasterKualifikasi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\MasterKualifikasi;
use Auth;

class DeleteController extends Controller
{
    public function delete($id)
	{
		$kualifikasi = MasterKualifikasi::where('id',$id)->delete();
		return $kualifikasi;
		
	}
}
