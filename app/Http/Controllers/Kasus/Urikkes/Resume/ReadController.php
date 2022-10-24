<?php

namespace App\Http\Controllers\Kasus\Urikkes\Resume;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Kasus;
use App\Models\Kasus\Lain_Urikkes;
use App\User;

class ReadController extends Controller
{
    public function index($nomor_kasus){
      $lainnya = Lain_Urikkes::where('nomor_kasus',$nomor_kasus)->get();
      return $lainnya;
    }
}
