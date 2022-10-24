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

class ReadController extends Controller{

  public function getKredensial($id){
    $data = Kredensial::where('pegawai_id', $id)->paginate(5);
    return $data;
  }
  public function getSkk($id){
    $data = SKK::where('pegawai_id', $id)->paginate(5);
    return $data;
  }
  public function getStr($id){
    $data = STR::where('pegawai_id', $id)->paginate(5);
    return $data;
  }
  public function getSip($id){
    $data = SIP::where('pegawai_id', $id)->paginate(5);
    return $data;
  }
  public function getEvkin($id){
    $data = Evkin::where('pegawai_id', $id)->paginate(5);
    return $data;
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