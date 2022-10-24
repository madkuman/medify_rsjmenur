<?php

namespace App\Http\Controllers\Gizi\Pengaturan\AnggaranMakanan;

use App\Models\Gizi\AnggaranMakanan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class EditController extends Controller
{
    public function edit($request,$id)
    {
        $anggaran_makanan = AnggaranMakanan::where('id',$id)->first();
        $anggaran_makanan->nama = $request->nama;
        $anggaran_makanan->satuan = $request->satuan;
        $anggaran_makanan->jenis_makanan_ids = json_encode($request->jenis_makanan_ids);
        $anggaran_makanan->kelas_ids = json_encode($request->kelas_ids);
        $anggaran_makanan->bangsal_ids = json_encode($request->bangsal_ids);
        $anggaran_makanan->updated_by = Auth::user()->id;
        $anggaran_makanan->save();
    }
}
