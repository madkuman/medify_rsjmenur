<?php

namespace App\Http\Controllers\Kepegawaian\MasterPangkat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\MasterPangkat;
use App\Models\Kepegawaian\Pangkat;
use Auth;

class CreateController extends Controller {

    public function create($data) {
        
        $check_nama = MasterPangkat::where('nama',$data->nama)->whereNull('deleted_at')->get();
       
        if(count($check_nama) == 0){   

            $pangkat = new MasterPangkat;
            $pangkat->nama          = $data->nama;
            $pangkat->index = $data->index;
            $pangkat->nama_pendek_1 = $data->nama_pendek_1;
            $pangkat->nama_pendek_2 = $data->nama_pendek_2;
            $pangkat->usia_pensiun  = $data->usia;
            $pangkat->strata        = $data->strata;
            $pangkat->strata_order  = $data->urutan_strata;
            $pangkat->kenkatba      = $data->kenkatba;
            $pangkat->created_by    = Auth::user()->id;
            $pangkat->save();
            
            return $pangkat;
            
        } else {

            $result = $this->return(0,'Gagal','Kualifikasi tersebut sudah ada');
            return $result;

        }
        
    }

    public function pegawaiSave($data, $id) {

        if ($data->id > 0) {
            
            $pangkat = Pangkat::find($data->id);
        } else {
            
            $pangkat = new Pangkat;
        }
            $pangkat->pegawai_id        = $id;
            $pangkat->nama              = $data->pangkat;
            $pangkat->tmt               = $data->tmt;
            $pangkat->korps             = $data->korps;
            $pangkat->salary            = preg_replace("/[^0-9]/", "", $data->gaji);
            $pangkat->supervisor        = $data->supervisor;
            $pangkat->letter_number     = $data->letter_number;
            $pangkat->letter_date       = $data->letter_date;
            $pangkat->created_by        = Auth::user()->id;
            $pangkat->save();

            $result = $this->return(1,'Berhasil','Berhasil menyimpan data');
			return $result;

    }

    private function return($status,$title,$message) {
		$data['status'] = $status;
		$data['title'] = $title;
		$data['message'] = $message;
        return $data;
	}

}
