<?php

namespace App\Http\Controllers\Admin\PembayaranPerusahaan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pasien\PembayaranPerusahaan;

class DeleteController extends Controller
{
    public function delete($id)
    {
        $pembayaran = PembayaranPerusahaan::find($id);
        $pembayaran->delete();
        return;
    }
}