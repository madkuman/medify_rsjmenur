<?php

namespace App\Http\Controllers\Gizi\Pengaturan\JenisMakanan;

use App\Models\Gizi\JenisMakanan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CreateController extends Controller
{
    public function create(Request $request)
    {
        $jenis_makanan = new JenisMakanan();
        $jenis_makanan->nama = $request->nama;
        $jenis_makanan->utama = $request->utama;
        $jenis_makanan->diet = isset($request->diet) && !is_null($request->diet) ? $request->diet : 0;
        $jenis_makanan->save();
    }
}
