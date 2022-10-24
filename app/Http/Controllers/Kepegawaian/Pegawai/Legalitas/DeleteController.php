<?php

namespace App\Http\Controllers\Kepegawaian\Pegawai\Legalitas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kepegawaian\Pegawai;
use App\Models\Kepegawaian\Legalitas\Kredensial;
use App\Models\Kepegawaian\Legalitas\Evkin;
use App\Models\Kepegawaian\Legalitas\SIP;
use App\Models\Kepegawaian\Legalitas\STR;
use App\Models\Kepegawaian\Legalitas\SKK;
use App\Models\Kepegawaian\Berkas;
use Alert,Auth;

class DeleteController extends Controller{

    public function delete(Request $req, $id){
        $tipe = $req->tipe;
        $legalitas_id = $req->id;

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
        
        $delete = $legalitas->delete();

        if ( !$delete ){
            $status = -1;
            $message = 'Terjadi kesalahan! Silahkan coba lagi';
            $title = 'Gagal!';
        }
        else {
            $status = 1;
            $message = 'Berhasil menghapus data';
            $title = 'Berhasil!';
        }

        return redirect()->back()
            ->with('message', $message)
            ->with('title',$title)
            ->with('status', $status);
	}
}