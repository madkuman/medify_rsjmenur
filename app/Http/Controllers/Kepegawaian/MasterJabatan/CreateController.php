<?php

namespace App\Http\Controllers\Kepegawaian\MasterJabatan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\MasterJenisJabatan;
use App\Models\Kepegawaian\MasterJabatan;
use App\Models\Kepegawaian\Jabatan;
use App\Models\Kepegawaian\Pegawai;
use Auth;

class CreateController extends Controller {
    
    public function simpanJabatan($data) {
        if ($data->jabatanid > 0) {
            $check_nama = MasterJabatan::where('nama',$data->nama)
                        ->where('id', '!=', $data->jabatanid)->count();
            $jabatan = MasterJabatan::find($data->jabatanid);
        } else {
            $check_nama = MasterJabatan::where('nama',$data->nama)->count();
            $jabatan = new MasterJabatan;
        }

        if($check_nama == 0) {

            $jabatan->nama              = $data->nama;
            $jabatan->index = $data->index;
            $jabatan->jenis_jabatan_id  = $data->jenis_jabatan;
            $jabatan->departemen_id     = $data->departemen;
            $jabatan->parent_id     = $data->parent_id;
            $jabatan->gaji              = preg_replace("/[^0-9]/", "", $data->gaji);
            $jabatan->urutan            = $data->urutan;
            $jabatan->created_by        = Auth::user()->id;
            $jabatan->save();

            $result = $this->return(1,'Berhasil!','Berhasil menyimpan data');
			return $result;
        } else {
            $result = $this->return(0,'Gagal!','Nama jabatan tersebut sudah ada');
			return $result;
        }
    }
    
    public function simpanJenisJabatan($data) {
        if ($data->jenisjabatanid > 0) {
            $check_nama = MasterJenisJabatan::where('nama',$data->nama)
                        ->where('id', '!=', $data->jenisjabatanid)->count();
            $jenis_jabatan = MasterJenisJabatan::find($data->jenisjabatanid);
        } else {
            $check_nama = MasterJenisJabatan::where('nama',$data->nama)->count();
            $jenis_jabatan = new MasterJenisJabatan;
        }

        if($check_nama == 0) {
            $jenis_jabatan->nama  = $data->nama;
            $jenis_jabatan->save();
            
            $result = $this->return(1,'Berhasil!','Berhasil menyimpan data');
			return $result;
        } else {
            $result = $this->return(0,'Gagal!','Nama jenis jabatan tersebut sudah ada');
			return $result;
        }
    }

    public function pegawaiSave($data, $id){

        if ($data->id > 0) {
         
            $jabatan = Jabatan::find($data->id);
        } else {
            $jabatan = new Jabatan;
        }

        // Create jabatan_pegawai
        //$jabatan->departemen_id = $data->departemen_id;
        $jabatan->jabatan_id    = $data->jabatan_id;
        $jabatan->pegawai_id    = $id;
        $jabatan->no_surat      = $data->no_surat;
        $jabatan->tgl_surat     = $data->tgl_surat;
        $jabatan->created_by    = Auth::user()->id;
        $jabatan->save();

        $result = $this->return(1,'Berhasil!','Berhasil menyimpan data');
		return $result;
    }

    private function return($status,$title,$message) {
		$data['status'] = $status;
		$data['title'] = $title;
		$data['message'] = $message;
        return $data;
	}
}
