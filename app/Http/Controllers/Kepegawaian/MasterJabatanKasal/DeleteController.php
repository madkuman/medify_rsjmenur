<?php

namespace App\Http\Controllers\Kepegawaian\MasterJabatanKasal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\MasterJabatanKasal;

class DeleteController extends Controller
{
	public function delete($id)
	{
		$jabatan_kasal = MasterJabatanKasal::find($id);
		$bool = app('App\Http\Controllers\Kepegawaian\Employee\EmployeesController')->checkIfUserUseJabatanKasalNotExist($jabatan_kasal->nama);
		if($bool)
		{
			$jabatan_kasal->delete();
			$data = $this->return(1,'Berhasil menghapus data');
		}
		else{
			$data = $this->return(0,'Masih ada pegawai yang menggunakan Jabatan Kasal tersebut. Silahkan ubah Jabatan Kasal pegawai terlebih dahulu.');
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
