<?php

namespace App\Http\Controllers\Kasus\Urikkes\Gigi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kasus\Gigi;
use App\Models\Kasus\Kasus;
use App\User;

class ReadController extends Controller
{
    public function index($nomor_kasus){
      $gigi = Gigi::where('nomor_kasus',$nomor_kasus)->get();
      return $gigi;
    }
}
