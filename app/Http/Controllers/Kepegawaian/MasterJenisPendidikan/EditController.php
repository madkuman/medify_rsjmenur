<?php

namespace App\Http\Controllers\Kepegawaian\MasterJenisPendidikan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\Kepegawaian\MasterJenisPendidikan;

class EditController extends Controller {

    public function edit($data) {
		
		$jenis_pendidikan = MasterJenisPendidikan::find($data->jenisid);
		
		$cek = MasterJenisPendidikan::where('nama',$data->nama)->whereNotIn('id',[$data->jenisid])->get();

		if(count($cek) == 0) {
			
			$jenis_pendidikan->nama              = $data->nama;
			
			$jenis_pendidikan->save();
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
