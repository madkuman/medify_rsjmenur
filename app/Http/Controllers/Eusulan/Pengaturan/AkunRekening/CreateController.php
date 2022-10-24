<?php

namespace App\Http\Controllers\Eusulan\Pengaturan\AkunRekening;

use App\Models\Eusulan\AkunRekening;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class CreateController extends Controller
{
    public function create($request)
    {
        $akun_rekening = new AkunRekening();
        $akun_rekening->nama = $request->nama;
        $akun_rekening->kode = $request->kode;
        $akun_rekening->status = $request->status;
        $akun_rekening->created_by = Auth::user()->id;
        $akun_rekening->save();
    }
}
