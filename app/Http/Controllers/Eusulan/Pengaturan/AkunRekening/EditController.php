<?php

namespace App\Http\Controllers\Eusulan\Pengaturan\AkunRekening;

use App\Models\Eusulan\AkunRekening;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class EditController extends Controller
{
    public function edit($request)
    {
        $akun_rekening = AkunRekening::find($request->id);
        $akun_rekening->nama = $request->nama;
        $akun_rekening->kode = $request->kode;
        $akun_rekening->status = $request->status;
        $akun_rekening->updated_by = Auth::user()->id;
        $akun_rekening->save();
    }
}
