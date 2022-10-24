<?php

namespace App\Http\Controllers\Kepegawaian\MasterGelarPendidikan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\Kepegawaian\MasterGelarPendidikan;

class EditController extends Controller {

    public function edit($data) {
		
		$cek = MasterGelarPendidikan::where('nama',$data->nama)->whereNotIn('id',[$data->gelarid])->get();

		if(count($cek) == 0) {

			$gelar = MasterGelarPendidikan::find($data->gelarid);
			$gelar->nama              = $data->nama;
			$gelar->index = $data->index;
            $gelar->pendidikan_strata_id  = $data->strata_pendidikan;
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
