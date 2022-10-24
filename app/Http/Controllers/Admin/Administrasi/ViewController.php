<?php

namespace App\Http\Controllers\Admin\Administrasi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pasien\PembayaranPerusahaanType;

class ViewController extends Controller
{
    public function index()
    {   
        $data['retribusi'] = PembayaranPerusahaanType::all();
        return view('admin.administrasi.index', $data);
    }
}
