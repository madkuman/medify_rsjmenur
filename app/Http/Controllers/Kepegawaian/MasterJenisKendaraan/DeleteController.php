<?php

namespace App\Http\Controllers\Kepegawaian\MasterJenisKendaraan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\MasterJenisKendaraan;

class DeleteController extends Controller
{
    public function delete($id)
	{
		$kualifikasi = MasterJenisKendaraan::where('id',$id)->delete();
		return $kualifikasi;
		
	}
}
