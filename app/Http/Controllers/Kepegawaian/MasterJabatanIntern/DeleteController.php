<?php

namespace App\Http\Controllers\Kepegawaian\MasterJabatanIntern;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\MasterJabatanIntern;
class DeleteController extends Controller
{
    public function delete($id)
	{
		$intern = MasterJabatanIntern::find($id);
		$bool = app('App\Http\Controllers\Kepegawaian\Employee\EmployeesController')->checkIfUserInternNotExist($intern->nama);
		
		if($bool) {

			$intern->delete();
			$data = $this->return(1,'Berhasil menghapus data');

		} else {

			$data = $this->return(0,'Masih ada pegawai yang menggunakan jabatan intern tersebut. Silahkan ubah kualifikasi pegawai terlebih dahulu.');
		}
		
		return $data;
	}

	private function return($status,$message)
	{
		$data['status'] = $status;
		$data['message'] = $message;
		return $data;
	}
}
