<?php

namespace App\Http\Controllers\RawatJalan\Ruangan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RawatJalan\Ruangan;
use Illuminate\Support\Facades\Auth;

class ReadController extends Controller
{
    public function getAll()
    {
        $ruangan = Ruangan::all();
        return $ruangan;
    }

    public function getDokterPoli()
    {
        $data = Ruangan::select(['id', 'nama', 'poliklinik_id'])->where('dokter_id', Auth::user()->id)->first();
        return $data;
    }
}
