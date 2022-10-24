<?php

namespace App\Http\Controllers\Kepegawaian\MasterPenghargaan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\Berkas;
use App\Models\Kepegawaian\MasterPenghargaan;
use App\Models\Kepegawaian\Penghargaan;
use Auth;
use Validator;

class CreateController extends Controller {
    
    public function create($data) {

        $check_nama = MasterPenghargaan::where('nama',$data->nama)->get();
        
        if(count($check_nama) == 0) {
           
            $penghargaan = new MasterPenghargaan;
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

            $data = $this->return(1,'Berhasil','Berhasil Menambahkan Data');
			return $data;

        } else {
    
            $data = $this->return(0,'Gagal', 'Kualifikasi tersebut sudah ada');
			return $data;
        }
    }

    public function pegawaiSave($data, $id) {
    
        $check = Penghargaan::where('pegawai_id',$id)->where('master_penghargaan_id', $data->master_id)->get();
        
        if(count($check) == 0) {
        
            if (empty($data->id_penghargaan)){
                $penghargaan = new Penghargaan;
            } else {
                $penghargaan = Penghargaan::find($data->id_penghargaan);
            }
            
            $penghargaan->pegawai_id                = $id;
            $penghargaan->master_penghargaan_id     = $data->id;
            $penghargaan->created_by                = Auth::user()->id;
            $penghargaan->save();
            
            if($penghargaan){
                $data = $this->return(1,'Berhasil','Berhasil Menambahkan Data');
            } else {
                $data = $this->return(0,'Gagal','Gagal Menambahkan Data');
            }
			return $data;

        } else {
    
            $data = $this->return(0,'Gagal','Kualifikasi tersebut sudah ada');
			return $data;
        }
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

    private function return($status,$title,$message) {

        $data['status'] = $status;
        $data['title'] = $title;
		$data['message'] = $message;
		return $data;
	}
}
