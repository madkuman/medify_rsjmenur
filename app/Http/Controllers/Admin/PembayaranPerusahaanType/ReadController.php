<?php

namespace App\Http\Controllers\Admin\PembayaranPerusahaanType;

use App\Http\Controllers\Controller;
use App\Models\Pasien\PembayaranPerusahaanType;

class ReadController extends Controller
{
    public function getBySlug($slug){
        return PembayaranPerusahaanType::where('slug', $slug)->first();
    }

    public function getAll()
    {
        return PembayaranPerusahaanType::all();
    }
}