<?php

namespace App\Http\Controllers\Kepegawaian\MasterJabatan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\MasterJenisJabatan;
use App\Models\Kepegawaian\MasterJabatan;
use App\Models\Kepegawaian\Jabatan;

class DeleteController extends Controller
{
    public function hapusJabatan($jabatan_id)
	{
		$jabatan = MasterJabatan::find($jabatan_id);
		$jabatan_used = app('App\Http\Controllers\Kepegawaian\Pegawai\ReadController')->checkDataJabatan($jabatan_id);
		
		if($jabatan_used) {
			$jabatan->delete();
			$result = $this->return(1,'Berhasil!','Berhasil menghapus data');
		} else {
			$result = $this->return(0,'Gagal!','Masih ada pegawai yang menggunakan jabatan tersebut. Silahkan ubah data pegawai terlebih dahulu.');
		}
		
		return $result;
	}

	public function hapusJenisJabatan($jenis_jabatan_id)
	{
		$jabatan = MasterJenisJabatan::find($jenis_jabatan_id);
		$jabatan_used = app('App\Http\Controllers\Kepegawaian\MasterJabatan\ReadController')->checkDataJenisJabatan($jenis_jabatan_id);
		
		if($jabatan_used) {
			$jabatan->delete();
			$result = $this->return(1,'Berhasil!','Berhasil menghapus data');
		} else {
			$result = $this->return(0,'Gagal!','Masih ada jabatan yang menggunakan jenis jabatan tersebut. Silahkan ubah data jabatan terlebih dahulu.');
		}
		
		return $result;
	}

	public function pegawaiDelete($id)
	{
		$jabatan = Jabatan::find($id);
		
		$jabatan->delete();
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
