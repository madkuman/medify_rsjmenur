<?php

namespace App\Http\Controllers\Kepegawaian\MasterStatusPegawai;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\MasterStatusPegawai;

class DeleteController extends Controller
{
    public function delete($id)
	{
		$kualifikasi = MasterStatusPegawai::where('id',$id)->delete();
		return $kualifikasi;
		
	}
}
