<?php

namespace App\Http\Controllers\Kepegawaian\MasterBebanKerja;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\MasterBebanKerja;

class DeleteController extends Controller
{
    public function hapus($id)
	{
		$beban = MasterBebanKerja::find($id);
		$beban->delete();
		$result = $this->return(1,'Berhasil!','Berhasil menghapus data');
		
		return $result;
	}

	private function return($status,$title,$message)
	{
		$data['status'] = $status;
		$data['title'] = $title;
		$data['message'] = $message;
		return $data;
	}
}
