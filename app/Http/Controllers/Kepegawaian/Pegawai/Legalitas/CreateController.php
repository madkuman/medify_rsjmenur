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

class CreateController extends Controller{


    public function create(Request $req, $id){

        $tipe           = $req->tipe;
        $nomer          = $req->nomer;
        $tanggal        = $req->tanggal;
        $file           = $req->file;
        
        if ($tipe == 'kredensial'){
            $legalitas = new Kredensial;
        } else if ($tipe == 'skk') {
            $legalitas = new SKK;
        } else if ($tipe == 'sip') {
            $legalitas = new SIP;
        } else if ($tipe == 'str') {
            $legalitas = new STR;
        } else {
            $legalitas = new Evkin;
        }

        $legalitas->pegawai_id  = $id;
        $legalitas->nomer       = $nomer;
        $legalitas->tanggal     = $tanggal;

        if(!empty($req->file)){

            $legalitas->file  = self::uploadFile($req->file);
        }

        $save = $legalitas->save();

        if ( !$save ){
            $status = -1;
            $message = 'Terjadi kesalahan! Silahkan coba lagi';
            $title = 'Gagal!';
        }
        else {
            $status = 1;
            $message = 'Berhasil menambahkan data';
            $title = 'Berhasil!';
        }

        return redirect()->route('legalitas', ['id' => $id, '_' => microtime(true)])
            ->with('message', $message)
            ->with('title',$title)
            ->with('status', $status);

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
          $destination_path = public_path('/uploads/kepegawaian/legalitas');
          $thefile->move($destination_path, $filename);
          $item->save();
        }
    
        return $item->id;
    }
}