<?php

namespace App\Http\Controllers\Gizi\Pengaturan\AnggaranMakananDetail;

use App\Models\Gizi\AnggaranMakananDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class EditController extends Controller
{
    public function edit($request,$id)
    {
        $anggaran_makanan_detail = AnggaranMakananDetail::find($id);
        $anggaran_makanan_detail->tahun = $request->tahun;
        $anggaran_makanan_detail->jumlah = $request->jumlah;
        $anggaran_makanan_detail->updated_by = Auth::user()->id;
        $anggaran_makanan_detail->save();
    }
}
