<?php

namespace App\Http\Controllers\Kepegawaian\MasterDepartemen;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\MasterDepartemen;
use Auth;

class CreateController extends Controller {
    
    public function simpanDepartemen($data) {
        if ($data->departemenid > 0) {
            $check_nama = MasterDepartemen::where('nama',$data->nama)
                        ->where('id', '!=', $data->departemenid)->count();
            $departemen = MasterDepartemen::find($data->departemenid);
        } else {
            $check_nama = MasterDepartemen::where('nama',$data->nama)->count();
            $departemen = new MasterDepartemen;
        }

        if($check_nama == 0) {
            $departemen->nama  = $data->nama;
            $departemen->save();
            
            $result = $this->return(1,'Berhasil!','Berhasil menyimpan data');
			return $result;
        } else {
            $result = $this->return(0,'Gagal!','Nama jenis jabatan tersebut sudah ada');
			return $result;
        }
    }

    private function return($status,$title,$message) {
		$data['status'] = $status;
		$data['title'] = $title;
		$data['message'] = $message;
        return $data;
	}
}
