<?php

namespace App\Http\Controllers\Admin\TNIKorps;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pasien\TNIKorps;

class EditController extends Controller
{
    public function edit($id, $data)
    {
        $korps = TNIKorps::find($id);
        $korps->nama = $data['nama'];
        $korps->singkat_pangkat = $data['pangkat'];
        $korps->save();

        return $korps;
    }
}
