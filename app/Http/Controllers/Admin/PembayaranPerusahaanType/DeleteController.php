<?php

namespace App\Http\Controllers\Admin\PembayaranPerusahaanType;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pasien\PembayaranPerusahaanType;

class DeleteController extends Controller
{
    public function delete($id)
    {
        $tipe = PembayaranPerusahaanType::find($id);
        $tipe->delete();
        return;
    }
}