<?php

namespace App\Http\Controllers\Kepegawaian\Pegawai\Keluarga;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\Pegawai;
use App\Models\Kepegawaian\Keluarga;
use Alert,Auth;

class CreateController extends Controller{

    public function create(Request $req, $id){

        $data = new Keluarga;
        $data->pegawai_id       = $id;
        $data->hubungan         = $req->hubungan;
        $data->nama             = $req->nama;
        $data->tempat_lahir     = $req->tempat_lahir;
        $data->tanggal_lahir    = $req->tanggal_lahir;
        $data->gender           = $req->gender;
        $data->nik              = $req->nik;
        $data->asuransi         = $req->asuransi;
        $data->no_asuransi      = $req->no_asuransi;
        $data->faskes           = $req->faskes;
        $data->kelas            = $req->kelas;

        $save = $data->save();

        if ( !$save )
          Alert::error('Terjadi kesalahan saat menambahkan data keluarga. Silahkan ulangi lagi', 'Gagal!');
        else 
          Alert::success('Data keluarga berhasil ditambahkan', 'Berhasil!');
    
        return redirect()->route('families', ['id' => $id, '_' => microtime(true)]);   
    }
}