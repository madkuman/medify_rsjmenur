<?php

namespace App\Http\Controllers\Kepegawaian\MasterJabatan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\Kepegawaian\MasterJabatan;

class EditController extends Controller {

    public function edit($data) {
		
		$jabatan = MasterJabatan::find($data->jabatanid);

		$cek = MasterJabatan::where('nama',$data->nama)->whereNotIn('id',[$data->jabatanid])->get();

		if(count($cek) == 0) {
			
			$jabatan->nama              = $data->nama;
            $jabatan->jenis_jabatan_id  = $data->jenis_jabatan;
            $jabatan->departemen_id     = $data->departemen;
            $jabatan->gaji              = preg_replace("/[^0-9]/", "", $data->gaji);
            $jabatan->urutan            = $data->urutan;
            $jabatan->created_by    = Auth::user()->id;

			//$bool = app('App\Http\Controllers\Kepegawaian\Employee\EmployeesController')->updateUserIntern($nama_lama, $nama);
			
			$jabatan->save();
			$data = $this->return(1,'Berhasil menambahkan data');
			return $data;

		} else {

			$data = $this->return(0,'Kualifikasi tersebut sudah ada');
			return $data;
		}
	}

	public function editProfilJabatan($data, $id){

        // Create jabatan_pegawai
        $jabatan = JabatanPegawai::find($data->id);

        $jabatan->jabatan_id    = $data->jabatan_id;
        $jabatan->pegawai_id    = $id;
        $jabatan->no_surat      = $data->no_surat;
        $jabatan->tgl_surat     = $data->tgl_surat;
        $jabatan->created_by    = Auth::user()->id;
        $jabatan->save();

        // Update pegawai
        $pegawai = Pegawai::find($id);
        // $pegawai->jabatan_id    = $data->jabatan_id;
        $pegawai->departemen    = $data->departemen; 
        $pegawai->update();

        $result = $this->return(1,'Berhasil!','Berhasil menyimpan data');
		return $result;
    }

	private function return($status,$message) {
		
		$data['status'] = $status;
		$data['message'] = $message;
		return $data;
	}
}
