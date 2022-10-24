<?php

namespace App\Http\Controllers\Kepegawaian\MasterDepartemen;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\MasterDepartemen;
class DeleteController extends Controller
{
    public function hapusDepartemen($departemen_id)
	{
		$departemen = MasterDepartemen::find($departemen_id);
		
		$departemen->delete();
	
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
