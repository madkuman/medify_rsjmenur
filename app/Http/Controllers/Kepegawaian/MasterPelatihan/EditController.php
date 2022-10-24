<?php

namespace App\Http\Controllers\Kepegawaian\MasterPelatihan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\Kepegawaian\MasterPelatihan;
use App\Models\Kepegawaian\Pelatihan;
use App\Models\Kepegawaian\Berkas;

class EditController extends Controller {

    public function edit($data) {
	
		$pelatihan = MasterPelatihan::find($data->id);
		

		$cek = MasterPelatihan::where('nama',$data->nama)->whereNotIn('id',[$data->id])->get();

		if(count($cek) == 0) {
			
			$pelatihan->nama        = $data->nama;
			$pelatihan->tahun       = $data->period;
            $pelatihan->tempat      = $data->place;
            $pelatihan->durasi      = $data->durasi;
            $pelatihan->skor        = $data->skor;
            $pelatihan->created_by  = Auth::user()->id;
            
            if(!empty($data->certificate)){
				$pelatihan->sertifikat= self::uploadFile($data->certificate);
			}
           
            $pelatihan->save();
    
            $result = $this->return(1,'Berhasil menyimpan data');
            return $result;
            

		} else {

			$data = $this->return(0,'Kualifikasi tersebut sudah ada');
			return $data;
		}
	}

	public function pegawaiEdit($postdata, $id)
	{
	
		$item = Pelatihan::find($postdata['id']);
		$item->master_pelatihan_id = $postdata['master'];
		$item->created_by = Auth::user()->id;
	
	
	
		$return['ret_update'] = $item->update();
		$return['user_id'] = $item->pegawai_id;
		return $return;
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
		  $destination_path = public_path('/uploads/kepegawaian/pelatihan');
		  $thefile->move($destination_path, $filename);
		  $item->save();
		}
	
		return $item->id;
    }

	private function return($status,$message) {
		
		$data['status'] = $status;
		$data['message'] = $message;
		return $data;
	}
}
