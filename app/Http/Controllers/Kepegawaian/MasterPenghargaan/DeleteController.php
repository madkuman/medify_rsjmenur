<?php

namespace App\Http\Controllers\Kepegawaian\MasterPenghargaan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\MasterPenghargaan;
use App\Models\Kepegawaian\Penghargaan;
class DeleteController extends Controller
{
    public function delete($id)
	{
		$penghargaan = MasterPenghargaan::find($id);
		//$bool = app('App\Http\Controllers\Kepegawaian\Employee\EmployeesController')->checkIfUserInternNotExist($jabatan->nama);
		
		//if($bool) {

			$penghargaan->delete();
			$data = $this->return(1,'Berhasil','Berhasil menghapus data');

		//} else {

		//	$data = $this->return(0,'Masih ada pegawai yang menggunakan jabatan tersebut. Silahkan ubah kualifikasi pegawai terlebih dahulu.');
		//}
		
		return $data;
	}

	public function pegawaiDelete($id){
		
		$penghargaan = Penghargaan::find($id);
		$penghargaan->delete();

		$data = $this->return(1,'Berhasil','Berhasil menghapus data');
	}

	private function return($status,$title,$message)
	{
		$data['status'] = $status;
		$data['title'] = $title;
		$data['message'] = $message;
		return $data;
	}
}
