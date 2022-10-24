<?php

namespace App\Http\Controllers\Kepegawaian\MasterResikoKerja;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\MasterResikoKerja;
use Auth;

class CreateController extends Controller {
    
    public function simpan($data) {
        if ($data->resikoid > 0) {
            $check_nama = MasterResikoKerja::where('nama',$data->nama)
                        ->where('id', '!=', $data->resikoid)->count();
            $resiko = MasterResikoKerja::find($data->resikoid);
        } else {
            $check_nama = MasterResikoKerja::where('nama',$data->nama)->count();
            $resiko = new MasterResikoKerja;
        }

        if($check_nama == 0) {

            $resiko->nama              = $data->nama;
            $resiko->index             = $data->index;
            $resiko->created_by        = Auth::user()->id;
            $resiko->save();

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
