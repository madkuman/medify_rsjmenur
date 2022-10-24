<?php

namespace App\Http\Controllers\Laundry\Barang;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Laundry\Barang;

class ReadController extends Controller
{
  public function GetBarang()
  {
    $nomor = 1;
    $pa = Barang::paginate(10);
    foreach ($pa as $p) {
      $p->nomor = $nomor;
      $nomor++;
    }
    return $pa;
  }
}
