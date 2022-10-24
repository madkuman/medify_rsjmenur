<?php

namespace App\Http\Controllers\Kepegawaian\MasterInstitusiPendidikan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\Kepegawaian\MasterInstitusiPendidikan;

class EditController extends Controller {

    public function edit($data) {
		
		$institusi_pendidikan = MasterInstitusiPendidikan::find($data->institusiid);
		
		$cek = MasterInstitusiPendidikan::where('nama',$data->nama)->whereNotIn('id',[$data->institusiid])->get();

		if(count($cek) == 0) {
			
			$institusi_pendidikan->nama              = $data->nama;
			
			$institusi_pendidikan->save();
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
