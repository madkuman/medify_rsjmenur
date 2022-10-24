<?php

namespace App\Http\Controllers\Kepegawaian\MasterPelatihan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\Berkas;
use App\Models\Kepegawaian\MasterPelatihan;
use Auth;
use Alert;
use App\Models\Kepegawaian\Pelatihan;
use Validator;

class CreateController extends Controller {
    
    public function create($data) {

        $check_nama = MasterPelatihan::where('nama',$data->nama)->get();
        
        if(count($check_nama) == 0) {
    
            $pelatihan = new MasterPelatihan;
            $pelatihan->nama        = $data->nama;
            $pelatihan->tahun       = $data->period;
            $pelatihan->tempat      = $data->place;
            $pelatihan->durasi      = $data->durasi;
            $pelatihan->skor        = $data->skor;
            $pelatihan->created_by  = Auth::user()->id;
            
            if(!empty($data->certificate)){
                $pelatihan->sertifikat = self::uploadFile($data->certificate);
                $pelatihan->save();
    
                $result = $this->return(1,'Berhasil menyimpan data');
                return $result;
            } else {
                $result = $this->return(0,'Gagal Menambahkan Data. File sertifikat tidak boleh kosong');
                return $result;
            }
        }
    }

    public function pegawaiAdd($request, $id)
    {
        $validator = Validator::make(request()->all(), [
            'id'  => 'required'
        ]);
    
        $postdata = $request->toArray();
    
        $new_item = new Pelatihan();
        $new_item->master_pelatihan_id = $postdata['id'];
        $new_item->pegawai_id = $id;
        $new_item->created_by = Auth::user()->id;
        
        if ($validator->fails()) {
            Alert::error('Terdapat ID yang kosong, silahkan ulangi lagi', 'Gagal!');
            return redirect()->route('trainings', ['id' => $id, '_' => microtime(true)]);
        }
        $ret_save = $new_item->save();

        return $ret_save;
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
