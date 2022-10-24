<?php

namespace App\Http\Controllers\Admin\PembayaranPerusahaanType;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pasien\PembayaranPerusahaanType;

class EditController extends Controller
{
    public function edit($id, $data)
    {
        $tipe = PembayaranPerusahaanType::find($id);
        $tipe->nama = $data['nama'];
        $tipe->save();

        return $tipe;
    }
}
