<?php

namespace App\Http\Controllers\Pasien\PengaturanLoket;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pasien\PengaturanLoket;

class EditController extends Controller
{
    public function update($request, $id)
    {
        $loket = PengaturanLoket::find($id);
        $loket->nama_loket = $request->nama;
        $loket->jenis_pasien = $request->jenis_pasien;
        $loket->save();

        return $loket;
    }
}
