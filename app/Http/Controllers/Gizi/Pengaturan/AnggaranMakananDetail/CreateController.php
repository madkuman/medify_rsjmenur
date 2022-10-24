<?php

namespace App\Http\Controllers\Gizi\Pengaturan\AnggaranMakananDetail;

use App\Models\Gizi\AnggaranMakananDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class CreateController extends Controller
{
    public function create(Request $request)
    {
        $anggaran_makanan_detail = new AnggaranMakananDetail();
        $anggaran_makanan_detail->anggaran_makanan_id = $request->anggaran_makanan_id;
        $anggaran_makanan_detail->tahun = $request->tahun;
        $anggaran_makanan_detail->jumlah = $request->jumlah;
        $anggaran_makanan_detail->created_by = Auth::user()->id;
        $anggaran_makanan_detail->save();
    }
}
