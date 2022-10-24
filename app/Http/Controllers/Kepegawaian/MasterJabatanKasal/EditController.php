<?php

namespace App\Http\Controllers\Kepegawaian\MasterJabatanKasal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\MasterJabatanKasal;
use Auth;

class EditController extends Controller
{
	public function edit($id, $nama,$order)
	{
		if($nama == '') 
		{
			$data = $this->return(0,'Nama Jabatan Kasal Kosong');
			return $data;
		}
		$jabatan_kasal = MasterJabatanKasal::find($id);
		$nama_lama = $jabatan_kasal->nama;
		
		if($this->checkIfNotExist($nama))
		{
			$jabatan_kasal->nama = $nama;
			$jabatan_kasal->order = $order;
			$jabatan_kasal->created_by = Auth::user()->id;

			$bool = app('App\Http\Controllers\Kepegawaian\Employee\EmployeesController')->updateUserJabatanKasal($nama_lama, $nama,$order);
			
			$jabatan_kasal->save();
			$data = $this->return(1,'Berhasil mengubah data');
			return $data;
		}
		else
		{
			$data = $this->return(0,'Jabatan Kasal tersebut sudah ada');
			return $data;
		}
	}
	private function checkIfNotExist($nama)
	{
		$jabatan_kasal = MasterJabatanKasal::where('nama',$nama)->get();
		if(count($jabatan_kasal) > 0) return false;
		else return true;
	}

	private function return($status,$message)
	{
		$data['status'] = $status;
		$data['message'] = $message;
		return $data;
	}
}
