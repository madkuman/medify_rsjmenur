<?php

namespace App\Http\Controllers\Kasus\Urikkes\Laporan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\Laporan_Kasus;

class ReadController extends Controller
{
  public function index($pasien_id){
    $laporan = Laporan_Kasus::where('pasien_id',$pasien_id)->first();
    return $laporan;
  }

}
