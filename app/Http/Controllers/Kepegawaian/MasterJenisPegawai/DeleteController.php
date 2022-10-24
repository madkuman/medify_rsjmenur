<?php

namespace App\Http\Controllers\Kepegawaian\MasterJenisPegawai;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\MasterJenisPegawai;

class DeleteController extends Controller
{
    public function delete($id)
	{
		$kualifikasi = MasterJenisPegawai::where('id',$id)->delete();
		return $kualifikasi;
		
	}
}
