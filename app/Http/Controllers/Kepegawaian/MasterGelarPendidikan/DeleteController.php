<?php

namespace App\Http\Controllers\Kepegawaian\MasterGelarPendidikan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\MasterGelarPendidikan;

class DeleteController extends Controller
{
    public function delete($id)
	{
		$gelar = MasterGelarPendidikan::find($id);
		$gelar->delete();
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
