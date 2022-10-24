<?php

namespace App\Http\Controllers\Kepegawaian\MasterPangkat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\MasterPangkat;
use App\Models\Kepegawaian\Pangkat;

class DeleteController extends Controller {
   
    public function delete($id) {   
    
        $pangkat = MasterPangkat::find($id);
        //$bool = app('App\Http\Controllers\Kepegawaian\Employee\EmployeesController')->checkIfUserPangkatNotExist($pangkat->nama);
        
        $pangkat->delete();
        $data = $this->return(1,'Berhasil','Berhasil menghapus data');
       
        return $data;
    }

    public function pegawaiDelete($id) {   
    
        $pangkat = Pangkat::find($id);
        $pangkat->delete();
        $data = $this->return(1,'Berhasil','Berhasil menghapus data');
        return $data;
    }

    private function return($status,$title,$message) {
		$data['status'] = $status;
		$data['title'] = $title;
		$data['message'] = $message;
        return $data;
	}
}
