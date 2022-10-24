<?php

namespace App\Http\Controllers\Kepegawaian\MasterPangkat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\MasterPangkat;
use Auth;

class EditController extends Controller {

    public function edit($data) {
      
        $pangkat = MasterPangkat::find($data->pangkatid);
        $nama_lama = $pangkat->nama;
        $check_pangkat = MasterPangkat::where('nama',$data['nama'])->whereNotIn('id',[$data['pangkatid']])->get();
        
        if(count($check_pangkat) == 0 )
        {   
            $pangkat->nama          = $data->nama;
            $pangkat->index = $data->index;
            $pangkat->nama_pendek_1 = $data->nama_pendek_1;
            $pangkat->nama_pendek_2 = $data->nama_pendek_2;
            $pangkat->usia_pensiun  = $data->usia;
            $pangkat->strata        = $data->strata;
            $pangkat->strata_order  = $data->strata_order;
            $pangkat->kenkatba      = $data->kenkatba;
            $pangkat->created_by    = Auth::user()->id;

            //$bool = app('App\Http\Controllers\Kepegawaian\Employee\EmployeesController')->updateUserPangkat($nama_lama, $data['nama']);
            
            $pangkat->save();
            $result = $this->return(1,'Berhasil','Berhasil Update data');
            return $result;
        }
        else
        {
            $result = $this->return(0,'Gagal','Kualifikasi tersebut sudah ada');
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
