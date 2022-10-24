<?php

namespace App\Http\Controllers\Kepegawaian\MasterPendidikan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\Pendidikan;
use App\Models\Kepegawaian\MasterGelarPendidikan;
use App\Models\Kepegawaian\MasterStrataPendidikan;
use App\Models\Kepegawaian\MasterJenisPendidikan;
use App\Models\Kepegawaian\MasterInstitusiPendidikan;


class DeleteController extends Controller {

    public function hapusGelar($id)
	{
		$gelar = MasterGelarPendidikan::find($id);

		$gelar->delete();
		$result = $this->return(1,'Berhasil!','Berhasil menghapus data');
		
		return $result;
	}

	public function hapusInstitusi($id)
	{
		$institusi = MasterInstitusiPendidikan::find($id);

		$institusi->delete();
		$result = $this->return(1,'Berhasil!','Berhasil menghapus data');
		
		return $result;
	}

	public function hapusStrata($id)
	{
		$strata = MasterStrataPendidikan::find($id);

		$strata_used = app('App\Http\Controllers\Kepegawaian\MasterPendidikan\ReadController')->checkDataGelar($id);
		
		if($strata_used) {

			$strata->delete();
			$result = $this->return(1,'Berhasil!','Berhasil menghapus data');
		} else {
			$result = $this->return(0,'Gagal!','Masih ada jabatan yang menggunakan jenis jabatan tersebut. Silahkan ubah data jabatan terlebih dahulu.');
		}
		
		return $result;
	}

	public function hapusJenisPendidikan($id)
	{
		$jenis = MasterJenisPendidikan::find($id);

		$jenis_used = app('App\Http\Controllers\Kepegawaian\MasterPendidikan\ReadController')->checkDataStrata($id);
		
		if($jenis_used) {
			
			$jenis->delete();
			$result = $this->return(1,'Berhasil!','Berhasil menghapus data');
		} else {
			$result = $this->return(0,'Gagal!','Masih ada jabatan yang menggunakan jenis jabatan tersebut. Silahkan ubah data jabatan terlebih dahulu.');
		}
		
		return $result;
	}

	public function pegawaiDelete($id)
	{
		$pendidikan = Pendidikan::find($id);
		
		$pendidikan->delete();
		$result = $this->return(1,'Berhasil!','Berhasil menghapus data');
	
		return $result;
	}



	private function return($status,$title,$message)
	{
		$data['status'] = $status;
		$data['title'] = $title;
		$data['message'] = $message;
		return $data;
	}
}
