<?php

namespace App\Http\Controllers\KamarOperasi\Pemakaian;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\KamarOperasi\Pemakaian;
use App\Models\KamarOperasi\Transaksi;
use App\Models\Gudang\ItemsTemplate;
use App\User as Dokter;
use DB;

class ReadController extends Controller
{
  public function ajaxGetItemPemakaian(Request $request)
  {
    $pemakaian = Pemakaian::where('operasi_id', $request->input('id'))
          ->select(['operasi_id', 'item_id', 'jumlah', 'jenis'])->get();

    foreach ($pemakaian as $i => $item)
    {
      $pemakaian[$i]['nama'] = $item->getItem->nama;
    }
    return response()->json($pemakaian->toArray());
  }
}
