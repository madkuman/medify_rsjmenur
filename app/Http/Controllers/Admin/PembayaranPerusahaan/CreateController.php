<?php

namespace App\Http\Controllers\Admin\PembayaranPerusahaan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pasien\PembayaranPerusahaan;

class CreateController extends Controller
{
    public function create($data)
    {
        $pembayaran = new PembayaranPerusahaan;
        $pembayaran->nama = $data['nama'];
        $pembayaran->type = $data['type'];
        $pembayaran->perusahaan_keuangan_id = $data['perusahaan_keuangan_id'];
        $pembayaran->cara_bayar = $data['cara_bayar'];
        $pembayaran->created_by = $data['pegawai'];
        $pembayaran->save();

        return $pembayaran;
    }
}
