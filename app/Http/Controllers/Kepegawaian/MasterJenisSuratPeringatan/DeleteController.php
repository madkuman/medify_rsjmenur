<?php

namespace App\Http\Controllers\Kepegawaian\MasterJenisSuratPeringatan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\MasterJenisSuratPeringatan;


class DeleteController extends Controller
{
    public function delete($id)
	{
		$kualifikasi = MasterJenisSuratPeringatan::where('id',$id)->delete();
		return $kualifikasi;
		
	}
}
