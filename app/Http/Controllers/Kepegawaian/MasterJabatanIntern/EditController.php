<?php

namespace App\Http\Controllers\Kepegawaian\MasterJabatanIntern;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\Kepegawaian\MasterJabatanIntern;

class EditController extends Controller {

    public function edit($id, $nama) {
		
		$intern = MasterJabatanIntern::find($id);
		$nama_lama = $intern->nama;
		//$bool = app('App\Http\Controllers\Kepegawaian\Employee\EmployeesController')->checkIfUserUseKualifikasiNotExist($kualifikasi->nama);

		$cek = MasterJabatanIntern::where('nama',$nama)->get();

		if(count($cek) == 0) {

			$intern->nama = $nama;
			$intern->created_by = Auth::user()->id;

			$bool = app('App\Http\Controllers\Kepegawaian\Employee\EmployeesController')->updateUserIntern($nama_lama, $nama);
			
			$intern->save();
			$data = $this->return(1,'Berhasil menambahkan data');
			return $data;

		} else {

			$data = $this->return(0,'Kualifikasi tersebut sudah ada');
			return $data;
		}
	}

	private function return($status,$message) {
		
		$data['status'] = $status;
		$data['message'] = $message;
		return $data;
	}
}
