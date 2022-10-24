<?php

namespace App\Http\Controllers\KamarOperasi\Pasca;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\KamarOperasi\PengembalianObat;
use App\Models\KamarOperasi\PengembalianAlat;
use App\Models\KamarOperasi\Transaksi;
use DB;

class ReadController extends Controller
{
  public function ajaxGetItemPengembalian(Request $request)
  {
    $obat = PengembalianObat::with(['item' => function($q){
            $q->select(['id', DB::raw('CONCAT("obat_", id) as id2'), 'nama', 'deleted_at']);
          }])
          ->where('operasi_id', $request->input('id'))
          ->select(['operasi_id', 'item_id', 'jumlah'])->get()->toArray();
    $alat = PengembalianAlat::with(['item' => function($q){
            $q->select(['id', DB::raw('CONCAT("alat_", id) as id2'), 'nama_alat as nama', 'deleted_at']);
          }])
          ->where('operasi_id', $request->input('id'))
          ->select(['operasi_id', 'item_id', 'jumlah'])->get()->toArray();
    $item = array_merge($obat, $alat);
    // var_dump($item); die();
    return response()->json($item);
  }
}
