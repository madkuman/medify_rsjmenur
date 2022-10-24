<?php

namespace App\Http\Controllers\Kepegawaian\MasterDepartemen;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\Kepegawaian\MasterJabatan;

class EditController extends Controller {

    public function edit($data) {
		
		$jabatan = MasterJabatan::find($data->jabatanid);
		
		//$bool = app('App\Http\Controllers\Kepegawaian\Employee\EmployeesController')->checkIfUserUseKualifikasiNotExist($kualifikasi->nama);

		$cek = MasterJabatan::where('nama',$data->nama)->whereNotIn('id',[$data->jabatanid])->get();

		if(count($cek) == 0) {
			
			$jabatan->nama              = $data->nama;
            $jabatan->jenis_jabatan_id  = $data->jenis_jabatan;
            $jabatan->departemen_id     = $data->departement;
            $jabatan->gaji              = preg_replace("/[^0-9]/", "", $data->gaji);
            $jabatan->urutan            = $data->urutan;
            $jabatan->created_by    = Auth::user()->id;

			//$bool = app('App\Http\Controllers\Kepegawaian\Employee\EmployeesController')->updateUserIntern($nama_lama, $nama);
			
			$jabatan->save();
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
