<?php

namespace App\Http\Controllers\Kasus\Urikkes\Jiwa;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Jiwa;
use App\Models\Kasus\Kasus;
use App\User;

class ReadController extends Controller
{
    public function index($nomor_kasus){
      $bacaan= Jiwa::where('nomor_kasus',$nomor_kasus)->get();
      return $bacaan;
    }
}
