<?php

namespace App\Http\Controllers\KamarOperasi\Paket;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\KamarOperasi\Paket;
use App\Models\KamarOperasi\PaketItem;
use App\Models\KamarOperasi\Transaksi;
use App\Models\Gudang\ItemsTemplate;
use App\User as Dokter;
use DB;

class ReadController extends Controller
{
  public function getPaketItem(Request $request)
  {
    $items = PaketItem::select(['id', 'item_id', 'tipe', 'paket_id', 'jumlah'])->where('paket_id', $request->id)->get();
    foreach ($items as $i => $item)
    {
      $items[$i]['nama'] = $item->getItem->nama;
    }
    return response()->json($items->toArray());
  }

  public function ajaxSearchPaket(Request $request)
  {
    $term = trim($request->search);
    if (empty($term))
    {
      return response()->json([]);
    }

    $paket = Paket::select(['id', 'nama as text'])->where('nama', 'like', "%{$term}%")->where('tipe', $request->tipe)->get()->toArray();
    return response()->json($paket);
  }
}
