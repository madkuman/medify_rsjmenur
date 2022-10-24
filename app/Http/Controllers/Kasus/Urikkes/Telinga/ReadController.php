<?php

namespace App\Http\Controllers\Kasus\Urikkes\Telinga;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Bugsnag;
use Illuminate\Support\Facades\Auth;
use App\Models\Kasus\Telinga;
use App\Models\Kasus\Kasus;
use App\User;

class ReadController extends Controller
{
  public function index($nomor_kasus){
    $telinga = Telinga::where('nomor_kasus',$nomor_kasus)->get();
    return $telinga;
  }
}
