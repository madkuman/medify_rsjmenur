<?php

namespace App\Http\Controllers\KamarOperasi\Kamar;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\KamarOperasi\Transaksi;
use App\Models\KamarOperasi\Ruangan;
use App\Models\Farmasi\Farmasi;
use Carbon\Carbon;

class ViewController extends Controller
{
  public function index()
  {
    // $data['kamars'] = Ruangan::orderBy('kategori', 'desc')->orderByRaw('LENGTH(name)', 'asc')->orderBy('name')->get();
    $data['kamars'] = Ruangan::orderBy('kategori', 'desc')->orderBy('name')->get();
    return view('kamaroperasi.kamar.index', $data);
  }

  public function edit($id)
  {
    $data['kamar'] = Ruangan::findOrFail($id);
    $data['farmasis'] = Farmasi::all();
    return view('kamaroperasi.kamar.edit', $data);
  }

  public function create()
  {
    $data['farmasis'] = Farmasi::all();
    return view('kamaroperasi.kamar.create', $data);
  }
}
