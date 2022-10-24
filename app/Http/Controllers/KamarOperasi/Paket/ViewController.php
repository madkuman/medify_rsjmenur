<?php

namespace App\Http\Controllers\KamarOperasi\Paket;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\KamarOperasi\Transaksi;
use App\Models\KamarOperasi\Paket;
use Carbon\Carbon;

class ViewController extends Controller
{
  public function index()
  {
    $data['pakets'] = Paket::all();
    return view('kamaroperasi.paket.index', $data);
  }

  public function edit($id)
  {
    $data['paket'] = Paket::findOrFail($id);
    $items = $data['paket']->paket_item;
    $item_data = [];
    foreach ($items as $item) {
      $temp = ['id' => $item->item_id, 'text' => $item->getItem->nama, 'jumlah' => $item->jumlah];
      $item_data[] = $temp;
    }

    $data['items'] = json_encode($item_data);
    return view('kamaroperasi.paket.edit', $data);
  }

  public function show($id)
  {
    $data['paket'] = Paket::findOrFail($id);
    $data['items'] = $data['paket']->paket_item;
    return view('kamaroperasi.paket.show', $data);
  }

  public function create()
  {
    return view('kamaroperasi.paket.create');
  }
}
