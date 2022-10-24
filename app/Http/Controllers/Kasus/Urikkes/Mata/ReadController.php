<?php

namespace App\Http\Controllers\Kasus\Urikkes\Mata;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Mata;
use App\Models\Kasus\Kasus;
use App\User;

class ReadController extends Controller
{
    public function index($nomor_kasus){
      $mata = Mata::where('nomor_kasus',$nomor_kasus)->get();
      return $mata;
    }
}
