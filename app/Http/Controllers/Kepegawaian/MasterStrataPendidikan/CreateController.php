<?php

namespace App\Http\Controllers\Kepegawaian\MasterStrataPendidikan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\MasterStrataPendidikan;
use Auth;

class CreateController extends Controller {
    
    public function create($data) {

        $check_nama = MasterStrataPendidikan::where('nama',$data->nama)->get();

        if(count($check_nama) == 0) {
        
            $strata = new MasterStrataPendidikan;
            $strata->nama              = $data->nama;
            $strata->pendidikan_jenis_id  = $data->jenis_pendidikan;
            $strata->save();

            $data = $this->return(1,'Berhasil Menambahkan Data');
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
