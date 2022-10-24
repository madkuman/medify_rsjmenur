<?php

namespace App\Http\Controllers\Kepegawaian\MasterInstitusiPendidikan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\MasterInstitusiPendidikan;
use Auth;

class CreateController extends Controller {
    
    public function create($data) {

        $check_nama = MasterInstitusiPendidikan::where('nama',$data->nama)->get();
        
        if(count($check_nama) == 0) {
           
            $institusi_pendidikan = new MasterInstitusiPendidikan;
            $institusi_pendidikan->nama  = $data->nama;
            $institusi_pendidikan->save();
            
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
