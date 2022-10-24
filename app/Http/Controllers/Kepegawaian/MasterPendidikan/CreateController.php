<?php

namespace App\Http\Controllers\Kepegawaian\MasterPendidikan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\Pendidikan;
use App\Models\Kepegawaian\MasterGelarPendidikan;
use App\Models\Kepegawaian\MasterStrataPendidikan;
use App\Models\Kepegawaian\MasterJenisPendidikan;
use App\Models\Kepegawaian\MasterInstitusiPendidikan;

use App\Models\Kepegawaian\Berkas;
use Auth;

class CreateController extends Controller {
    
    public function simpanGelar($data) {
        if ($data->gelarid > 0) {
            $check_nama = MasterGelarPendidikan::where('nama',$data->nama)
                        ->whereNull('deleted_at')
                        ->whereNotIn('id',[$data->gelarid])
                        ->count();
            $gelar = MasterGelarPendidikan::find($data->gelarid);
        } else {
            $check_nama = MasterGelarPendidikan::where('nama',$data->nama)
                        ->whereNull('deleted_at')
                        ->count();
            $gelar = new MasterGelarPendidikan;
        }

        if($check_nama == 0) {

            $gelar->nama                    = $data->nama;
            $gelar->pendidikan_strata_id    = $data->strata_pendidikan;
            $gelar->created_by              = Auth::user()->id;
            $gelar->save();

            $result = $this->return(1,'Berhasil!','Berhasil menyimpan data');
			return $result;
        } else {
            $result = $this->return(0,'Gagal!','Nama jabatan tersebut sudah ada');
			return $result;
        }
    }
    
    public function simpanJenisPendidikan($data) {
        if ($data->jenispendidikanid > 0) {
            $check_nama = MasterJenisPendidikan::where('nama',$data->nama)
                        ->where('id', '!=', $data->jenispendidikanid)->count();
            $jenis_pendidikan = MasterJenisPendidikan::find($data->jenispendidikanid);
        } else {
            $check_nama = MasterJenisPendidikan::where('nama',$data->nama)->count();
            $jenis_pendidikan = new MasterJenisPendidikan;
        }

        if($check_nama == 0) {
            $jenis_pendidikan->nama  = $data->nama;
            $jenis_pendidikan->save();
            
            $result = $this->return(1,'Berhasil!','Berhasil menyimpan data');
			return $result;
        } else {
            $result = $this->return(0,'Gagal!','Nama jenis jabatan tersebut sudah ada');
			return $result;
        }
    }

    public function simpanStrata($data) {
        if ($data->strataid > 0) {
            $check_nama = MasterStrataPendidikan::where('nama',$data->nama)
                        ->where('id', '!=', $data->strataid)->count();
            $strata = MasterStrataPendidikan::find($data->strataid);
        } else {
            $check_nama = MasterStrataPendidikan::where('nama',$data->nama)->count();
            $strata = new MasterStrataPendidikan;
        }

        if($check_nama == 0) {
            $strata->nama  = $data->nama;
            $strata->pendidikan_jenis_id = $data->jenis_pendidikan;
            $strata->save();
            
            $result = $this->return(1,'Berhasil!','Berhasil menyimpan data');
			return $result;
        } else {
            $result = $this->return(0,'Gagal!','Nama jenis jabatan tersebut sudah ada');
			return $result;
        }
    }

    public function simpanInstitusi($data) {
        if ($data->institusiid > 0) {
            $check_nama = MasterInstitusiPendidikan::where('nama',$data->nama)
                        ->where('id', '!=', $data->institusiid)->count();
            $institusi = MasterInstitusiPendidikan::find($data->institusiid);
        } else {
            $check_nama = MasterInstitusiPendidikan::where('nama',$data->nama)->count();
            $institusi = new MasterInstitusiPendidikan;
        }

        if($check_nama == 0) {
            $institusi->nama  = $data->nama;
            $institusi->save();
            
            $result = $this->return(1,'Berhasil!','Berhasil menyimpan data');
			return $result;
        } else {
            $result = $this->return(0,'Gagal!','Nama jenis jabatan tersebut sudah ada');
			return $result;
        }
    }

    public function pegawaiSave($data, $id) {

        $pendidikan = new Pendidikan;

        $pendidikan->pegawai_id           = $id;
        $pendidikan->nama                 = $data->nama;
        $pendidikan->jenis_pendidikan_id  = $data->jenis;
        $pendidikan->strata_pendidikan_id     = $data->strata;
        $pendidikan->institusi_pendidikan_id  = $data->institusi;
        $pendidikan->tgl_masuk             = $data->tgl_masuk;
        $pendidikan->tgl_lulus             = $data->tgl_lulus;
        $pendidikan->status                = '0';
        $pendidikan->created_by            = Auth::user()->id;       
        //Image
        if(!empty($data->certificate)){
            $pendidikan->certificate = self::uploadFile($data->certificate);
            $pendidikan->save();

            $result = $this->return(1,'Berhasil!','Berhasil menyimpan data');
            return $result;
        } else {
            $result = $this->return(-1,'Gagal!','Gagal Menambahkan Data. File sertifikat tidak boleh kosong');
            return $result;
        }
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

    private function return($status,$title,$message) {
		$data['status'] = $status;
		$data['title'] = $title;
		$data['message'] = $message;
        return $data;
	}
}
