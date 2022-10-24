<?php

namespace App\Http\Controllers\Kasus\Urikkes\EvaluasiKlinis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\EvaluasiKlinis;
use App\User;

class ReadController extends Controller
{
    public function index($nomor_kasus){
      $evaluasi = EvaluasiKlinis::with('telinga_cek')->where('nomor_kasus',$nomor_kasus)->orderBy('created_at','desc')->get();
      return $evaluasi;
    }
}
