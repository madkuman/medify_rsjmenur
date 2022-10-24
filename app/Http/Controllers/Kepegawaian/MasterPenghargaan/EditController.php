<?php

namespace App\Http\Controllers\Kepegawaian\MasterPenghargaan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\Kepegawaian\MasterPenghargaan;
use App\Models\Kepegawaian\Penghargaan;
use App\Models\Kepegawaian\Berkas;

class EditController extends Controller {

    public function edit($data) {
		
		$penghargaan = MasterPenghargaan::find($data->id);
        
            $penghargaan->nama                = $data->nama;
            $penghargaan->tgl_terbit          = $data->tmt;
            $penghargaan->st_number           = $data->st_number;
            $penghargaan->status              = $data->status;
            $penghargaan->pemberi             = $data->pemberi;

            if(!empty($data->sertifikat)){
                $penghargaan->sertifikat = self::uploadFile($data->sertifikat);
            }
            $penghargaan->created_by          = Auth::user()->id;
            $penghargaan->save();

            $data = $this->return(1,'Berhasil','Berhasil Update Data');
			return $data;
	}

	public function pegawaiVerifikasi($data) {
		
		$penghargaan = Penghargaan::find($data->id);
		
		$penghargaan->status              = 1;
        $penghargaan->verificator         = Auth::user()->id;
        $penghargaan->save();

		$data = $this->return(1,'Berhasil','Berhasil Verifikasi Data');
		return $data;
	}

	private function uploadFile($thefile){
       
		$item = new Berkas();
		$item->filename = $thefile->getClientOriginalName();
		$item->mime = $thefile->getClientMimeType();
		$item->path = hash('sha256', time());
		$item->size = $thefile->getClientSize();
		$item->extension = $thefile->getClientOriginalExtension();
		$item->save();
	
		if($thefile) {
		  $filename = (string)$item->id.'.'.$thefile->getClientOriginalExtension();
		  $destination_path = public_path('/uploads/kepegawaian/penghargaan');
		  $thefile->move($destination_path, $filename);
		  $item->save();
		}
		return $item->id;
	}


	private function return($status, $title, $message) {
		
		$data['status'] = $status;
		$data['title'] = $title;
		$data['message'] = $message;
		return $data;
	}
}
