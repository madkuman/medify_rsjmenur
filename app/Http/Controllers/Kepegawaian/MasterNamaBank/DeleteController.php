<?php

namespace App\Http\Controllers\Kepegawaian\MasterNamaBank;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\MasterNamaBank;

class DeleteController extends Controller
{
    public function delete($id)
	{
		$kualifikasi = MasterNamaBank::where('id',$id)->delete();
		return $kualifikasi;
		
	}
}
