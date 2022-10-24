<?php

namespace App\Http\Controllers\Kepegawaian\MasterInstitusiPendidikan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\MasterInstitusiPendidikan;
class DeleteController extends Controller
{
    public function delete($id)
	{
		$institusi_pendidikan = MasterInstitusiPendidikan::find($id);
		//$bool = app('App\Http\Controllers\Kepegawaian\Employee\EmployeesController')->checkIfUserInternNotExist($jabatan->nama);
		
		//if($bool) {

			$institusi_pendidikan->delete();
			$data = $this->return(1,'Berhasil menghapus data');

		//} else {

			//$data = $this->return(0,'Masih ada pegawai yang menggunakan jabatan tersebut. Silahkan ubah kualifikasi pegawai terlebih dahulu.');
		//}
		
		return $data;
	}

	private function return($status,$message)
	{
		$data['status'] = $status;
		$data['message'] = $message;
		return $data;
	}
}
