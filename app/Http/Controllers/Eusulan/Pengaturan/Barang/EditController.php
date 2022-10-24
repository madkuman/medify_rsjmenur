<?php

namespace App\Http\Controllers\Eusulan\Pengaturan\Barang;

use App\Models\Eusulan\AkunBarang;
use App\Models\Eusulan\Barang;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class EditController extends Controller
{
    public function edit($request)
    {
        $barang = Barang::find($request->id);
        $barang->kode = $request->kode;
        $barang->nama = $request->nama;
        $barang->tipe = $request->tipe;
        $barang->harga = $request->harga;
        $barang->satuan = $request->satuan;
        $barang->kelompok = $request->kelompok;
        $barang->updated_by = Auth::user()->id;
        $barang->save();

        $barang->akun_barang()->delete();

        if(!empty($request->akun_rekening))
        {
            foreach ($request->akun_rekening as $akun_rekening_id)
            {
                $akun_barang = new AkunBarang();
                $akun_barang->akun_rekening_id = $akun_rekening_id;
                $akun_barang->barang_id = $barang->id;
                $akun_barang->save();
            }
        }
    }
}
