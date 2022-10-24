<?php

namespace App\Http\Controllers\Kepegawaian\MasterBebanKerja;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\MasterBebanKerja;
use Auth;

class CreateController extends Controller {
    
    public function simpan($data) {
        if ($data->bebanid > 0) {
            $check_nama = MasterBebanKerja::where('nama',$data->nama)
                        ->where('id', '!=', $data->bebanid)->count();
            $beban = MasterBebanKerja::find($data->bebanid);
        } else {
            $check_nama = MasterBebanKerja::where('nama',$data->nama)->count();
            $beban = new MasterBebanKerja;
        }

        if($check_nama == 0) {

            $beban->nama              = $data->nama;
            $beban->index             = $data->index;
            $beban->created_by        = Auth::user()->id;
            $beban->save();

            $result = $this->return(1,'Berhasil!','Berhasil menyimpan data');
			return $result;
        } else {
            $result = $this->return(0,'Gagal!','Nama jabatan tersebut sudah ada');
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
