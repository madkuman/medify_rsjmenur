<?php

namespace App\Http\Controllers\Kepegawaian\MasterSubkualifikasi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\MasterSubkualifikasi;
class DeleteController extends Controller
{
    public function delete($id)
	{
		$kualifikasi = MasterSubkualifikasi::where('id',$id)->delete();
		return $kualifikasi;
	}
}
