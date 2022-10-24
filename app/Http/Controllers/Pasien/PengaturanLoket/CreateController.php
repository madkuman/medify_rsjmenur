<?php

namespace App\Http\Controllers\Pasien\PengaturanLoket;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pasien\PengaturanLoket;

class CreateController extends Controller
{
    public function create($request)
    {
        $loket = new PengaturanLoket;
        $loket->nama_loket = $request->nama;
        $loket->jenis_pasien = $request->jenis_pasien;
        $loket->save();

        return $loket;
    }
}
