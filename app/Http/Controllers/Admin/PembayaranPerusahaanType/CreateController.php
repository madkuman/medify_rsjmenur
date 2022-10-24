<?php

namespace App\Http\Controllers\Admin\PembayaranPerusahaanType;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pasien\PembayaranPerusahaanType;

class CreateController extends Controller
{
    public function create($data)
    {
        $tipe = new PembayaranPerusahaanType;
        $tipe->nama = $data['nama'];
        $tipe->created_by = $data['pegawai'];
        $tipe->save();

        return $tipe;
    }
}
