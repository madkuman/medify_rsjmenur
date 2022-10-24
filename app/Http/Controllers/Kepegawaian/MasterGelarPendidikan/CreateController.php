<?php

namespace App\Http\Controllers\Kepegawaian\MasterGelarPendidikan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\MasterGelarPendidikan;
use Auth;

class CreateController extends Controller {
    
    public function create($data) {

        $check_nama = MasterGelarPendidikan::where('nama',$data->nama)->get();

        if(count($check_nama) == 0) {
        
            $gelar = new MasterGelarPendidikan;
            $gelar->nama              = $data->nama;
            $gelar->index = $data->index;
            $gelar->pendidikan_strata_id  = $data->strata_pendidikan;
            $gelar->save();

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
