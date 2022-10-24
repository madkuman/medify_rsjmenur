<?php

namespace App\Http\Controllers\Laundry\Barang;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ViewController extends Controller
{
  public function indexBarang()
  {
      $data['barang'] = app('App\Http\Controllers\Laundry\Barang\ReadController')->GetBarang();
      return view('laundry.barang.index', $data);
  }
}
