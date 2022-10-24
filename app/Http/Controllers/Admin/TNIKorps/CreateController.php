<?php

namespace App\Http\Controllers\Admin\TNIKorps;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pasien\TNIKorps;

class CreateController extends Controller
{
    public function create($data)
    {
        $korps = new TNIKorps;
        $korps->nama = $data['nama'];
        $korps->created_by = $data['pegawai'];
        $korps->singkat_pangkat = $data['pangkat'];
        $korps->save();

        return $korps;
    }
}
