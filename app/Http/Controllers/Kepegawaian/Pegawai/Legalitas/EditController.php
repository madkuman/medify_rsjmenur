<?php

namespace App\Http\Controllers\Kepegawaian\Pegawai\Legalitas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\Pegawai;
use App\Models\Kepegawaian\Berkas;
use App\Models\Kepegawaian\Legalitas\Kredensial;
use App\Models\Kepegawaian\Legalitas\Evkin;
use App\Models\Kepegawaian\Legalitas\SIP;
use App\Models\Kepegawaian\Legalitas\STR;
use App\Models\Kepegawaian\Legalitas\SKK;
use Alert,Auth;

class EditController extends Controller{


    public function update(Request $req, $id){

        $tipe           = $req->tipe;
        $nomer          = $req->nomer;
        $tanggal        = $req->tanggal;
        $file           = $req->file;
        
        if ($tipe == 'kredensial'){
            $legalitas = Kredensial::find($legalitas_id);
        } else if ($tipe == 'skk') {
            $legalitas = SKK::find($legalitas_id);
        } else if ($tipe == 'sip') {
            $legalitas = SIP::find($legalitas_id);
        } else if ($tipe == 'str') {
            $legalitas = STR::find($legalitas_id);
        } else {
            $legalitas = Evkin::find($legalitas_id);
        }

        $legalitas->pegawai_id  = $id;
        $legalitas->nomer       = $nomer;
        $legalitas->tanggal     = $tanggal;

        if(!empty($file)){

            $legalitas->file  = self::uploadFile($file);
        }

        $save = $legalitas->update();

        if ( !$save )
            Alert::error('Terjadi kesalahan saat update data. Silahkan ulangi lagi', 'Gagal!');
        else 
            Alert::success('Data berhasil di update', 'Berhasil!');

        return redirect()->route('legalitas', ['id' => $id, '_' => microtime(true)]);

    }
}