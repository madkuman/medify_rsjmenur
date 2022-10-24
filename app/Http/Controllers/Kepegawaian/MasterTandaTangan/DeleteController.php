<?php

namespace App\Http\Controllers\Kepegawaian\MasterTandaTangan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\TandaTangan;

class DeleteController extends Controller
{
	public function delete($id)
	{
		$tanda_tangan = TandaTangan::find($id);
		$tanda_tangan->delete();
		$data = $this->return(1,'Berhasil menghapus data');
		return $data;
	}

	private function return($status,$message)
	{
		$data['status'] = $status;
		$data['message'] = $message;
		return $data;
	}
}
