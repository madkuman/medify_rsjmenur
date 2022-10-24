<?php

namespace App\Http\Controllers\Kepegawaian\MasterFaskesAsuransi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\MasterFaskesAsuransi;

class DeleteController extends Controller
{
    public function delete($id)
	{
		$kualifikasi = MasterFaskesAsuransi::where('id',$id)->delete();
		return $kualifikasi;
		
	}
}
