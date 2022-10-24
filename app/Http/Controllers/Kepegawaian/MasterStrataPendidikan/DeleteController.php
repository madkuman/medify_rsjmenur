<?php

namespace App\Http\Controllers\Kepegawaian\MasterStrataPendidikan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\MasterStrataPendidikan;

class DeleteController extends Controller
{
    public function delete($id)
	{
		$strata = MasterStrataPendidikan::find($id);
		$strata->delete();
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
