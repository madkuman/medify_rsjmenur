<?php

namespace App\Http\Controllers\Keuangan\PaketPemasukan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Keuangan\PaketPemasukan;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;

class CreateController extends Controller
{
    public function create($req, $paket_penagihan)
    {
        $paket = new PaketPemasukan;
        $paket->judul = $paket_penagihan->judul;
        if($req->total_bayar < $paket_penagihan->total)
            $paket->total = $req->total_bayar;          //KALO NYICIL
        else
            $paket->total = $paket_penagihan->total;    //KALO LUNAS ATAU LEBIH
        
        $paket->akun_id = $paket_penagihan->akun_id;
        $paket->bk_id = (new \App\Http\Controllers\Keuangan\BukuKas\CreateController())->create();
        $paket->created_by = Auth::user()->id;
        $paket->tanggal_transaksi = Carbon::now();
        $paket->save();
        $paket->slug = $this->generatePaketSlug($paket);
        $paket->save();
        return $paket;
    }


    private function generatePaketSlug($paket)
    {
        $date = date('dmY');
        $encrypted = Crypt::encryptString($paket->id).$date;
        $res = substr($encrypted, 170);
        return $res;
    }
}