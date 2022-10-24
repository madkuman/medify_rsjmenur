<?php

namespace App\Http\Controllers\Kepegawaian\MasterJabatanIntern;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\MasterJabatanIntern;
use Auth;

class CreateController extends Controller {
    
    public function create($nama) {

        $check_nama = MasterJabatanIntern::where('nama',$nama)->get();

        if(count($check_nama) == 0) {

            $kualifikasi = new MasterJabatanIntern;
            $kualifikasi->nama = $nama;
            $kualifikasi->created_by = Auth::user()->id;
            $kualifikasi->save();

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
