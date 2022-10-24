<?php

namespace App\Http\Controllers\Kepegawaian\MasterPendidikan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\Kepegawaian\Pendidikan;
use App\Models\Kepegawaian\Berkas;

use Carbon\Carbon;

class EditController extends Controller {

    public function pegawaiUpdate($data, $id) {
		
		$pendidikan = Pendidikan::find($data->id);

		$pendidikan->nama                  = $data->nama;
        $pendidikan->jenis_pendidikan_id      = $data->jenis;
        $pendidikan->strata_pendidikan_id     = $data->strata;
        $pendidikan->institusi_pendidikan_id  = $data->institusi;
        $pendidikan->tgl_masuk             = $data->tgl_masuk;
		$pendidikan->tgl_lulus             = $data->tgl_lulus;

		if(!empty($data->certificate)){
            $pendidikan->certificate = self::uploadFile($data->certificate);
		}
		
		$pendidikan->save();

		$data = $this->return(1,'Berhasil','Berhasil mengubah data');
		return $data;

		
	}

	public function pegawaiVerifikasi($request) {
		$id = $request->id;
		$pendidikan = Pendidikan::find($id);
		
		$pendidikan->status 			= 1;
		$pendidikan->verificator		= Auth::user()->id;
		$pendidikan->verified_at		= Carbon::now();
		//Image
		if(!empty($request->verification_file)){
			$pendidikan->verification_file = self::uploadFile($request->verification_file);
			$pendidikan->update();

			//$update_pendidikan = app('App\Http\Controllers\Kepegawaian\Employee\EmployeesController')->updatePendidikan($data->id);
		

			$data = $this->return(1,'Berhasil!','Berhasil Verifikasi Data');
			return $data;

		} else {
			$data = $this->return(-1,'Gagal!','Gagal Verifikasi Data. Surat tidak boleh kosong');
			return $data;
		}
	}

	private function return($status,$title,$message) {
		
		$data['status'] = $status;
		$data['title'] = $title;
		$data['message'] = $message;
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
		  $destination_path = public_path('/uploads/kepegawaian/pendidikan');
		  $thefile->move($destination_path, $filename);
		  $item->save();
		}
	
		return $item->id;
	  }
}
