<?php

namespace App\Http\Controllers\Kepegawaian\MasterStrataPendidikan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\Kepegawaian\MasterStrataPendidikan;

class EditController extends Controller {

    public function edit($data) {
		
		$cek = MasterStrataPendidikan::where('nama',$data->nama)->whereNotIn('id',[$data->strataid])->get();

		if(count($cek) == 0) {

			$gelar = MasterStrataPendidikan::find($data->strataid);
			$gelar->nama              = $data->nama;
            $gelar->pendidikan_jenis_id  = $data->jenis_pendidikan;
			$gelar->save();
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
