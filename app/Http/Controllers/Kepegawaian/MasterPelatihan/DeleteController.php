<?php

namespace App\Http\Controllers\Kepegawaian\MasterPelatihan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\MasterPelatihan;
use App\Models\Kepegawaian\Pelatihan;

class DeleteController extends Controller
{
    public function delete($id)
	{
		$pelatihan = MasterPelatihan::find($id);
		$pelatihan->delete();
		$data = $this->return(1,'Berhasil menghapus data');
		
		return $data;
	}

	public function pegawaiDelete($id)
	{
		$item = Pelatihan::find($id);
		$this->checkToAbort($item);
		$return['user_id'] = $item->employee_id;
		$return['ret_delete'] = $item->delete();
		return $return;
	}

	private function return($status,$message)
	{
		$data['status'] = $status;
		$data['message'] = $message;
		return $data;
	}
}
