<?php

namespace App\Http\Controllers\Admin\PembayaranPerusahaan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pasien\PembayaranPerusahaan;

class EditController extends Controller
{
    public function edit($id, $data)
    {
        $pembayaran = PembayaranPerusahaan::find($id);
        $pembayaran->nama = $data['nama'];
        $pembayaran->type = $data['type'];
        $pembayaran->perusahaan_keuangan_id = $data['perusahaan_keuangan_id'];
        $pembayaran->cara_bayar = $data['cara_bayar'];
        $pembayaran->save();

        return $pembayaran;
    }
}
