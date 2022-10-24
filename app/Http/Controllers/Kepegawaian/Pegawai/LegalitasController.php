<?php

namespace App\Http\Controllers\Kepegawaian\Pegawai;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Kepegawaian\Pegawai;
use App\Models\Kepegawaian\Berkas;
use Alert,Auth;

class LegalitasController extends Controller{

    // SIP
    public function saveSIP(Request $request, $id){
       
        $new_sip                  = Pegawai::find($id);
        $new_sip->sip             = $request->sip;
        $new_sip->sip_expired_at  = $request->expired;

        if(!empty($request->file)){

            $new_sip->sip_file  = self::uploadFile($request->file);
        }
     
        $save = $new_sip->update();

        if ( !$save )
            Alert::error('Terjadi kesalahan saat menambahkan data. Silahkan ulangi lagi', 'Gagal!');
        else 
            Alert::success('Data berhasil ditambahkan', 'Berhasil!');

        return redirect()->route('legalitas', ['id' => $id, '_' => microtime(true)]);
    }

    // STR
    public function saveSTR(Request $request, $id){
        
        $new_str              = Pegawai::find($id);
        $new_str->str         = $request->str;
        $new_str->str_expired = $request->expired;

        if(!empty($request->file)){

            $new_str->str_file  = self::uploadFile($request->file);
        }
       
        $save = $new_str->update();

        if ( !$save )
            Alert::error('Terjadi kesalahan saat menambahkan data. Silahkan ulangi lagi', 'Gagal!');
        else 
            Alert::success('Data berhasil ditambahkan', 'Berhasil!');

        return redirect()->route('legalitas', ['id' => $id, '_' => microtime(true)]);
        
    }

    // SKK/RKK
    public function saveSKK(Request $request, $id){

        $new_skk                = Pegawai::find($id);
        $new_skk->ppa_1         = $request->skk;

        if(!empty($request->file)){

            $new_skk->ppa_1_file  = self::uploadFile($request->file);
        }
        
        $save = $new_skk->update();

        if ( !$save )
            Alert::error('Terjadi kesalahan saat menambahkan data. Silahkan ulangi lagi', 'Gagal!');
        else 
            Alert::success('Data berhasil ditambahkan', 'Berhasil!');

        return redirect()->route('legalitas', ['id' => $id, '_' => microtime(true)]);
    }

    // KREDENSIAL
    public function saveKredensial(Request $request, $id){

        $new                = Pegawai::find($id);
        $new->ppa_2         = $request->kredensial;

        if(!empty($request->file)){

            $new->ppa_2_file  = self::uploadFile($request->file);
        }
        
        $save = $new->update();

        if ( !$save )
            Alert::error('Terjadi kesalahan saat menambahkan data. Silahkan ulangi lagi', 'Gagal!');
        else 
            Alert::success('Data berhasil ditambahkan', 'Berhasil!');

        return redirect()->route('legalitas', ['id' => $id, '_' => microtime(true)]);
    }

    // EVKIN
    public function saveEvkin(Request $request, $id){

        $new_evkin              = Pegawai::find($id);
        $new_evkin->ppa_3       = $request->evkin;

        if(!empty($request->file)){

            $new_evkin->ppa_3_file  = self::uploadFile($request->file);
        }

        $save = $new_evkin->update();

        if ( !$save )
            Alert::error('Terjadi kesalahan saat menambahkan data. Silahkan ulangi lagi', 'Gagal!');
        else 
            Alert::success('Data berhasil ditambahkan', 'Berhasil!');

        return redirect()->route('legalitas', ['id' => $id, '_' => microtime(true)]);
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
    
      public function getFile($emp, $id) {
        $thefile = Berkas::find($id);
        $extension = $thefile->extension;
        $filename = $id.'.'.$extension;
        $destination_path = public_path('/uploads/kepegawaian/legalitas');
    
        if(file_exists($destination_path.'/'.$filename)) {
          return response()->file($destination_path.'/'.$filename);
        }
        else {
          Alert::error('File Legalitas Tidak Ditemukan', 'Gagal!');
    
          return redirect()->route('legalitas', ['id' => $emp]);
        }
      }

}