<?php

namespace App\Http\Controllers\KamarOperasi\Pengembalian;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\KamarOperasi\Pengembalian;
use App\Models\KamarOperasi\Transaksi;
use App\Models\Gudang\ItemsTemplate;
use App\User as Dokter;
use DB;

class ReadController extends Controller
{
  public function ajaxGetItemPengembalian(Request $request)
  {
    $pengembalian = Pengembalian::where('operasi_id', $request->input('id'))
          ->select(['operasi_id', 'item_id', 'jumlah', 'jenis'])->get();

    foreach ($pengembalian as $i => $item)
    {
      $pengembalian[$i]['nama'] = $item->getItem->nama;
    }
    return response()->json($pengembalian->toArray());
  }
}
